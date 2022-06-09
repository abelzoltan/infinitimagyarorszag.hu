<?php 
class User extends Base
{	
	#Tables
	public function tables($name = "")
	{
		$return = [
			"users" => $this->dbPrefix."users",
			"forgotPasswords" => $this->dbPrefix."users_forgotPasswords",
			"groups" => $this->dbPrefix."users_groups",
			"ranks" => $this->dbPrefix."users_ranks",
			"rights" => $this->dbPrefix."users_rights",
		];

		if(empty($name)) { return $return; }
		else { return $return[$name]; }
	}
	
	#Get user
	public function getUserByID($id, $field = "", $delCheck = 0)
	{
		return $this->selectByField($this->tables("users"), "id", $id, $field, $delCheck);
	}
	
	public function getUserByEmail($email, $field = "", $delCheck = 1)
	{
		return $this->selectByField($this->tables("users"), "email", $email, $field, $delCheck);
	}
	
	public function getUserByToken($token, $field = "", $delCheck = 1)
	{
		return $this->selectByField($this->tables("users"), "token", $token, $field, $delCheck);
	}
	
	public function getUsers($deleted = 0, $orderBy = "email")
	{
		$params = [];
		$query = "SELECT * FROM ".$this->tables("users");
		
		if($deleted !== NULL) 
		{ 
			$query .= " WHERE del = :del";
			$params["del"] = $deleted;			
		}
		if(!empty($orderBy)) { $query .= " ORDER BY ".$orderBy; }
		
		$return = $this->select($query, $params); 
		return $return;
	}
	
	#Get rank
	public function getRankByID($id, $field = "", $delCheck = 0)
	{
		return $this->selectByField($this->tables("ranks"), "id", $id, $field, $delCheck);
	}
	
	public function getRankByURL($url, $field = "", $delCheck = 1)
	{
		return $this->selectByField($this->tables("ranks"), "url", $url, $field, $delCheck);
	}
	
	#Get forgot password
	public function getForgotPasswordByHash($hash, $field = "", $delCheck = 1)
	{
		return $this->selectByField($this->tables("forgotPasswords"), "hash", $hash, $field, $delCheck);
	}
}
?>