<?php
#Settings
include("settings.php");

#View basic settings
$VIEW = [];
$VIEW["title"] = "";
$VIEW["titlePrefix"] = $site->data->titlePrefix;
$VIEW["titleSuffix"] = $site->data->titlePrefix;
$VIEW["frame"] = "infiniti"; 
$VIEW["vars"] = [];
$VIEW["sections"] = [
	"content" => [],
	"headTop" => [],
	"headBottom" => [],
	"bodyTop" => [],
	"bodyBottom" => [],
];
$VIEW["meta"] = [
	"keywords" => "",
	"description" => "",
	"og:title" => "",
	"og:image" => "",
	"og:description" => "",
	"og:site_name" => $site->address,
	"og:type" => "website",
	"og:url" => $URL->currentURL,
];

#Routes
$GLOBALS["routes"] = $routes = $URL->routes;
include(DIR_ROUTES.$site->routes);

#View
$GLOBALS["VIEW"] = $VIEW;
if(viewExists($VIEW["frame"])) { getView($VIEW["frame"], ["VIEW" => $VIEW]); }
?>