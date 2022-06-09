<?php 
if(isset($_POST["process"]) AND $_POST["process"])
{
	/*if(isset($_POST) AND !empty($_POST))
	{
		$users->registrationRequired[] = "phone";
		$datas = [];
		$dataNames = ["lastName", "firstName", "email", "phone", "password1", "password2"];
		
		if(isset($_POST["deliveryAddress"]))
		{
			$deliveryAddress = $_POST["deliveryAddress"];
			$deliveryAddressRow = $GLOBALS["addresses"]->getCityByZipCode($deliveryAddress["zipCode"], $deliveryAddress["city"]);
		}
		
		if(isset($_POST["billingAddress"]))
		{
			$billingAddress = $_POST["billingAddress"];
			$billingAddressRow = $GLOBALS["addresses"]->getCityByZipCode($billingAddress["zipCode"], $billingAddress["city"]);
		}
		
		foreach($dataNames AS $key) { $datas[$key] = $_POST[$key]; }
		$regReturn = $users->registration($datas);
		
		if($regReturn["success"])
		{
			#Delivery and billing addresses
			$deliveryAddressID = $GLOBALS["addresses"]->newAddress("users-delivery", $regReturn["lastID"], $deliveryAddressRow->id, $deliveryAddress);
			$billingAddressID = $GLOBALS["addresses"]->newAddress("users-billing", $regReturn["lastID"], $billingAddressRow->id, $billingAddress);
			$users->editUser($regReturn["lastID"], ["deliveryAddress" => $deliveryAddressID, "billingAddress" => $billingAddressID]);
			
			$regUser = $users->getUser($regReturn["lastID"]);
			
			#Email
			getController("Email");
			$email = new EmailController();
			$email->variables = [
				"PATH_WEB" => PATH_WEB,
				"title" => "Sikeres regisztráció",
				"date" => $regUser["data"]->regDate,
				"name" => $regUser["name"],
				"email" => $regUser["data"]->email,
				"phone" => $regUser["data"]->phone,
				"deliveryAddress" => $regUser["deliveryAddress"]["addressWithComment"],
				"billingAddress" => $regUser["billingAddress"]["addressWithComment"],
			];
			
			#Send to user
			$email->subject = "Sikeres regisztráció - Kovács Motorolajshop";
			$email->body = $email->setBody("registration-user");
			$email->addresses = [
				["type" => "to", "email" => $regUser["data"]->email, "name" => $regUser["name"]],
				["type" => "bcc", "email" => "mate@juizz.hu", "name" => "Nagy Máté"],
				["type" => "bcc", "email" => "gyorgy@potocki.hu", "name" => "Potocki György"],
			];
			$email->send();
			
			#Send to admin
			$email->subject = "[kovacsmotorolaj.hu] Új regisztráció";
			$email->body = $email->setBody("registration-admin");
			$email->variables["title"] = $email->subject;
			$email->addresses = [
				["type" => "to", "email" => "mate@juizz.hu", "name" => "Nagy Máté"],
				["type" => "to", "email" => "gyorgy@potocki.hu", "name" => "Potocki György"],
			];
			$email->send();
			
			#Redirect
			if(isset($_POST["from"]) AND !empty($_POST["from"])) { $link = $_POST["from"]; }
			else { $link = "fooldal"; }
			$GLOBALS["URL"]->redirect([$link]); 
		}
		else
		{
			$_SESSION[SESSION_PREFIX."post-data"] = $regReturn;
			$_SESSION[SESSION_PREFIX."post-data"]["deliveryAddressData"] = $deliveryAddress;
			$_SESSION[SESSION_PREFIX."post-data"]["billingAddressData"] = $billingAddress;
			
			$get = [];
			if(isset($_POST["from"]) AND !empty($_POST["from"])) { $get["honnan"] = $_POST["from"]; }
			$GLOBALS["URL"]->redirect("regisztracio", $get); 
		}
	}
	else { $GLOBALS["URL"]->redirect(["fooldal"]); }*/
}
else 
{ 
	$VIEW["title"] = "Bejelentkezés";
	$VIEW["name"] = "without-login/registration"; 
}
?>