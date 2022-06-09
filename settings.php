<?php
#Information
	#minimum version of PHP: 5.4 because the use of '[]' insted of 'array()'
	#htaccess: it returns the full path (before the '?' signal) AS a string in variable '$_GET["htaccess-path"]'
	
#Basic settings
ini_set("display_errors", 0);
ini_set("log_errors", 0);
error_reporting(E_ERROR | E_PARSE);
session_start();	
header("Content-Type: text/html; charset=utf-8");
setlocale(LC_ALL, "hu_HU.UTF-8");
date_default_timezone_set("Europe/Budapest");

#Default database
define("MYSQL_HOST", "localhost");
define("MYSQL_PORT", "");
define("MYSQL_DB", "gablini_infiniti");
define("MYSQL_USERNAME", "gablini_infiniti_usr");
define("MYSQL_PASSWORD", "Rxds82&1");
define("MYSQL_PREFIX", "");

#Pathes of the root directory
define("PATH_ROOT", __DIR__."/");
define("PATH_ROOT_WEB", "https://".$_SERVER["SERVER_NAME"]."/");

#Directories
define("DIR_CLASSES", PATH_ROOT."Classes/");
define("DIR_CLASSES_WEB", PATH_ROOT_WEB."Classes/");
define("DIR_CONTROLLERS", PATH_ROOT."Controllers/");
define("DIR_CONTROLLERS_WEB", PATH_ROOT_WEB."Controllers/");
define("DIR_MODELS", PATH_ROOT."Models/");
define("DIR_MODELS_WEB", PATH_ROOT_WEB."Models/");
define("DIR_PUBLIC", PATH_ROOT."public/");
define("DIR_PUBLIC_WEB", PATH_ROOT_WEB);
define("DIR_ROUTES", PATH_ROOT."Routes/");
define("DIR_ROUTES_WEB", PATH_ROOT_WEB."Routes/");
define("DIR_VIEWS", PATH_ROOT."Views/");
define("DIR_VIEWS_WEB", PATH_ROOT_WEB."Views/");

#CDN [for files]
define("CDN", DIR_PUBLIC."cdn/");
define("CDN_WEB", DIR_PUBLIC_WEB."cdn/");

#Email variables
define("INFINITI_GABLINI", "Infiniti Center Budapest");
define("EMAIL_FROM_EMAIL", "noreply@".$_SERVER["SERVER_NAME"]);
define("EMAIL_FROM_NAME", INFINITI_GABLINI);
define("EMAIL_REPLYTO_EMAIL", NULL);
define("EMAIL_REPLYTO_NAME", NULL);
define("SMTP_ON", false);
define("SMTP_AUTH", false);
define("SMTP_SECURE", "tls");
define("SMTP_HOST", "");
define("SMTP_PORT", "587");
define("SMTP_USERNAME", "");
define("SMTP_PASSWORD", "");

#Recaptcha settings
define("RECAPTCHA_SITE_KEY", "6LfP6N4UAAAAACvLGYL-yEddIzJNdbA22jW0kDTY"); // 6LfcUBAUAAAAADgteIhCPJXEnSorp0ygBQ-oPnlT
define("RECAPTCHA_SECRET_KEY", "6LfP6N4UAAAAAHjf1DTnOoZuaaPTup7aA_a_MTDW");

#Include functions
function myInclude($name, $dir, $vars, $functionName)
{
	$return = [];
	$return["path"] = $path = $dir.$name;
	if(count($vars) > 0) { foreach($vars AS $key => $val) { $$key = $val; } }
	switch($functionName)
	{
		case "require":
			$return["include"] = require($path);
			break;
		case "require_once":
			$return["include"] = require_once($path);
			break;
		case "include":
			$return["include"] = include($path);
			break;	
		default:	
			$return["include"] = include_once($path);
			break;
	}
	return $return;
}
function getClass($name, $vars = [], $functionName = "") { return myInclude($name.".php", DIR_CLASSES, $vars, $functionName); }
function getController($name, $vars = [], $functionName = "") { return myInclude($name."Controller.php", DIR_CONTROLLERS, $vars, $functionName); }
function getControllerFullName($name, $vars = [], $functionName = "") { return myInclude($name.".php", DIR_CONTROLLERS, $vars, $functionName); }
function getModel($name, $vars = [], $functionName = "") { return myInclude($name.".php", DIR_MODELS, $vars, $functionName); }
function getView($name, $vars = [], $functionName = "") { return myInclude($name.".php", DIR_VIEWS, $vars, $functionName); }
function getPublic($name, $vars = [], $functionName = "") { return myInclude($name.".php", DIR_PUBLIC, $vars, $functionName); }

#Path and View functions
function publicPath($path = "", $web = true)
{
	if($web) { $return = DIR_PUBLIC_WEB; }
	else { $return = DIR_PUBLIC; }
	
	$return .= $path;
	return $return;
}

function viewExists($path)
{
	if(empty($path)) { $return = false; }
	else { $return = file_exists(DIR_VIEWS.$path.".php"); }
	return $return;
}

function setLink($string, $path = NULL)
{
	$link = mb_convert_case($string, MB_CASE_LOWER, "utf-8");
	if($path === NULL) { $path = PATH_WEB; }
	
	$return = $link;
	if(mb_substr($link, 0, 7, "utf-8") == "http://") {  }
	elseif(mb_substr($link, 0, 8, "utf-8") == "https://") {  }
	elseif(mb_substr($link, 0, 2, "utf-8") == "//") {  }
	elseif(mb_substr($link, 0, 7, "utf-8") == "ftp://") {  }
	elseif(mb_substr($link, 0, 7, "utf-8") == "ftps://") {  }
	elseif(mb_substr($link, 0, 1, "utf-8") == "#") { $return = $link; }
	else { $return = $path.$link; }
	
	return $return;
}

#Other functions
function csrf_field()
{
	$chars = array_merge(range(0, 9), range("a", "z"), range("A", "Z"));
	$token = "oFdzyYqr8f";
	for($i = 0; $i < 10; $i++) { $token .= $chars[mt_rand(0, count($chars) - 1)]; }
	$token .= "VdhmkuTPut";
	return '<input type="hidden" name="_token" value="'.sha1($token).'">';
}
#Basic classes
getClass("URL", [], "require");
getClass("MyString", [], "include");
getClass("DB", [], "require");
getModel("Base", [], "require");
getController("Base", [], "require");
# ------------------------------------------------------------------------------------------------------------------------------------------------------------------------
#HTAccess and Root URL
$GLOBALS["htaccessPath"] = $_GET["htaccess-path"];
unset($_GET["htaccess-path"]);

$GLOBALS["rootURL"] = $rootURL = new URL(true, PATH_ROOT, PATH_ROOT_WEB, NULL);

#Site data
getController("Site", [], "include");
$GLOBALS["site"] = $site = new SiteController();
define("SITE", $site->data->id);
define("PATH", PATH_ROOT.$site->baseName);
define("PATH_WEB", PATH_ROOT_WEB.$site->baseName);

$GLOBALS["URL"] = $URL = new URL(true, PATH, PATH_WEB, $site);
define("SESSION_PREFIX", $site->data->sessionPrefix);

#Visited Pages
define("VISITED_PAGES", SESSION_PREFIX."siteVisitedPages");
if(!isset($_SESSION[VISITED_PAGES])){ $_SESSION[VISITED_PAGES] = []; }
$_SESSION[VISITED_PAGES][] = [
	"date" => date("Y-m-d H:i:s"),
	"siteID" => $site->data->id,
	"url" => $URL,
];

#Mobile Detect (device type)
if(getClass("MobileDetect/Mobile_Detect"))
{
	$mobileDetect = new Mobile_Detect;
	if($mobileDetect->isMobile()) { $deviceType = "mobile"; }
	elseif($mobileDetect->isTablet()) { $deviceType = "tablet"; }
	else { $deviceType = "pc"; }
}
else { $deviceType = NULL; }
define("DEVICE_TYPE", $deviceType);

#User [optional]
getController("User", [], "include");
$GLOBALS["users"] = $users = new UserController();
if($_SESSION[USER_LOGGED_IN]) 
{ 
	$users->activity(); 
	$GLOBALS["user"] = $users->getUser(); 
}

#Log
getController("Mylog", [], "include");
$GLOBALS["log"] = $log = new MylogController();
$log->log("pageload", ["text1" => $log->json($URL->routes), "text2" => $log->json($_GET)]);

#Other database connection [optional]
$dbGablini = [
	"host" => MYSQL_HOST, 
	"port" => MYSQL_PORT, 
	"database" => "gablini_2016", 
	"username" => "gablini_2016_usr", 
	"password" => "4h#2Sd5b",
];

$dbGabliniOld = [
	"host" => MYSQL_HOST, 
	"port" => MYSQL_PORT, 
	"database" => "gablini_web", 
	"username" => "gablini_web_usr", 
	"password" => "?U90dh42Hi33ddt!",
];

#Email addresses
getController("WebAddress", [], "include");
$webAddresses = new WebAddressController($dbGablini);
$addressList = $webAddresses->getAddressesForSendingByURL("weboldalak-egyeb-kapcsolatfelvetel-infiniti");
$GLOBALS["EMAIL_ADDRESSES"] = $addressList["all"];
?>