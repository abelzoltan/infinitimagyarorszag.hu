<?php 
if($routes[0] == "approved") 
{
	$VIEW["title"] = "Ellenőrzött használt autók<br>/ INFINITI APPROVED"; 
	$VIEW["meta"]["description"] = "INFINITI APPROVED. Használt INFINITI megbízhatóan!";
	$type = $routes[0]; // old
	$typeID = 2;
}
else
{
	$VIEW["title"] = "Készleten lévő autóink"; 
	$VIEW["meta"]["description"] = "Fedezze fel az Infiniti készletes luxusautó modellek skáláját, a sportszedán, luxus limuzin és crossover választékát.";
	$type = "stock"; // old
	$typeID = 1;
}

$VIEW["meta"]["og:type"] = "product.group";
$VIEW["name"] = "oldcars-list";

$modelID = (isset($_GET["model"])) ? $cars->model->getModelByURL($_GET["model"], "id") : NULL;
$VIEW["vars"]["carList"] = $cars->getCars($type, $modelID); // old
if(isset($_GET["new"]) AND $_GET["new"]) 
{
	getController("Hasznaltauto");
	$hil = new HasznaltautoController;
	$VIEW["vars"]["carList"] = $hil->getCars($typeID, $modelID, 1);
}

#Tenmedia pixels
$VIEW["vars"]["TENMEDIA_PID"] = (isset($_GET["model"])) ? $_GET["model"] : '';
$VIEW["vars"]["TENMEDIA_CAT"] = $routes[0];
$VIEW["sections"]["bodyBottom"] = ["_pixels_tenmedia_category"];
?>