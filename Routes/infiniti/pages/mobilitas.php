<?php 
$VIEW["title"] = "<span style='line-height: 140%;'><strong>Mobilitás</strong></span>"; 
$VIEW["name"] = "pages/".$routes[0];
$VIEW["vars"]["pics"] = CDN_WEB."oldalak/".$routes[0]."/";
$VIEW["meta"]["og:type"] = "article";

getController("UsedCar");
$cars = new UsedCarController;
$VIEW["vars"]["models"] = $cars->getModelsForSelect("url");
?>