<?php 
#Basic
define("INFINITI_HU", "https://www.infiniti.hu/");
define("INFINITI_STOCK", PATH_WEB);
define("INFINITI_GABLINI_HU", INFINITI_STOCK);
define("INFINITI_APPROVED", PATH_WEB."approved/");

define("INFINITI_VIEWS", DIR_VIEWS."infiniti/");
$viewsDir = "infiniti/";
$routesDir = DIR_ROUTES."infiniti/";
$VIEW["vars"]["mainHeaderShow"] = true;
$VIEW["vars"]["mainHeaderMenusShow"] = true;
$VIEW["vars"]["mainLang"] = "hu";
$VIEW["vars"]["formType"] = "general";

getController("File");
getController("UsedCar");
$cars = new UsedCarController();

#Popup
getController("Notification");
$notifications = new NotificationController();
$VIEW["vars"]["notificationPopup"] = $notifications->getPopup();

#Meta
$VIEW["meta"]["keywords"] = "Infiniti, Készlet, Modellek, Luxusautó, Luxus, Választék, Skála";
$VIEW["meta"]["twitter:card"] = "summary";
$VIEW["meta"]["og:image"] = DIR_PUBLIC_WEB."pics/logo.jpg";
$VIEW["meta"]["description"] = "Ismerje meg az INFINITI modelleket.";

#Tenmedia pixels - basic
// $VIEW["sections"]["bodyBottom"] = ["_pixels_tenmedia_other"];

#Routing
switch($routes[0])
{
	#Home
	case $site->data->homepageURL:
		$URL->redirect();
		break;
	case "":
	case NULL:
		include($routesDir."home.php");
		break;	
	#Infiniti Approved
	case "approved":
		$URL->redirect(["keszleteink"]);
		break;
	case "keszleteink":
	case "q30-keszletakcio":
		include($routesDir."old-cars.php");
		break;
	#Cookies
	case "sutik-elfogadasa":
		include($routesDir."cookies.php");
		break;
	#Callback session
	case "visszahivas-ablak":
		include($routesDir."callback.php");
		break;	
	#Coronavirus session
	case "koronavirus-ablak":
		include($routesDir."coronavirus.php");
		break;		
	#User e-mail
	case "munkatars-emailek":
		include($routesDir."userEmails.php");
		break;		
	# -------------------------------------------------------------------------------------------------------------------------------------
	#New car list
	case "uj-autok":
		$URL->redirect();
		include($routesDir."new-cars.php");
		break;	
	#New car details
	case "q30":
	case "q50":
	case "q60":
	case "qx30":
	case "qx50": // TEMP??
	case "qx60": // TEMP??
		$URL->redirect();
		include($routesDir."new-cars-details.php");
		break;
	#New car details ENGLISH: Q30, Q50	
	case "q30-en":
	case "q50-en":
		include($routesDir."new-cars-details-en.php");
		break;	
	# -------------------------------------------------------------------------------------------------------------------------------------	
	case "munkatarsak":
		include($routesDir."users.php");
		break;	
	case "infiniti-center-kereso":
		include($routesDir."maps.php");
		break;		
	case "letoltes":
		$URL->redirect();
		include($routesDir."download.php");
		break;
	case "hirek":
		$URL->redirect();
		include($routesDir."news.php");
		break;	
	# -------------------------------------------------------------------------------------------------------------------------------------		
	#Contact (form)
	case "tesztvezetes":
		$URL->redirect("kapcsolatfelvetel");
		break;
	case "kapcsolatfelvetel":
	case "kapcsolatfelvetel-landolo":
	case "kapcsolatfelvetel-kerek":
	case "kapcsolatfelvetel-szerviz":
	case "visszahivas":
	case "contact":
		include($routesDir."contact.php");
		break;
	#Contact (form)	- Thank you page
	case "ajanlatkeres-koszonjuk":
	case "tesztvezetes-koszonjuk":
	case "kapcsolatfelvetel-koszonjuk":
	case "szerviz-koszonjuk":
	case "visszahivas-koszonjuk":
	case "contact-thank-you":
		include($routesDir."contact-finish.php");
		break;	
	# -------------------------------------------------------------------------------------------------------------------------------------		
	default:
		include($routesDir."_default.php");
		break;	
}

#Meta (clone)
$VIEW["meta"]["og:title"] = $VIEW["title"];
$VIEW["meta"]["twitter:title"] = $VIEW["title"];

$VIEW["meta"]["og:description"] = $VIEW["meta"]["description"];
$VIEW["meta"]["twitter:description"] = $VIEW["meta"]["description"];

#"Content" section
$GLOBALS["site"]->name = $site->name = "infiniti";
if(file_exists(DIR_ROUTES."_inc-view-section-content.php")) { include(DIR_ROUTES."_inc-view-section-content.php"); }
?>