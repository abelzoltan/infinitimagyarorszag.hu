<?php 
#View data
$VIEW["title"] = "Új és készletes autóink"; 
$VIEW["meta"]["description"] = "Fedezze fel az Infiniti készletes luxusautó modellek skáláját, a sportszedán, luxus limuzin és crossover választékát.";
$VIEW["meta"]["og:type"] = "product.group";
$VIEW["name"] = "home";
$VIEW["vars"]["mainHeaderShow"] = false;
$VIEW["vars"]["pics"] = CDN_WEB."oldalak/kezdolap/";

#New cars
$VIEW["vars"]["newCarList"] = $cars->getModels();

#Used cars
$model = (isset($_GET["model"]) AND !empty($_GET["model"])) ? $_GET["model"] : NULL;
getController("Hasznaltauto");
$hil = new HasznaltautoController;
$VIEW["vars"]["oldCarList"] = $hil->getCars(1, $model, 1);

#Tenmedia pixels
$VIEW["vars"]["TENMEDIA_PID"] = (isset($_GET["model"])) ? $_GET["model"] : '';
$VIEW["vars"]["TENMEDIA_CAT"] = "stock";
$VIEW["sections"]["headBottom"] = ["_inc-swiper"];
// $VIEW["sections"]["bodyBottom"] = ["_pixels_tenmedia_category"];
?>