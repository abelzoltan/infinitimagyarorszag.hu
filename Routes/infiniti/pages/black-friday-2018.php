<?php 
$URL->redirect(["q30"]); // 20181128 Máté
$VIEW["title"] = "Black Friday Sale"; 
$VIEW["meta"]["description"] = "Most minden készleten lévő fekete autó mellé téli gumit adunk ajándékba.";
$VIEW["meta"]["og:type"] = "product.group";
$VIEW["name"] = "pages/".$routes[0];
$VIEW["vars"]["pics"] = CDN_WEB."oldalak/".$routes[0]."/";
$VIEW["vars"]["mainHeaderShow"] = false;

$carListOriginal = $cars->getCars("stock", NULL);
$VIEW["vars"]["carList"] = ["active" => []];
$blackCars = ["q30-15d-business-7dct-2wd", "22d-awd-7dct-premium-city-black", "22d-awd-7dct-premium-city-black-2", "20t-awd-7dct-sport", "20t-7at-rwd-premium", "22d-awd-7dct-premium", "qx30-22d-premium-gac-g-bose-napfenyteto", "22d-premium-tech"];
foreach($carListOriginal["active"] AS $carKey => $car)
{
	if(in_array($car["url"], $blackCars)) { $VIEW["vars"]["carList"]["active"][$carKey] = $car; }
}

#Tenmedia pixels
// $VIEW["vars"]["TENMEDIA_PID"] = (isset($_GET["model"])) ? $_GET["model"] : '';
// $VIEW["vars"]["TENMEDIA_CAT"] = $routes[0];
// $VIEW["sections"]["bodyBottom"] = ["_pixels_tenmedia_category"];
?>