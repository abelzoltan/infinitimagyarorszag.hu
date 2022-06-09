<?php 
$VIEW["title"] = $car["name"]; 
$VIEW["meta"]["description"] = $car["shortText"];
$VIEW["meta"]["keywords"] .= ", ".$car["name"];
$VIEW["meta"]["og:type"] = "product.item";
if($car["pic"] !== false) { $VIEW["meta"]["og:image"] = $car["picSrc"]; }
$VIEW["name"] = "oldcars-details";
$VIEW["vars"]["formType"] = "oldCar";

$VIEW["sections"]["bodyBottom"][] = "_fancybox";
$VIEW["sections"]["bodyBottom"][] = $viewsDir."details-js";
$VIEW["sections"]["bodyBottom"][] = $viewsDir."details-js-oldcar";

#Tenmedia pixels
$VIEW["vars"]["TENMEDIA_PID"] = $routes[0];
$VIEW["sections"]["bodyBottom"][] = "_pixels_tenmedia_product";
?>