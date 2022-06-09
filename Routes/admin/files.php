<?php 
getController("File");
$file = new FileController();
if(isset($_GET["from"]) AND !is_array($_GET["from"])) { $_GET["from"] = explode("/", $_GET["from"]); }
switch($routes[1])
{
	#Download
	case "download":
		$file->download($routes[2], $_GET["from"]);
		break;
	case "download-token":
		$file->downloadByToken($routes[2], $_GET["from"]);
		break;	
	case "download-hash":
		$file->downloadByHash($routes[2], $_GET["from"]);
		break;	
	#Watch	
	case "watch":
		$file->watch($routes[2], $_GET["from"]);
		break;
	case "watch-token":
		$file->watchByToken($routes[2], $_GET["from"]);
		break;	
	case "watch-hash":
		$file->watchByHash($routes[2], $_GET["from"]);
		break;
	case "watch-url":
		$file->watchByURL($routes[2], $_GET["from"]);
		break;	
	#Upload files
	case "upload":
		$fileReturn = $file->upload("files", $_POST["type"], $_POST["foreignKey"]);
		if(isset($_GET["from"]) AND !empty($_GET["from"]))
		{
			$GLOBALS["URL"]->redirect($_GET["from"], ["success" => "file-upload"]);
		}
		break;
	#Ordering files
	case "order":
		$row = $file->getFile($routes[3]);
		$return = $file->newOrderFiles($routes[2], $routes[3], $row["file"]->type, $row["file"]->foreignKey);
		if(isset($_GET["from"]) AND !empty($_GET["from"]))
		{
			if($return === true) { $GLOBALS["URL"]->redirect($_GET["from"], ["success" => "file-order"]); }
			else { $GLOBALS["URL"]->redirect($_GET["from"], ["error" => "order-".$return]); }
		}
		break;
	#Edit files
	case "edit":
		if(count($_POST["files"]) > 0)
		{
			foreach($_POST["files"] AS $fileID => $params) { $file->editFile($fileID, $params); }
		}
		if(isset($_GET["from"]) AND !empty($_GET["from"]))
		{
			$GLOBALS["URL"]->redirect($_GET["from"], ["success" => "file-edit"]);
		}
		break;		
	#Delete	
	case "del":
		$file->delFile($routes[2]);
		if(isset($_GET["from"]) AND !empty($_GET["from"]))
		{
			switch($_GET["from"][0])
			{
				case "profile":
					$users->editUser(USERID, ["pic" => NULL]);
					$GLOBALS["URL"]->redirect($_GET["from"], ["success" => "file-del"]);
					break;
				case "users":
					$row = $file->getFile($routes[2]);
					$users->editUser($row["file"]->foreignKey, ["pic" => NULL]);
					$GLOBALS["URL"]->redirect($_GET["from"], ["success" => "file-del"]);
					break;	
				case "stock":
				case "approved":
					$row = $file->getFile($routes[2]);
					if($row["type"]->name == "used-cars-pic") { $workType = "pic"; }
					elseif($row["type"]->name == "used-cars-document") { $workType = "document"; }
					else { $workType = ""; }
					
					if(!empty($workType)) 
					{ 
						getController("UsedCar");
						$cars = new UsedCarController();
						$cars->adminWork($workType."-del", ["id" => $row["data"]->foreignKey]);
					}
					$GLOBALS["URL"]->redirect($_GET["from"], ["success" => "file-del"]);
					break;	
				default:
					$GLOBALS["URL"]->redirect($_GET["from"], ["success" => "file-del"]);
					break;	
			}
		}
		$GLOBALS["URL"]->redirect([], ["success" => "file-del"]);
		break;
}
?>