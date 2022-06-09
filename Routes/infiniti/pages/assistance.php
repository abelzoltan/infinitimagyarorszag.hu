<?php 
if(!isset($_GET["belepes"]) OR !$_GET["belepes"]) { $URL->redirect(); }

$VIEW["title"] = "<span style='line-height: 140%;'><strong>Infiniti Assitance</strong></span>"; 
$VIEW["name"] = "pages/".$routes[0];
$VIEW["vars"]["pics"] = CDN_WEB."oldalak/".$routes[0]."/";
$VIEW["vars"]["FORM_ADDRESS"] = $VIEW["vars"]["FORM_PERSONS"] = false;
$VIEW["meta"]["og:type"] = "article";
?>