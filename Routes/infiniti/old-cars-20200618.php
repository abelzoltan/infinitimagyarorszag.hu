<?php 
if($routes[0] == "approved") 
{
	$VIEW["title"] = "Ellenőrzött használt autók<br>/ INFINITI APPROVED"; 
	$VIEW["meta"]["description"] = "INFINITI APPROVED. Használt INFINITI megbízhatóan!";
	$type = 2;
}
else
{
	$VIEW["title"] = "Készleten lévő autóink"; 
	$VIEW["meta"]["description"] = "Fedezze fel az Infiniti készletes luxusautó modellek skáláját, a sportszedán, luxus limuzin és crossover választékát.";
	$type = 1;
}

$VIEW["meta"]["og:type"] = "product.group";
$VIEW["name"] = "oldcars-list";

$model = (isset($_GET["model"]) AND !empty($_GET["model"])) ? $_GET["model"] : NULL;
getController("Hasznaltauto");
$hil = new HasznaltautoController;
$VIEW["vars"]["carList"] = $hil->getCars($type, $model, 1);

#Tenmedia pixels
$VIEW["vars"]["TENMEDIA_PID"] = (isset($_GET["model"])) ? $_GET["model"] : "";
$VIEW["vars"]["TENMEDIA_CAT"] = $routes[0];
$VIEW["sections"]["bodyBottom"] = ["_pixels_tenmedia_category"];
?>