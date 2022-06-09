<?php 
define("USER_LOGGED_IN", SESSION_PREFIX."loggedIn");
define("USER_ID_KEY", SESSION_PREFIX."userID");

#Check if user is logged in
if(isset($_SESSION[USER_LOGGED_IN]) AND $_SESSION[USER_LOGGED_IN] === true)
{
	define("USERID", $_SESSION[USER_ID_KEY]);
	$GLOBALS["userID"] = USERID;
}
else { $_SESSION[USER_LOGGED_IN] = false; }

class UserController extends BaseController
{
	public $data;
	
	public $passwordAfter = '$2a$07$fagsufGgrThstRfgWpdjgsZha';
	public $forgotPasswordAfter = "YxZJRe6sfHs7nQm";
	public $redirectLoginSuccess = "";
	public $redirectLoginError = "";
	public $loginAcceptedRanks;
	
	public $registrationRank = 2;
	public $registrationRequired;
	
	public $profile;
	public $profileRequired;
	
	public $nameUsed = 1;
	
	#Constructor
	public function __construct($userID = NULL, $connectionData = [])
	{
		#Model
		$this->getModel($connectionData);
		
		#Get user
		if(!empty($userID)) { $this->data = $this->getUser($userID); }
		
		#Registration required fields
		$this->registrationRequired = ["lastName", "firstName", "email", "password1", "password2"];
		
		#Profile fields
		$this->profileData = ["lastName", "firstName", "email", "password1", "password2"];
		$this->profileRequired = ["lastName", "firstName", "email"];
	}
	
	#Hash password
	public function password($password)
	{
		return crypt($password, $this->passwordAfter);
	}
	
	#Get user by ID
	public function getUser($id = NULL, $allData = true)
	{
		if($id === NULL AND defined("USERID")) { $id = USERID; }
		
		$return = [];
		$return["data"] = $user = $this->model->getUserByID($id);
		$return["rank"] = $this->model->getRankByID($user->rank);
		$return["rankNumber"] = $return["rank"]->orderNumber;
		$return["id"] = $user->id;
		$return["token"] = $user->token;
		$return["tokenHashed"] = sha1($user->token);
		$return["name1"] = $user->lastName." ".$user->firstName;
		$return["name2"] = $user->firstName." ".$user->lastName;
		$return["name"] = $return["name".$this->nameUsed];
		$return["email"] = $user->email;
		
		if($allData)
		{
			$return["pic"] = [];
			$return["profilePic"] = "";
			$return["profilePicAdmin"] = DIR_PUBLIC_WEB."pics/admin-profile-pic.png";
			if(!empty($user->pic))
			{
				getController("File");
				$file = new FileController();
				$return["pic"] = $file->getFile($user->pic);
				$return["profilePic"] = $return["profilePicAdmin"] = $return["pic"]["path"]["web"];
			}
		}
		
		return $return;
	}
	
	public function getUserByEmail($email)
	{
		$id = $this->model->getUserByEmail($email, "id");
		return $this->getUser($id);
	}
	
	public function getUserByToken($email)
	{
		$id = $this->model->getUserByToken($email, "id");
		return $this->getUser($id);
	}
	
	public function getUsers($deleted = 0, $key = "id", $orderBy = "email")
	{
		$return = [
			"all" => [],
			"ranks" => [],
		];
		if(empty($key)) { $key = "id"; }
		$rows = $this->model->getUsers($deleted, $orderBy);		
		foreach($rows AS $row) 
		{ 
			$return["all"][$row->$key] = $return["ranks"][$row->rank][$row->$key] = $this->getUser($row->id, false); 
		}		
		return $return;
	}
	
	#Update user
	public function editUser($id, $datas)
	{
		return $this->model->update($this->model->tables("users"), $datas, $id);
	}
	
	#Delete user
	public function delUser($id)
	{
		return $this->model->delete($this->model->tables("users"), $id);
	}
	
	#Get rank
	public function getRanksSelect($maxRank)
	{
		$return = [];
		$rows = $this->model->select("SELECT * FROM ".$this->model->tables("ranks")." WHERE del = '0' AND orderNumber <= :orderNumber ORDER BY orderNumber", ["orderNumber" => $maxRank]);
		foreach($rows AS $row) { $return[$row->id] = $row->name; }
		return $return;
	}
	
	#Update user's activity field
	public function activity($id = NULL)
	{
		if(empty($id) AND defined("USERID")) { $id = USERID; }
		$this->model->update($this->model->tables("users"), ["lastActivity" => $this->model->now()], $id);
	}
	
	#Login process
	public function login($email, $password, $redirect = false)
	{
		#Get user
		$row = $this->model->getUserByEmail($email);
		
		#Email OK
		if(isset($row->id) AND !empty($row->id))
		{
			#Error: Deleted user
			if($row->del) { $errorKey = "del"; }
			#Error: Rank
			elseif(!empty($this->loginAcceptedRanks) AND !in_array($row->rank, $this->loginAcceptedRanks)) { $errorKey = "rank"; }
			#Error: Password
			elseif($row->password != $this->password($password)) { $errorKey = "password"; }
			#ACCEPTED
			else
			{
				$errorKey = "";
				$_SESSION[USER_LOGGED_IN] = true;
				$_SESSION[USER_ID_KEY] = $row->id;
				
				$params = [
					"lastLogin" => $this->model->now(),
					"lastIP" => $_SERVER["REMOTE_ADDR"],
				];
				$this->model->update($this->model->tables("users"), $params, $row->id);
			}		
		}
		#Error: Email
		else { $errorKey = "email"; }
		
		#Log
		if(isset($GLOBALS["log"]))
		{
			if($_SESSION[USER_LOGGED_IN]) { $id = $row->id; }
			else { $id = NULL; }
			$GLOBALS["log"]->log("users-login", ["int1" => $id, "vchar1" => $errorKey, "vchar2" => $email]);
		}

		#Redirect, return
		if($redirect AND isset($GLOBALS["URL"]))
		{
			if($_SESSION[USER_LOGGED_IN]) { $GLOBALS["URL"]->redirect($this->redirectLoginSuccess); }
			else { $GLOBALS["URL"]->redirect($this->redirectLoginError); }
		}
		else { return $errorKey; }
	}
	
	#Registration process
	public function registration($datas, $required = NULL, $rank = NULL, $loginOnSuccess = true, $redirect = false)
	{
		#Basic datas
		if($required === NULL) { $required = $this->registrationRequired; }
		if($rank === NULL) { $rank = $this->registrationRank; }
		
		$return = [
			"success" => true,
			"errors" => [],
			"datas" => $datas,
			"required" => $required,
			"missing" => [],
			"passwordMatch" => true,
			"doubleEmail" => false,
			"loginOnSuccess" => $loginOnSuccess,
			"redirect" => $redirect,
			"lastID" => NULL,
			"loginData" => NULL,
		];

		#Is something missing?
		if(count($required) > 0)
		{
			foreach($required AS $itemKey)
			{
				if(!isset($datas[$itemKey]) OR empty($datas[$itemKey]))
				{
					$return["success"] = false;
					$return["missing"][] = $itemKey;
				}
			}
		}
		if(count($return["missing"]) > 0) { $return["errors"][] = "missingFields"; }
		
		#Are the 2 passwords match?
		$password1 = $datas["password1"];
		$password2 = $datas["password2"];
		$datas["password1"] = $datas["password2"] = $return["datas"]["password1"] = $return["datas"]["password2"] = NULL;
		unset($datas["password1"]);
		unset($datas["password2"]);

		if($password1 == $password2) { $password = $password1; }
		else
		{
			$return["success"] = false;
			$return["passwordMatch"] = false;
			$return["errors"][] = "passwordMismatch";
		}
		
		#If email exists
		if($this->doubleEmail($datas["email"]))
		{
			$return["success"] = false;
			$return["doubleEmail"] = true;
			$return["errors"][] = "doubleEmail";
		}
		
		#If everything is OK
		if($return["success"])
		{
			#Insert
			$params = $datas;
			if(!isset($params["token"])) { $params["token"] = $this->setToken(); }
			if(!isset($params["regDate"])) { $params["regDate"] = $this->model->now(); }
			if(!isset($params["rank"])) { $params["rank"] = $rank; }
			$params["password"] = $this->password($password);
			
			$return["lastID"] = $lastID = $this->model->insert($this->model->tables("users"), $params);
			
			#Log
			if(isset($GLOBALS["log"])) { $GLOBALS["log"]->log("users-registration", ["int1" => $lastID, "text1" => $GLOBALS["log"]->json($params), "text2" => $GLOBALS["log"]->json($return)]); }
			
			if($loginOnSuccess) { $return["loginData"] = $this->login($params["email"], $password, $redirect); }
		}
		#Else - If something is wrong
		else
		{
			#Log
			if(isset($GLOBALS["log"])) { $GLOBALS["log"]->log("users-registration-failed", ["text1" => $GLOBALS["log"]->json($return)]); }
		}
		
		#Return
		return $return;
	}
	
	#Profile process
	public function profile($datas, $required = NULL, $userID = NULL)
	{
		#Basic datas
		if($required === NULL) { $required = $this->profileRequired; }
		if($userID === NULL) { $userID = USERID; }
		
		$return = [
			"success" => true,
			"errors" => [],
			"datas" => $datas,
			"required" => $required,
			"missing" => [],
			"passwordMatch" => true,
			"doubleEmail" => false,
		];

		#Is something missing?
		if(count($required) > 0)
		{
			foreach($required AS $itemKey)
			{
				if(!isset($datas[$itemKey]) OR empty($datas[$itemKey]))
				{
					$return["success"] = false;
					$return["missing"][] = $itemKey;
				}
			}
		}
		if(count($return["missing"]) > 0) { $return["errors"][] = "missingFields"; }
		
		#Are the 2 passwords match?
		$password1 = $datas["password1"];
		$password2 = $datas["password2"];
		$datas["password1"] = $datas["password2"] = $return["datas"]["password1"] = $return["datas"]["password2"] = NULL;
		unset($datas["password1"]);
		unset($datas["password2"]);

		if($password1 == $password2) { $password = $password1; }
		else
		{
			$return["success"] = false;
			$return["passwordMatch"] = false;
			$return["errors"][] = "passwordMismatch";
		}
		
		#If email exists
		if($this->doubleEmail($datas["email"], $userID))
		{
			$return["success"] = false;
			$return["doubleEmail"] = true;
			$return["errors"][] = "doubleEmail";
		}
		
		#If everything is OK
		if($return["success"])
		{
			#Insert
			$params = $datas;
			if(!empty($password)) { $params["password"] = $this->password($password); }
			
			$this->model->update($this->model->tables("users"), $params, $userID);
			
			#Log
			if(isset($GLOBALS["log"])) { $GLOBALS["log"]->log("users-profile", ["int1" => $userID, "text1" => $GLOBALS["log"]->json($params), "text2" => $GLOBALS["log"]->json($return)]); }
		}
		#Else - If something is wrong
		else
		{
			#Log
			if(isset($GLOBALS["log"])) { $GLOBALS["log"]->log("users-profile-failed", ["int1" => $userID, "text1" => $GLOBALS["log"]->json($return)]); }
		}
		
		#Return
		return $return;
	}
	
	#Logout process
	public function logout()
	{
		if(isset($GLOBALS["log"])) { $GLOBALS["log"]->log("users-logout"); }
		session_destroy();
	}
	
	#Set token
	public function setToken($id = 0)
	{
		return self::setUniqueToken(10, $allowToUse = ["numbers", "capitalLetters"], $this->model->tables("users"), "token", [], $id);
	}
	
	#Check email
	public function doubleEmail($email, $id = 0)
	{
		$rows = $this->model->checkUniqueField($this->model->tables("users"), "email", $email, ["del" => 0], $id);
		if(count($rows) > 0) { return true; }
		else { return false; }
	}
	
	#Get ranks
	public function getRanks($del = 0, $orderBy = "orderNumber")
	{
		return $this->model->selectWholeTable($this->model->tables("ranks"), $del, $orderBy);
	}
	
	#Forgot password
	public function forgotPassword($email)
	{
		#Get user
		$row = $this->model->getUserByEmail($email);
		
		#Email OK
		if(isset($row->id) AND !empty($row->id))
		{
			$id = $row->id;
			#Error: Deleted user
			if($row->del) { $errorKey = "del"; }
			#Error: Rank
			elseif(!empty($this->loginAcceptedRanks) AND !in_array($row->rank, $this->loginAcceptedRanks)) { $errorKey = "rank"; }
			#ACCEPTED
			else
			{
				$errorKey = "";
				
				$date = date("Y-m-d H:i:s");
				$token = $row->id."-".date("YmdHis", strtotime($date))."-".$row->token."-".$row->email."-".self::random(10);
				$hash = $this->forgotPasswordHash($token);
				
				$params = [
					"userID" => $row->id,
					"date" => $date,
					"ip" => $_SERVER["REMOTE_ADDR"],
					"token" => $token,
					"hash" => $hash,
				];
				
				$this->model->statement("UPDATE ".$this->model->tables("forgotPasswords")." SET del = '1', deleted_at = :deleted_at WHERE del = '0' AND userID = :userID", ["deleted_at" => $date, "userID" => $row->id]);
				$lastID = $this->model->insert($this->model->tables("forgotPasswords"), $params);
			}	
			
		}
		#Error: Email
		else 
		{ 
			$id = $token = $hash = $lastID = $params = NULL;
			$errorKey = "email"; 
		}
		
		#Log
		if(isset($GLOBALS["log"]))
		{
			$GLOBALS["log"]->log("users-forgot-password", ["int1" => $id, "int2" => $lastID, "vchar1" => $errorKey, "vchar2" => $email, "vchar3" => $hash]);
		}
		
		#Return
		$return = [
			"errorKey" => $errorKey,
			"user" => $this->getUser($id),
			"lastID" => $lastID,
			"params" => $params,
		];
		return $return;
	}
	
	public function getForgotPassword($hash)
	{
		$row = $this->model->getForgotPasswordByHash($hash);
		if(isset($row->date) AND $row->date >= date("Y-m-d H:i:s", strtotime("-3 days"))) 
		{ 
			if($row->hadUsed) { $id = NULL; }
			else { $id = $row->id; }
		}
		else { $id = NULL; }
		
		return $id;
	}
	
	public function setForgotPassword($hash, $password1, $password2)
	{
		$return = [
			"success" => 1,
			"errorKey" => "",
		];
		$id = $this->getForgotPassword($hash);
		
		if($id === NULL) 
		{ 
			$return["success"] = 0;
			$return["errorKey"] = "hash";
		}
		elseif($password1 == $password2) 
		{ 
			$row = $this->model->getForgotPasswordByHash($hash);
			$password = $this->password($password1); 
			$this->model->update($this->model->tables("users"), ["password" => $password], $row->userID);
			$this->model->update($this->model->tables("forgotPasswords"), ["hadUsed" => 1, "hadUsedDate" => date("Y-m-d H:i:s")], $row->id);
		}
		else
		{
			$return["success"] = 0;
			$return["errorKey"] = "passwordMismatch";
		}
		
		#Log
		if(isset($GLOBALS["log"]))
		{
			$GLOBALS["log"]->log("users-forgot-password-set", ["int1" => $return["success"], "int2" => $rid, "vchar1" => $hash, "vchar2" => $return["errorKey"]]);
		}
		
		return $return;
	}
	
	public function forgotPasswordHash($token)
	{
		return sha1($token.$this->forgotPasswordAfter);
	}
}
?>