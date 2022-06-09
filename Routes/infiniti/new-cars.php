<?php 
$VIEW["title"] = "Autók"; 
$VIEW["meta"]["description"] = "Infiniti modellek";
$VIEW["meta"]["og:type"] = "product.group";
$VIEW["name"] = "newcars-list";
$VIEW["vars"]["carList"] = $cars->getModels();

#Tenmedia pixels
$VIEW["vars"]["TENMEDIA_PID"] = "q30,q50,q60,qx30";
$VIEW["vars"]["TENMEDIA_CAT"] = $routes[0];
// $VIEW["sections"]["bodyBottom"] = ["_pixels_tenmedia_category"];
?>