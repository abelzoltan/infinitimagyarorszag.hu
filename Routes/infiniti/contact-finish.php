<?php 
if(isset($_SESSION[SESSION_PREFIX."emailContact"]))
{
	if($routes[0] == "contact-thank-you") 
	{
		$VIEW["title"] = "Fill in success"; 
		$VIEW["name"] = "contact-finish";
		$VIEW["meta"]["description"] = "The fill-in is success!";
	}
	else
	{
		$VIEW["title"] = "Sikeres űrlapkitöltés"; 
		$VIEW["name"] = "contact-finish";
		$VIEW["meta"]["description"] = "Az űrlap kitöltése sikeresen megtörtént!";
	}
	
	$contact = $VIEW["vars"]["contact"] = $_SESSION[SESSION_PREFIX."emailContact"];
	if(!empty($contact["data"]->usedCarID)) { $VIEW["vars"]["car"] = $cars->getCar($contact["data"]->usedCarID); }
	if(!empty($contact["model"])) 
	{ 
		$VIEW["vars"]["pic"] = CDN_WEB."uj-autok/".$contact["model"]."/fokep.jpg"; 
		if($contact["model"] == "q30" OR $contact["model"] == "q50")
		{
			$VIEW["vars"]["ADFORM_PAGENAME"] = "infiniti_".$contact["model"]."_conversion";
			$VIEW["sections"]["headBottom"][] = "_adform_tracking_conversion_2019";
		}
	}
	unset($_SESSION[SESSION_PREFIX."emailContact"]);
	
	$VIEW["vars"]["TENMEDIA_TRANSID"] = $VIEW["vars"]["ADFORM_PRODUCTID"] = $contact["id"];
	// $VIEW["sections"]["bodyBottom"] = ["_pixels_tenmedia_contact_finish"];
	$VIEW["sections"]["headBottom"][] = "_adform_tracking_conversion";
	$VIEW["sections"]["headBottom"][] = "_pixels_taboola_contact_finish";
}
else { $URL->header(PATH_WEB); }
?>