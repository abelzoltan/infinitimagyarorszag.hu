<?php 
if($routes[0] == "approved") 
{
	$VIEW["title"] = "Ellenőrzött használt autók<br>/ INFINITI APPROVED"; 
	$VIEW["meta"]["description"] = "INFINITI APPROVED. Használt INFINITI megbízhatóan!";
	$hilType = 2;
	$hexType = "infiniti-hasznalt";
}
elseif($routes[0] == "q30-keszletakcio")
{
	$VIEW["title"] = "Q30 készletakció"; 
	$VIEW["meta"]["description"] = "Fedezze fel az Infiniti Q30 készletes luxusautó modellek skáláját!";
	$hilType = 1;
	$hexType = "infiniti-keszlet";
}
else
{
	$VIEW["title"] = "Készleten lévő autóink"; 
	$VIEW["meta"]["description"] = "Fedezze fel az Infiniti készletes luxusautó modellek skáláját, a sportszedán, luxus limuzin és crossover választékát.";
	$hilType = 1;
	$hexType = "infiniti-keszlet";
}

$VIEW["meta"]["og:type"] = "product.group";
$VIEW["name"] = ($routes[0] == "q30-keszletakcio") ? "oldcars-list-q30-2020jul" : "oldcars-list";

getController("Hex");
$hex = new HexController($dbGablini);
$search = (isset($_GET["model"]) AND !empty($_GET["model"])) ? ["name" => $_GET["model"]] : [];
$VIEW["vars"]["carList"] = $hex->getCarsByType($hexType, $search);


/*$model = (isset($_GET["model"]) AND !empty($_GET["model"])) ? $_GET["model"] : NULL;
getController("Hasznaltauto");
$hil = new HasznaltautoController;
$VIEW["vars"]["carList"] = $hil->getCars($hilType, $model, 1);*/

#Tenmedia pixels
$VIEW["vars"]["TENMEDIA_PID"] = (isset($_GET["model"])) ? $_GET["model"] : "";
$VIEW["vars"]["TENMEDIA_CAT"] = $routes[0];
$VIEW["sections"]["bodyBottom"] = ["_pixels_tenmedia_category"];
?>