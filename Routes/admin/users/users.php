<?php 
#Processes, forms
if(isset($routes[1]) AND !empty($routes[1]))
{
	switch($routes[1])
	{
		case "new":
			if(isset($_POST["process"]) AND $_POST["process"])
			{
				if($_POST["work"] != $routes[1]) { $URL->redirect([$routes[0]], ["error" => "unknown"]); }
				else
				{
					$rank = $users->model->getRankByID($_POST["rank"]);
					if($rank->orderNumber > $GLOBALS["user"]["rankNumber"]) { $URL->redirect([$routes[0], $routes[1]], ["error" => "unknown"]); }
					else
					{
						$datas = [];
						foreach($users->registrationRequired AS $key) { $datas[$key] = $_POST[$key]; }
						$return = $users->registration($datas, NULL, $_POST["rank"], false, false);
						if(!$return["success"])
						{
							$_SESSION[SESSION_PREFIX."post-data"] = $datas;
							$_SESSION[SESSION_PREFIX."return-errors"] = $return["errors"];
							$URL->redirect([$routes[0], $routes[1]]);
						}
						else { $URL->redirect([$routes[0], "edit", $return["lastID"]], ["success" => $routes[1]]); }
					}
				}
			}
			else
			{
				$VIEW["title"] = "Új felhasználó létrehozása"; 
				$VIEW["name"] = "users-form-admin";
			}
			break;
		case "edit":
			$userHere = $users->getUser($routes[2]);
			if($userHere["rankNumber"] > $GLOBALS["user"]["rankNumber"]) { $URL->redirect([$routes[0]], ["error" => "users-rank"]); }
			else
			{
				if(isset($_POST["process"]) AND $_POST["process"])
				{
					if($_POST["work"] != $routes[1]) { $URL->redirect([$routes[0]], ["error" => "unknown"]); }
					elseif($_POST["id"] != $routes[2]) { $URL->redirect([$routes[0]], ["error" => "unknown"]); }
					else
					{
						$rank = $users->model->getRankByID($_POST["rank"]);
						if($rank->orderNumber > $GLOBALS["user"]["rankNumber"]) { $URL->redirect([$routes[0], $routes[1], $routes[2]], ["error" => "unknown"]); }
						else
						{
							$datas = [];	
							$keys = $users->profileData;
							$keys[] = "rank";
							foreach($keys AS $key) { $datas[$key] = $_POST[$key]; }
							
							$return = $users->profile($datas, NULL, $_POST["id"]);
							if($return["success"])
							{
								$userHere = $users->getUser($routes[2]);
								getController("File");
								$file = new FileController();
								$fileReturn = $file->upload("pic", "users-profile", $_POST["id"], [$userHere["name"]]);
								if($fileReturn[0]["type"] == "success") { $users->editUser($_POST["id"], ["pic" => $fileReturn[0]["fileID"]]); }
								$URL->redirect([$routes[0], $routes[1], $routes[2]], ["success" => "edit"]);
							}
							else
							{
								$_SESSION[SESSION_PREFIX."post-data"] = $datas;
								$_SESSION[SESSION_PREFIX."return-errors"] = $return["errors"];
								$URL->redirect([$routes[0], $routes[1], $routes[2]]);
							}
						}
					}
				}
				else
				{
					$VIEW["title"] = $userHere["name"]." <br><small><strong>Felhasználó szerkesztése</strong></small>"; 
					$VIEW["vars"]["formRow"] = $userHere;
					$VIEW["name"] = "users-form-admin";
				}
			}
			break;
		case "del":
			$userData = $users->getUser($routes[2]);
			if($userData["rankNumber"] > $GLOBALS["user"]["rankNumber"]) { $URL->redirect([$routes[0]], ["error" => "users-rank"]); }
			else
			{
				$users->delUser($routes[2]);
				$URL->redirect([$routes[0]], ["success" => $routes[1]]);
			}
			break;	
		default:
			$URL->redirect([$routes[0]], ["error" => "unknown"]);
			break;	
	}
}
#List
else
{
	$VIEW["title"] = "Felhasználók kezelése";
	$VIEW["sections"]["titleRight"] = "admin/_title-right-new-btn";
	$VIEW["name"] = "list-panel";
	$VIEW["vars"]["newButton"]["label"] = "Új felhasználó létrehozása";
	$VIEW["vars"]["LIST"] = [
		"panelName" => "Felhasználók listája",
		"table" => [
			"header" => [
				[
					"name" => "E-mail cím", 
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => "Név", 
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => "Azonosító", 
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => "Regisztráció", 
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => "Utolsó bejelentkezés", 
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => "Rang", 
					"class" => "", 
					"style" => "", 
				],
			],
			"buttons" => ["edit", "del"],
			"rows" => [],
		],
	];
	$userList = $users->getUsers();
	foreach($userList["all"] AS $rowID => $row)
	{
		$VIEW["vars"]["LIST"]["table"]["rows"][$rowID] = [
			"row" => $row,
			"data" => $row["data"],
			"columns" => [	
				[
					"name" => $row["data"]->email,
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => $row["name"], 
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => $row["token"], 
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => $row["data"]->regDate, 
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => $row["data"]->lastLogin, 
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => $row["rank"]->name, 
					"class" => "", 
					"style" => "", 
				],
			],
			"buttons" => [],	
		];
	}
}
?>