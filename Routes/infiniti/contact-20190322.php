<?php 
if(isset($_POST["process"]) AND $_POST["process"])
{
	getController("Email");
	$email = new EmailController();
	$datas = $_POST;
	
	#Recaptcha
	$recaptchaResponse = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfcUBAUAAAAAAOYj_bREvY9lkxWdMKoTLE73KS4&response=".$datas["g-recaptcha-response"]."&remoteip=".$_SERVER["REMOTE_ADDR"]), true);
	if(!$recaptchaResponse["success"])
	{
		$_SESSION[SESSION_PREFIX."formError"] = "recaptcha";
		$_SESSION[SESSION_PREFIX."postData"] = $datas;			
		if($routes[0] == "contact") { $URL->header($_SERVER["HTTP_REFERER"]."#contact"); }
		else { $URL->header($_SERVER["HTTP_REFERER"]."#ajanlatkeres"); }
	}
	
	#K&H testdrive
	if(isset($datas["contactType"]) AND $datas["contactType"] == "november-kh-tesztnap")
	{
		$takenDates = $email->getContactsByContactType($datas["contactType"]);
		if(isset($datas["modelName"]) AND !empty($datas["modelName"]) AND in_array($datas["modelName"], $takenDates))
		{
			$_SESSION[SESSION_PREFIX."formError"] = "taken";
			$_SESSION[SESSION_PREFIX."postData"] = $datas;			
			if($routes[0] == "contact") { $URL->header($_SERVER["HTTP_REFERER"]."#contact"); }
			else { $URL->header($_SERVER["HTTP_REFERER"]."#ajanlatkeres"); }
		}
	}
	
	#Get old car
	$car = (isset($datas["modelURL"]) AND !empty($datas["modelURL"])) ? $cars->getCarByURL($datas["modelURL"]) : false;
	
	#Set contact type
	if($routes[0] == "kapcsolatfelvetel-kerek") { $type = "tire"; }
	elseif($routes[0] == "kapcsolatfelvetel-landolo") { $type = "landingPage"; }
	elseif($car !== false)
	{
		$datas["usedCarID"] = $car["id"];
		$datas["model"] = $car["model"]->url;
		$datas["modelName"] = $car["name"];
		$type = $car["type"]->url;
	}
	elseif($datas["formType"] == "oldCar") { $type = "oldCar"; }
	else { $type = "newCar"; }
	
	#Model name
	if(isset($datas["model"]) AND !empty($datas["model"]) AND (!isset($datas["modelName"]) OR empty($datas["modelName"]))) { $datas["modelName"] = $cars->model->getModelByURL($datas["model"], "name"); }
	if(isset($datas["model"]) AND !empty($datas["model"]) AND (!isset($datas["modelName"]) OR empty($datas["modelName"]))) { $datas["modelName"] = $datas["model"]; }
	
	#New contact
	$return = $email->newContact($type, $datas);
	$contact = $email->getContact($return["id"]);
	
	#Admin e-mail
	if($contact["type"] == "tire") 
	{ 
		if(!empty($contact["tireName"])) { $subject = $contact["tireName"]; }
		else { $subject = "Kerék"; }
	}
	else { $subject = $contact["modelName"]; }
	
	if(!empty($subject)) { $subject .= " - "; }
	$subject .= $contact["contactTypeName"];
	
	$email->frameName = "email";
	$email->variables = [
		"header" => "Infiniti",
		"INFINITI_GABLINI" => INFINITI_GABLINI,
		"subject" => $subject,
		"type" => $contact["contactTypeName"],
	];

	$email->variables["details"] = "";
	foreach($contact["details"] AS $detailsKey => $detailsData)
	{
		if(!empty($detailsData["value"]))
		{
			$email->variables["details"] .= "
				<tr>
					<td style='width: 48%; padding: 5px 1%; border: 1px solid #000;'>".$detailsData["name"].":</td>
					<td style='width: 48%; padding: 5px 1%; border: 1px solid #000; font-weight: bold;'>".$detailsData["value"]."</td>
				</tr>
			";
		}
	}
	
	$email->variables["details2"] = "";
	foreach($contact["details2"] AS $detailsKey => $detailsData)
	{
		if(!empty($detailsData["value"]))
		{
			$email->variables["details2"] .= "
				<tr>
					<td style='width: 48%; padding: 5px 1%; border: 1px solid #000;'>".$detailsData["name"].":</td>
					<td style='width: 48%; padding: 5px 1%; border: 1px solid #000; font-weight: bold;'>".$detailsData["value"]."</td>
				</tr>
			";
		}
	}
	
	$email->variables["details3"] = "";
	if($car !== false)
	{
		$email->variables["details3"] .= "
			<tr>
				<td style='width: 48%; padding: 5px 1%; border: 1px solid #000;'>Megnevezés:</td>
				<td style='width: 48%; padding: 5px 1%; border: 1px solid #000; font-weight: bold;'>".$car["name"]."</td>
			</tr>
		";
		$email->variables["details3"] .= "
			<tr>
				<td style='width: 48%; padding: 5px 1%; border: 1px solid #000;'>".$car["price"]["txt"].":</td>
				<td style='width: 48%; padding: 5px 1%; border: 1px solid #000; font-weight: bold;'>".$car["price"]["out"]."</td>
			</tr>
		";
		$email->variables["details3"] .= "
			<tr>
				<td style='width: 48%; padding: 5px 1%; border: 1px solid #000;'>Modell:</td>
				<td style='width: 48%; padding: 5px 1%; border: 1px solid #000; font-weight: bold;'>".$car["model"]->name."</td>
			</tr>
		";
		$email->variables["details3"] .= "
			<tr>
				<td style='width: 48%; padding: 5px 1%; border: 1px solid #000;'>Rövid megnevezés:</td>
				<td style='width: 48%; padding: 5px 1%; border: 1px solid #000; font-weight: bold;'>".$car["shortName"]."</td>
			</tr>
		";
		if(!empty($car["shortText"]))
		{
			$email->variables["details3"] .= "
				<tr>
					<td style='width: 48%; padding: 5px 1%; border: 1px solid #000;'>Rövid megnevezés:</td>
					<td style='width: 48%; padding: 5px 1%; border: 1px solid #000; font-weight: bold;'>".$car["shortText"]."</td>
				</tr>
			";
		}
		if(!empty($car["carBodyNumber"]))
		{
			$email->variables["details3"] .= "
				<tr>
					<td style='width: 48%; padding: 5px 1%; border: 1px solid #000;'>Alvázszám / Alvázvég:</td>
					<td style='width: 48%; padding: 5px 1%; border: 1px solid #000; font-weight: bold;'>".$car["carBodyNumber"]."</td>
				</tr>
			";
		}
	}
	
	if(!empty($contact["message"]))
	{
		$email->variables["message"] = "
			<tr><td colspan='2' style='padding: 5px 1%; border: 1px solid #000; font-weight: bold;'>Üzenet, megjegyzés:</td></tr>
			<tr><td colspan='2' style='padding: 5px 1%; border: 1px solid #000;'>".$contact["message"]."</td></tr>
		";
	}
	else { $email->variables["message"] = ""; }
	
	if(!empty($contact["detailsTire"]))
	{
		$email->variables["detailsTire"] = "";
		foreach($contact["detailsTire"] AS $detailsKey => $detailsData)
		{
			if(!empty($detailsData["value"]))
			{
				$email->variables["detailsTire"] .= "
					<tr>
						<td style='width: 48%; padding: 5px 1%; border: 1px solid #000;'>".$detailsData["name"].":</td>
						<td style='width: 48%; padding: 5px 1%; border: 1px solid #000; font-weight: bold;'>".$detailsData["value"]."</td>
					</tr>
				";
			}
		}
		$email->body = $email->setBody("contact-tire");
	}
	else { $email->body = ($car !== false) ? $email->setBody("contact-stock") : $email->setBody("contact"); }	

	$email->subject = "[INFINITIGABLINI] ".$subject;
	$email->addresses = $GLOBALS["EMAIL_ADDRESSES"];
	$email->send();
	
	#User e-mail
	if($type == "landingPage" AND $contact["contactType"] == "oktober-elmenynap-2018")
	{
		$userEmail = new EmailController();			
		$userEmail->frameName = "email-empty";
		
		$limit = 30;
		$personsCount = 0;
		$personsNow = 0;
		$regRows = $userEmail->model->getContactRegRowsPersons($contact["contactType"]);
		foreach($regRows AS $regRow)
		{
			if($regRow->id == $lastID) { $personsNow = $regRow->persons; }
			else { $personsCount += $regRow->persons; }
		}
		$personsCountAll = $personsNow + $personsCount;
		
		$body = "landing-pages/".$contact["contactType"];
		if($personsCountAll <= $limit)
		{
			$subject = "Infiniti élménynap - Regisztrációját rögzítettük!";
			$body .= "-visszajelzes"; 
		}
		else
		{
			$subject = "Infiniti élménynap - A neve várólistára került!";
			$body .= "-varolista"; 
		}
		
		$userEmail->subject = $subject;
		$userEmail->body = $userEmail->setBody($body);
		$userEmail->addresses = [
			["type" => "to", "email" => $contact["email"], "name" => $contact["name"]],
			// ["type" => "bcc", "email" => "mate@juizz.hu", "name" => "Nagy Máté"],
			// ["type" => "bcc", "email" => "gyorgy@potocki.hu", "name" => "Potocki György"],
		];
		$userEmail->send();
		
		#Redirect
		$_SESSION[SESSION_PREFIX."emailContact"] = $contact;
		$URL->redirect(["kapcsolatfelvetel-koszonjuk"]);
	}
	else
	{
		$userEmail = new EmailController();
		
		$userEmail->frameName = "email";
		$userEmail->variables = [
			"header" => "Gablini - Infiniti",
			"INFINITI_GABLINI" => INFINITI_GABLINI,
			"subject" => ($routes[0] == "contact") ? "Thank you for your contact!" : "Köszönjük érdeklődését!",
			"name" => $contact["firstName"],
			"details" => ($routes[0] == "contact") ? "" : $email->variables["details"],
			"detailsCar" => $email->variables["details3"],
			"message" => $email->variables["message"],
		];
		
		if($routes[0] == "contact")
		{
			foreach($contact["details-en"] AS $detailsKey => $detailsData)
			{
				if(!empty($detailsData["value"]))
				{
					$userEmail->variables["details"] .= "
						<tr>
							<td style='width: 48%; padding: 5px 1%; border: 1px solid #000;'>".$detailsData["name"].":</td>
							<td style='width: 48%; padding: 5px 1%; border: 1px solid #000; font-weight: bold;'>".$detailsData["value"]."</td>
						</tr>
					";
				}
			}
		}
		
		if(!empty($contact["detailsTireUser"]))
		{
			foreach($contact["detailsTireUser"] AS $detailsKey => $detailsData)
			{
				if(!empty($detailsData["value"]))
				{
					$userEmail->variables["details"] .= "
						<tr>
							<td style='width: 48%; padding: 5px 1%; border: 1px solid #000;'>".$detailsData["name"].":</td>
							<td style='width: 48%; padding: 5px 1%; border: 1px solid #000; font-weight: bold;'>".$detailsData["value"]."</td>
						</tr>
					";
				}
			}
		}
		
		$userEmail->subject = $userEmail->variables["subject"];
		$userEmail->body = ($routes[0] == "contact") ? $userEmail->setBody("contact-user-en") : $userEmail->setBody("contact-user");
		if($car !== false) { $userEmail->body = $userEmail->setBody("contact-stock-user"); }
		$userEmail->addresses = [
			["type" => "to", "email" => $contact["email"], "name" => $contact["name"]],
			// ["type" => "bcc", "email" => "mate@juizz.hu", "name" => "Nagy Máté"],
			// ["type" => "bcc", "email" => "gyorgy@potocki.hu", "name" => "Potocki György"],
		];
		$userEmail->send();
		
		#Redirect
		$_SESSION[SESSION_PREFIX."emailContact"] = $contact;
		if($routes[0] == "contact") { $URL->redirect(["contact-thank-you"]); }
		else 
		{ 
			if($type == "landingPage") { $URL->redirect(["kapcsolatfelvetel-koszonjuk"]); }
			else { $URL->redirect([$contact["contactType"]."-koszonjuk"]); }
		}
	}
}
else 
{
	$VIEW["title"] = "Kapcsolatfelvétel";
	$VIEW["name"] = "_form";
	$VIEW["meta"]["og:type"] = "website";
	
	getController("UsedCar");
	$cars = new UsedCarController;
	$VIEW["vars"]["models"] = $cars->getModelsForSelect("url");
	$VIEW["vars"]["formContactType"] = ($routes[0] == "tesztvezetes") ? $routes[0] : "ajanlatkeres";
}
?>