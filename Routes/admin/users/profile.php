<?php 
if(isset($_POST["process"]) AND $_POST["process"])
{
	$datas = [];	
	foreach($users->profileData AS $key) { $datas[$key] = $_POST[$key]; }
	
	$return = $users->profile($datas);
	if($return["success"])
	{
		getController("File");
		$file = new FileController();
		$fileReturn = $file->upload("pic", "users-profile", USERID, [$GLOBALS["user"]["name"]]);
		if($fileReturn[0]["type"] == "success") { $users->editUser(USERID, ["pic" => $fileReturn[0]["fileID"]]); }
		$URL->redirect([$routes[0]], ["success" => "edit"]);
	}
	else
	{
		$_SESSION[SESSION_PREFIX."post-data"] = $return;
		if(in_array("doubleEmail", $return["errors"])) { $errorKey = "edit-email"; }
		elseif(in_array("passwordMismatch", $return["errors"])) { $errorKey = "edit-password"; }
		elseif(in_array("missingFields", $return["errors"])) { $errorKey = "edit-required"; }
		
		$URL->redirect([$routes[0]], ["error" => $errorKey]);
	}
}
$VIEW["name"] = "users-profile"; 
?>