<?php
#Model row
$model = $cars->model->getModelByURL($routes[0], "", 0);

#Submenu
$VIEW["vars"]["carMenu"] = [
	"-" => [
		"url" => PATH_WEB.$routes[0],
		"name" => $model->name,
	],
];	
if($model->url == "q30" OR $model->url == "q50" OR $model->url == "qx30")
{
	$VIEW["vars"]["carMenu"]["teljesitmeny"] = [
		"url" => PATH_WEB.$routes[0]."/teljesitmeny",
		"name" => "Teljesítmény",
	];
	$VIEW["vars"]["carMenu"]["formavilag"] = [
		"url" => PATH_WEB.$routes[0]."/formavilag",
		"name" => "Formavilág",
	];
	$VIEW["vars"]["carMenu"]["biztonsag"] = [
		"url" => PATH_WEB.$routes[0]."/biztonsag",
		"name" => "Biztonság",
	];
	$VIEW["vars"]["carMenu"]["csatlakoztathatosag"] = [
		"url" => PATH_WEB.$routes[0]."/csatlakoztathatosag",
		"name" => "Csatlakoztathatóság",
	];
	$VIEW["vars"]["carMenu"]["tartozekok"] = [
		"url" => PATH_WEB.$routes[0]."/tartozekok",
		"name" => "Tartozékok",
	];
}
elseif($model->url == "qx50")
{
	$VIEW["vars"]["carMenu"]["teljesitmeny"] = [
		"url" => PATH_WEB.$routes[0]."/teljesitmeny",
		"name" => "Teljesítmény",
	];
	$VIEW["vars"]["carMenu"]["innovacio"] = [
		"url" => PATH_WEB.$routes[0]."/innovacio",
		"name" => "Innováció",
	];
	$VIEW["vars"]["carMenu"]["formaterv"] = [
		"url" => PATH_WEB.$routes[0]."/formaterv",
		"name" => "Formaterv",
	];
	$VIEW["vars"]["carMenu"]["biztonsag"] = [
		"url" => PATH_WEB.$routes[0]."/biztonsag",
		"name" => "Biztonság",
	];
	$VIEW["vars"]["carMenu"]["galeria"] = [
		"url" => PATH_WEB.$routes[0]."/galeria",
		"name" => "Galéria",
	];
}
elseif($model->url == "qx60")
{
	$VIEW["vars"]["carMenu"]["formavilag"] = [
		"url" => PATH_WEB.$routes[0]."/formavilag",
		"name" => "Formavilág",
	];	
	$VIEW["vars"]["carMenu"]["galeria"] = [
		"url" => PATH_WEB.$routes[0]."/galeria",
		"name" => "Galéria",
	];
	$VIEW["vars"]["carMenu"]["biztonsag"] = [
		"url" => PATH_WEB.$routes[0]."/biztonsag",
		"name" => "Biztonság",
	];
}

$VIEW["vars"]["carMenu"]["ajanlatkeres"] = [
	"url" => PATH_WEB.$routes[0]."/ajanlatkeres",
	"name" => "Ajánlatkérés / Tesztvezetés",
];
$VIEW["vars"]["carMenu"]["aktualis-keszletunk"] = [
	"url" => PATH_WEB."/keszleteink?model=".$model->url,
	"name" => $VIEW["vars"]["carMenu"]["-"]["name"]." készletünk",
];
/*$VIEW["vars"]["carMenu"]["hasznalt-modellek"] = [
	"url" => PATH_WEB."/approved?model=".$model->url,
	"name" => "Használt ".$model->name,
];*/

#Redirect, Active submenu, Accessories
$VIEW["vars"]["carMenuActive"] = "-";
if(isset($routes[1]) AND !empty($routes[1]))
{
	if(in_array($routes[1], array_keys($VIEW["vars"]["carMenu"]))) 
	{ 
		#Active menu
		$VIEW["vars"]["carMenuActive"] = $routes[1]; 
		
		#Accessories
		if($routes[1] == "tartozekok" AND !empty($model->carID))
		{
			$json = file_get_contents("https://gablini.hu/json-export-uj-autok-tartozekok/".$model->carID."?azonosito=4TUJiYnTzedEquyZvFs6");
			$VIEW["vars"]["carAccessories"] = json_decode($json, JSON_UNESCAPED_UNICODE);
		}
	}
	else { $URL->redirect($routes[0]); }
}
	
#Tenmedia pixels
// $VIEW["vars"]["TENMEDIA_PID"] = $routes[0];
// $VIEW["sections"]["bodyBottom"][] = "_pixels_tenmedia_product";

#Adform tracking conversion
if($model->url == "q30" OR $model->url == "q50")
{
	$VIEW["vars"]["ADFORM_PAGENAME"] = "infiniti_".$model->url."_global";
	$VIEW["sections"]["bodyBottom"][] = "_adform_tracking_conversion_2019";
}

#Landing details
$VIEW["title"] = "Infiniti ".$model->name; 
$VIEW["meta"]["description"] = $model->description;	
$VIEW["vars"]["pics"] = CDN_WEB."uj-autok/".$routes[0]."/";
$VIEW["meta"]["og:type"] = "product.item";
$VIEW["name"] = "new-cars/".$model->url; 
$VIEW["sections"]["bodyBottom"][] = "_fancybox-new";

$VIEW["vars"]["modelName"] = $model->name;
$VIEW["vars"]["currentModel"] = $model;
$VIEW["vars"]["formType"] = "newCar";
?>