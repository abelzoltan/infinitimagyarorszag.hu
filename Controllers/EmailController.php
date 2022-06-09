<?php
class EmailController extends BaseController
{
	#Variables for send()
	public $frameName = "email";
	public $subject;
	public $body;
	public $addresses; // Format: $addresses[] = ["type" => "to", "email" => "email@domain.com", "name" => "Test Address"];
	public $from;
	public $replyTo;
	public $attachments; //Format: $attachments[] = ["path" => "path/to/file", "name" => "Test Name"];
	public $variables;
	public $errorInfo;
	
	#Variables for log()
	public $mailObject;
	public $logID;
	public $logInfo;
	
	#Datas
	public function datas($name = "")
	{
		$return = [
			"fromEmail" => EMAIL_FROM_EMAIL,
			"fromName" => EMAIL_FROM_NAME,
			"replyToEmail" => EMAIL_REPLYTO_EMAIL,
			"replyToName" => EMAIL_REPLYTO_NAME,
			"isSMTP" => SMTP_ON,
			"auth" => SMTP_AUTH,
			"secure" => SMTP_SECURE,
			"host" => SMTP_HOST,
			"port" => SMTP_PORT,
			"username" => SMTP_USERNAME,
			"password" => SMTP_PASSWORD,
		];

		if(empty($name)) { return $return; }
		else { return $return[$name]; }
	}
	
	#Get email body from file
	public function bodyFile($fileName, $dir = "emails")
	{
		$file = DIR_VIEWS.$dir."/".$fileName.".html";
		if(file_exists($file)) { $return = file_get_contents($file); }
		else { $return = ""; }
		return $return;
	}
	
	public function setBody($fileName, $dir = "emails")
	{
		return $this->bodyFile($fileName, $dir);
	}
	
	#Watch email = create body
	public function watch($body = "", $subject = "", $frame = "")
	{
		if(empty($body)) { $body = $this->body; }
		if(empty($subject)) { $subject = $this->subject; }
		if(empty($frame)) { $frame = $this->frameName; }
		
		$file = DIR_VIEWS.$frame.".html";
		if(file_exists($file))
		{
			$emailFrame = file_get_contents($file);
			$emailBody = $this->changeHtmlVariable($emailFrame, ["body" => $body, "subject" => $subject]);
			
			if(!empty($this->variables)) { $return = $this->changeHtmlVariable($emailBody, $this->variables); }
			else { $return = $emailBody; }
		}
		else { $return = ""; }
		
		return $return;
	}
	
	#Send email (not from DB)
	public function send($frameName = "")
	{
		#Variables
		$datas = $this->datas();
		
		#Email sender class
		require_once(DIR_CLASSES."PHPMailer/PHPMailerAutoload.php");
		
		#PHPMailer  - Initialize: smtp, wordwrap, charset
		$mail = new PHPMailer();	
		if($datas["isSMTP"]) { $mail->IsSMTP(); }
		$mail->SMTPAuth = $datas["auth"];
		if(!empty($datas["secure"])) { $mail->SMTPSecure = $datas["secure"]; }
		if(!empty($datas["host"])) { $mail->Host = $datas["host"]; }
		if(!empty($datas["port"])) { $mail->Port = $datas["port"]; }
		if(!empty($datas["username"])) { $mail->Username = $datas["username"]; }
		if(!empty($datas["password"])) { $mail->Password = $datas["password"]; }
		
		$mail->WordWrap = 80;
		$mail->CharSet = "utf-8";
		
		#From and replyTo
		if(empty($this->from) OR empty($this->from["email"]))
		{
			$this->from["email"] = $datas["fromEmail"];
			$this->from["name"] = $datas["fromName"];
		}
		$mail->SetFrom($this->from["email"], $this->from["name"]);
		if(empty($this->replyTo))
		{ 
			$this->replyTo["email"] = $datas["replyToEmail"];
			$this->replyTo["name"] = $datas["replyToName"];
		}
		if(!empty($this->replyTo["email"])) { $mail->AddReplyTo($this->replyTo["email"], $this->replyTo["name"]); }
		
		#Addresses
		foreach($this->addresses AS $row) 
		{
			if($row["type"] == "cc") { $functionName = "AddCC"; }
			elseif($row["type"] == "bcc") { $functionName = "AddBCC"; }
			else { $functionName = "AddAddress"; }

			$mail->$functionName($row["email"], $row["name"]);
		}
		
		#Subject, Body
		if(!empty($frameName)) { $this->frameName = $frameName; }
		$mail->Subject = $this->subject;
		$mail->MsgHTML($this->watch());
		
		#Attachments
		if(!empty($this->attachments))
		{
			foreach($this->attachments AS $attachment)
			{
				$mail->AddAttachment($attachment["path"], $attachment["name"]);
			}
		}
		
		#Send
		$mail->Send();
		
		#Log and Return
		$this->errorInfo = $mail->ErrorInfo;
		$this->mailObject = $mail;
		$logID = $this->log();
		return $logID;
	}
	
	#Log email sent
	public function log($emailID = NULL)
	{
		$model = $this->model;
		$info = [];
		
		if(!empty($this->variables)) { $body = $this->changeHtmlVariable($this->body, $this->variables); }
		else { $body = $this->body; }
		
		$params = [
			"date" => $model->now(), 
			"email" => $emailID, 
			"error" => $this->errorInfo, 
			"subject" => $this->subject, 
			"body" => $body,
			"frameName" => $this->frameName,
			"fromName" => $this->from["name"],
			"fromEmail" => $this->from["email"],
			"replyToName" => $this->replyTo["name"],
			"replyToEmail" => $this->replyTo["email"],
		];
		$lastID = $model->insert($model->tables("sent"), $params);
		$info["params"] = $params;
		$info["email"] = $lastID;
		
		foreach($this->addresses AS $row) 
		{
			$params2 = [
				"sentEmail" => $lastID, 
				"type" => $row["type"], 
				"emailAddress" => $row["email"], 
				"name" => $row["name"]
			];
			$lastAddressID = $model->insert($model->tables("sent_addresses"), $params2);
			
			$email = $row["email"];
			$info["addresses"][$email] = $lastAddressID;
		}
		
		$this->logID = $lastID;
		$this->logInfo = $info;	
		
		if(isset($GLOBALS["log"]))
		{
			$GLOBALS["log"]->log("emails-send", ["int1" => $lastID, "text1" => $GLOBALS["log"]->json($info)]);
		}
		
		return $lastID;
	}
	
	#Newsletter
	public function newsletter($subscribe, $name, $email, $unsubscribeOnFalse = false)
	{
		#Datas
		$return = [
			"workType" => NULL,
			"date" => date("Y-m-d H:i:s"),
			"subscribe" => $subscribe,
			"name" => $name,
			"email" => $email,
			"unsubscribeOnFalse" => $unsubscribeOnFalse,
			"emailData" => NULL,
			"params" => NULL,
			"id" => NULL,
			"rowCount" => 0,
		];
		
		$table = $this->model->tables("newsletter");
		$params = [];
		$return["emailData"] = $emailData = explode("@", $email);
		
		#Process
		if(isset($emailData[1]) AND !empty($emailData[1]))
		{
			$params["site"] = SITE;
			$params["emailUser"] = $emailData[0];
			$params["emailDomain"] = $emailData[1];
			$query = "SELECT * FROM ".$table." WHERE del = '0' AND site = :site AND emailUser = :emailUser AND emailDomain = :emailDomain";
			$rows = $this->model->select($query, $params);
			if(isset($rows[0]) AND isset($rows[0]->id) AND !empty($rows[0]->id)) { $rowsExists = true; }
			else { $rowsExists = false; }
			
			#Subscribe
			if($subscribe)
			{
				#Already has a subscription
				if($rowsExists) 
				{ 
					$return["workType"] = "subscribe-already-exists";
					$return["id"] = $rows[0]->id;
				}
				#NEW subscription
				else 
				{ 
					$return["workType"] = "new-subscribe";
					$params["name"] = $name;
					$params["dateSubscribe"] = $return["date"];
					$return["id"] = $id = $this->model->myInsert($table, $params);
				}
			}
			#Unsubscribe
			elseif(!$subscribe AND $unsubscribeOnFalse)
			{
				#Has subscription --> delete
				if($rowsExists)
				{
					$return["workType"] = "unsubscribe";
					$return["id"] = $rows[0]->id;
					$this->model->myUpdate($table, ["dateUnsubscribe" => $return["date"]], $return["id"]);
					$this->model->myDelete($table, $return["id"]);
				}
				#No subscription
				else 
				{ 
					$return["workType"] = "unsubscribe-subscription-not-exists";
					$params["name"] = $name;
					$return["id"] = $id = $this->model->myInsert($table, $params);
					$this->model->myUpdate($table, ["dateUnsubscribe" => $return["date"]], $return["id"]);
					$this->model->myDelete($table, $return["id"]);
				}
			}
			#Unsubscribe - no permission
			else
			{
				$return["workType"] = "unsubscribe-but-not-allowed";
				if($rowsExists) { $return["id"] = $rows[0]->id; }
			}
		}
		else { $return["workType"] = "invalid-email"; }
		
		$return["params"] = $params;
		
		#Log
		if(isset($GLOBALS["log"]))
		{
			$logParams = [
				"int1" => $return["subscribe"],
				"int2" => $return["id"],
				"vchar1" => $return["workType"],
				"vchar2" => $return["email"],
				"vchar3" => $return["name"],
				"text1" => $GLOBALS["log"]->json($return),
			];
			$GLOBALS["log"]->log("emails-newsletter", $logParams);
		}
		
		#Return
		return $return;
	}
	
	#Newsletter - Email format
	public function newsLetterEmail($user, $domain)
	{
		return trim($user)."@".trim($domain);
	}
	
	#Newsletter - Robinson-list
	public function newsLetterRobinson($dateFrom = NULL, $dateTo = NULL)
	{
		$return = [];
		$rows = $this->model->newsLetterRobinson($dateFrom, $dateTo);
		if(count($rows) > 0)
		{
			foreach($rows AS $row)
			{
				$row->email = $email = $this->newsLetterEmail($row->emailUser, $row->emailDomain);				
				$return[$row->email] = $row;
			}
		}
		
		return $return;
	}
	
	#Newsletter - Rebound-list
	public function newsLetterRebounds()
	{
		$return = [];
		$rows = $this->model->newsLetterRebounds();
		if(count($rows) > 0)
		{
			foreach($rows AS $row)
			{
				$row->email = trim($row->email);		
				$emailData = explode("@", $row->email);
				$row->emailUser = $emailData[0];
				$row->emailDomain = $emailData[1];
				$return[$row->email] = $row;
			}
		}
		
		return $return;
	}
	
	#Newsletter - Invalid-list
	public function newsLetterInvalids()
	{
		$return = [];
		$rows = $this->model->newsLetterInvalids();
		if(count($rows) > 0)
		{
			foreach($rows AS $row)
			{
				$row->email = trim($row->email);		
				$emailData = explode("@", $row->email);
				$row->emailUser = $emailData[0];
				$row->emailDomain = $emailData[1];
				$return[$row->email] = $row;
			}
		}
		
		return $return;
	}
	
	#Newsletter - Get lists
	public function newsLetterList($siteList = [], $userList = false, $dateFrom = NULL, $dateTo = NULL)
	{
		$return = [
			"out" => [],
			"afterSelect" => [],
			"wrongs" => [],
			"invalids" => [],
			"rebounds" => [],
			"unsubscribes" => [],
			"count" => [
				"out" => 0,
				"afterSelect" => 0,
				"wrongs" => 0,
				"invalids" => 0,
				"rebounds" => 0,
				"unsubscribes" => 0,
			],
			"names" => [
				"out" => "E-mail címek [OK]",
				"afterSelect" => "Lekérés utáni e-mail címek",
				"wrongs" => "Rossz e-mail címek (filter)",
				"invalids" => "Rossz e-mail címek (invalid)",
				"rebounds" => "Visszapattanó e-mail címek",
				"unsubscribes" => "Leiratkozott",
			],
		];
		
		#Get datas
		$rows = [];
		if(!empty($siteList)) { $rows = $this->model->newsLetterList($siteList, $dateFrom, $dateTo); }
		if($userList)
		{
			getController("User");
			$users = new UserController();
			$userList = $users->getUsers();

			foreach($userList["all"] AS $userID => $user)
			{
				$emailData = explode("@", $user["email"]);
				$rows[] = (object)[
					"id" => "u".$user["data"]->id,
					"created_at" => $user["data"]->created_at,
					"updated_at" => $user["data"]->updated_at,
					"deleted_at" => $user["data"]->deleted_at,
					"del" => $user["data"]->del,
					"site" => 1,
					"name" => $user["name"],
					"email" => $user["email"],
					"emailUser" => $emailData[0],
					"emailDomain" => $emailData[1],
					"dateSubscribe" => $user["data"]->regDate,
				];
			}
		}

		if(count($rows) > 0)
		{
			#Store after-query data
			$return["afterSelect"] = $rows;
			$return["count"]["afterSelect"] = count($rows);
			
			#Get invalid lists from database
			$invalids = [];
			$invalidRows = $this->model->newsLetterInvalids();
			foreach($invalidRows AS $invalidRow) { $invalids[] = trim($invalidRow->email); }
			
			#Get rebound lists from database
			$rebounds = [];
			$reboundRows = $this->model->newsLetterRebounds();
			foreach($reboundRows AS $reboundRow) { $rebounds[] = trim($reboundRow->email); }
			
			#----------------
			#Rows after query
			$key = "email";
			foreach($rows AS $row)
			{
				$row->email = $email = $this->newsLetterEmail($row->emailUser, $row->emailDomain);				
				
				#If wrong address
				if(!filter_var($email, FILTER_VALIDATE_EMAIL))
				{
					$return["wrongs"][$row->$key] = $row;
					$return["count"]["wrongs"]++;
				}
				#If invalid address
				elseif(in_array($email, $invalids))
				{
					$return["invalids"][$row->$key] = $row;
					$return["count"]["invalids"]++;
				}
				#If rebound address
				elseif(in_array($email, $rebounds))
				{
					$return["rebounds"][$row->$key] = $row;
					$return["count"]["rebounds"]++;
				}
				#IF MAIN CHECKS ARE OK
				else
				{
					$unsubscribes = $this->model->newsLetterUnsubscribes($row->dateSubscribe, $row->emailUser, $row->emailDomain);
					#If email has an unsubscription
					if(count($unsubscribes) > 0) 
					{
						$return["unsubscribes"][$row->$key] = $row;
						$return["count"]["unsubscribes"]++;
					}
					#OKAY
					else
					{
						$return["out"][$row->$key] = $row;
						$return["count"]["out"]++;
					}
				}
			}
		}
		
		return $return;
	}
	
	#New contact
	public function newContact($type, $datas)
	{
		$return = [
			"type" => $type,
			"datas" => $datas,
			"id" => NULL,
			"params" => NULL,
			"fields" => NULL,
		];
		
		#Phone fields
		if(isset($datas["phonePart1"])) { $datas["phone"] = $datas["phonePart1"]." ".$datas["phonePart2"]." ".$datas["phonePart3"]; }
		if(isset($datas["phoneWiredPart3"]) AND !empty($datas["phoneWiredPart3"])) { $datas["phoneWired"] = $datas["phoneWiredPart1"]." ".$datas["phoneWiredPart2"]." ".$datas["phoneWiredPart3"]; }
		
		#Params
		$params = [
			"ip" => $_SERVER["REMOTE_ADDR"],
			"browser" => $_SERVER["HTTP_USER_AGENT"],
			"deviceType" => DEVICE_TYPE,
			"date" => $this->model->now(),
			"site" => SITE,
			"type" => $type,
		];
		
		#Fields
		$return["fields"] = $fields = ["contactType", "subject", "usedCarID", "model", "modelName", "lastName", "firstName", "email", "phone", "phoneWired", "address", "persons", "message", "bodyNumber", "onlinePlatform", "onlinePlatformName", "premiseName"];
		foreach($fields AS $field) 
		{ 
			if(isset($datas[$field])) { $params[$field] = $datas[$field]; }
		}
		
		#Legals
		$return["fields"][] = $fields[] = "legalsContactEmail";
		$return["fields"][] = $fields[] = "legalsContactPhone";
		$params["legalsContactEmail"] = (isset($datas["legalsContactEmail"]) AND $datas["legalsContactEmail"]) ? 1 : 0;
		$params["legalsContactPhone"] = (isset($datas["legalsContactPhone"]) AND $datas["legalsContactPhone"]) ? 1 : 0;
		
		#Tire
		if($type == "tire")
		{
			$params["contactType"] = "ajanlatkeres";
			$return["tire"] = false;
			
			$params["tireID"] = $datas["tire"];
			$return["fields"][] = "tireID";
			if(!empty($params["tireID"])) 
			{
				getController("UsedCar");
				$cars = new UsedCarController();
				if($return["tire"] = $cars->getTire($params["tireID"]))
				{
					$params["tireName"] = $return["tire"]["fullName"];
					$return["fields"][] = "tireName";
					
					$params["tirePrice"] = $return["tire"]["priceOut"];
					$return["fields"][] = "tirePrice";
					
					$params["model"] = $return["tire"]["modelURL"];
					$params["modelName"] = $return["tire"]["model"]->name;
				}
			}
		}
		#Callback
		elseif($type == "callBack") { $params["contactType"] = "visszahivas"; }
		
		#Contact type
		if(isset($params["contactType"]))
		{
			if($params["contactType"] == "tesztvezetes") { $params["contactTypeName"] = "Tesztvezetés"; }
			elseif($params["contactType"] == "ajanlatkeres") { $params["contactTypeName"] = "Ajánlatkérés"; }
			elseif($params["contactType"] == "testdrive") { $params["contactTypeName"] = "Test Drive"; }
			elseif($params["contactType"] == "contact") { $params["contactTypeName"] = "Contact"; }
			elseif($params["contactType"] == "szerviz") { $params["contactTypeName"] = "Szerviz bejelentkezés"; }
			elseif($params["contactType"] == "service") { $params["contactTypeName"] = "Book a service"; }
			elseif($params["contactType"] == "visszahivas") { $params["contactTypeName"] = "Visszahívást kérek!"; }
			else { $params["contactTypeName"] = $params["contactType"]; }
		}
		else
		{
			$params["contactType"] = "kapcsolatfelvetel";
			$params["contactTypeName"] = "Kapcsolatfelvétel";
		}
		
		#Landing page
		if($type == "landingPage" OR $type == "service")
		{
			if(isset($datas["contactTypeName"])) { $params["contactTypeName"] = $datas["contactTypeName"]; }
		}
		
		#Promotion: Service - 2020.02
		if($params["contactType"] == "szerviz-2020febr")
		{
			$params["promotionCode"] = "TAVASZINDITO-20%-";
			while(true)
			{
				$promotionCode = $params["promotionCode"].MyString::random(4, [], ["numbers", "capitalLetters"]);
				$row = $this->model->getContactByPromotionCode($promotionCode);
				if($row AND is_object($row) AND isset($row->id) AND !empty($row->id)) {  }
				else { break; }
			}
			$params["promotionCode"] = $promotionCode;
		}
		
		#Insert
		$return["id"] = $this->model->myInsert($this->model->tables("contacts"), $params);
		$return["params"] = $params;
			
		#Log
		if(isset($GLOBALS["log"]))
		{
			$GLOBALS["log"]->log("emails-contact", ["int1" => $return["id"], "text1" => $this->json($return)]);
		}
		
		return $return;
	}
	
	public function editContact($id, $params)
	{
		return $this->model->myUpdate($this->model->tables("contacts"), $params, $id);
	}
	
	public function getContact($id)
	{
		$row = $this->model->getContact($id);
		if(!isset($row->id) OR empty($row->id)) { $return = false; }
		else
		{
			$return = [];
			$return["data"] = $row;
			$return["id"] = $row->id;
			$return["ip"] = $row->ip;
			$return["browser"] = $row->browser;
			$return["deviceType"] = $row->deviceType;
			$return["site"] = $row->site;
			$return["type"] = $row->type;
			
			$return["date"] = $row->date;
			$return["dateOut"] = date("Y. m. d. H:i", strtotime($row->date));
			
			$return["contactType"] = $row->contactType;
			$return["contactTypeName"] = $row->contactTypeName;
			$return["subject"] = $row->subject;
			
			$return["model"] = $row->model;
			$return["modelName"] = $row->modelName;
			
			$return["tire"] = false;
			$return["tireID"] = $row->tireID;
			$return["tireName"] = $row->tireName;
			$return["tirePrice"] = $row->tirePrice;
			
			$return["lastName"] = $row->lastName;
			$return["firstName"] = $row->firstName;
			$return["email"] = $row->email;
			$return["phone"] = $row->phone;
			$return["phoneWired"] = $row->phoneWired;
			$return["persons"] = $row->persons;
			$return["address"] = $row->address;
			$return["message"] = nl2br($row->message);
			
			$return["bodyNumber"] = $row->bodyNumber;
			$return["promotionCode"] = $row->promotionCode;
			
			$return["legalsContactEmail"] = $row->legalsContactEmail;
			$return["legalsContactPhone"] = $row->legalsContactPhone;
			
			$return["name"] = $return["lastName"]." ".$return["firstName"];
			
			$return["details"] = [
				["name" => "Kapcsolatfelvétel ideje", "value" => $return["dateOut"]],
				["name" => "Telephely", "value" => $return["data"]->premiseName],
				["name" => "Tárgy", "value" => ($return["contactType"] == "szerviz" OR $return["contactType"] == "service") ? $return["contactTypeName"] : ""],
				["name" => "Érdeklődés tárgya", "value" => $return["subject"]],
				["name" => "Név", "value" => $return["name"]],
				["name" => "E-mail cím", "value" => $return["email"]],
				["name" => "Telefonszám", "value" => $return["phone"]],
				["name" => "Vezetékes telefonszám", "value" => $return["phoneWired"]],
				["name" => "Cím", "value" => $return["address"]],
				["name" => "Létszám", "value" => $return["persons"]],
				["name" => "Modell", "value" => $return["modelName"]],
				["name" => "Alvázszám", "value" => $return["bodyNumber"]],
				["name" => "Kuponkód", "value" => $return["promotionCode"]],
				["name" => "Felület", "value" => $return["data"]->onlinePlatform],
				["name" => "Felület azonosító", "value" => $return["data"]->onlinePlatformName],
				// ["name" => "E-mail megkeresés", "value" => ($return["legalsContactEmail"]) ? "IGEN" : "Nem"],
				// ["name" => "Telefonos megkeresés", "value" => ($return["legalsContactPhone"]) ? "IGEN" : "Nem"],
			];
			
			$return["details-en"] = [
				["name" => "Contact time", "value" => $return["dateOut"]],
				["name" => "Premise", "value" => $return["data"]->premiseName],
				["name" => "name", "value" => $return["firstName"]." ".$return["lastName"]],
				["name" => "E-mail address", "value" => $return["email"]],
				["name" => "Phone number", "value" => $return["phone"]],
				["name" => "Wired phone number", "value" => $return["phoneWired"]],
				["name" => "Address", "value" => $return["address"]],
				["name" => "Persons", "value" => $return["persons"]],
				["name" => "Model", "value" => $return["modelName"]],
				["name" => "Body number", "value" => $return["bodyNumber"]],
				["name" => "Promotion code", "value" => $return["promotionCode"]],
				["name" => "Contacted by e-mail", "value" => ($return["legalsContactEmail"]) ? "YES" : "No"],
				["name" => "Contacted by phone", "value" => ($return["legalsContactPhone"]) ? "YES" : "No"],
			];
			
			$return["details2"] = [
				["name" => "E-mail megkeresés (csak angol oldalon!)", "value" => ($return["legalsContactEmail"]) ? "IGEN" : "Nem"],
				["name" => "Telefonos megkeresés (csak angol oldalon!)", "value" => ($return["legalsContactPhone"]) ? "IGEN" : "Nem"],
				["name" => "IP cím", "value" => $return["ip"]],
				["name" => "Böngésző", "value" => $return["browser"]],
				["name" => "Eszköz típusa", "value" => $return["deviceType"]],
				["name" => "Kapcsolatfelvétel azonosító", "value" => "#".$return["id"]],
			];
			
			if($return["type"] == "tire")
			{
				$return["detailsTireUser"] = [
					["name" => "Kerék", "value" => $return["tireName"]],
					["name" => "Kerék ára", "value" => $return["tirePrice"]],
				];
				
				$return["detailsTire"] = [
					["name" => "Megnevezés", "value" => $return["tireName"]],
					["name" => "Ár", "value" => $return["tirePrice"]],
				];
				
				if(!empty($return["tireID"]))
				{
					getController("UsedCar");
					$cars = new UsedCarController();
					$return["tire"] = $tire = $cars->getTire($return["tireID"]);
					
					$return["detailsTire"][] = ["name" => "Modell és kerék", "value" => $tire["name"]];
					$return["detailsTire"][] = ["name" => "Márka", "value" => $tire["brand"]];
					$return["detailsTire"][] = ["name" => "Típus", "value" => $tire["type"]];
					$return["detailsTire"][] = ["name" => "Méret", "value" => $tire["size"]];
					$return["detailsTire"][] = ["name" => "Listaár", "value" => $tire["priceListOut"]];
					$return["detailsTire"][] = ["name" => "Kedvezményes ár", "value" => $tire["priceSaleOut"]];
					$return["detailsTire"][] = ["name" => "Törölt kerék?", "value" => ($tire["data"]->del) ? "IGEN" : "Nem"];
				}
			}
			else { $return["detailsTire"] = $return["detailsTireUser"] = []; }
		}
		
		return $return;
	}
	
	public function getContactsByContactType($contactType)
	{
		$return = [];
		$rows = $this->model->select("SELECT modelName FROM ".$this->model->tables("contacts")." WHERE del = '0' AND contactType = :contactType", ["contactType" => $contactType]);
		foreach($rows AS $row) { $return[] = $row->modelName; }
		return $return;
	}
}
?>