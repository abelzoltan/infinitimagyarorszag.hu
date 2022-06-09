<?php 
$VIEW["title"] = "EXKLUZÍV TÉLIKERÉK AJÁNLATAINK"; 
$VIEW["name"] = "pages/".$routes[0];
$VIEW["vars"]["pics"] = CDN_WEB."oldalak/".$routes[0]."/";
$VIEW["meta"]["og:type"] = "article";

$cars->tirePicSrc = $VIEW["vars"]["pics"];
$VIEW["vars"]["tires"] = $cars->getTires();
?>