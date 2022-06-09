<?php 
$VIEW["title"] = $car["name"]; 
$VIEW["meta"]["description"] = $car["shortTextComma"];
$VIEW["meta"]["keywords"] .= ", ".$car["name"];
$VIEW["meta"]["og:type"] = "product.item";
// if($car["hasPic"]) { $VIEW["meta"]["og:image"] = $car["defaultPic"]; }
if($car["hasPic"]) { $VIEW["meta"]["og:image"] = $car["pic"]; }
$VIEW["name"] = "oldcars-details-hex";
$VIEW["vars"]["formType"] = "oldCar";

$VIEW["sections"]["bodyBottom"][] = "_fancybox-new";
$VIEW["sections"]["bodyBottom"][] = $viewsDir."details-js-oldcar";

#Tenmedia pixels
// $VIEW["vars"]["TENMEDIA_PID"] = $routes[0];
// $VIEW["sections"]["bodyBottom"][] = "_pixels_tenmedia_product";
?>