<?php 
$URL->redirect();

$VIEW["title"] = "<span style='line-height: 140%;'><strong>INFINITI ÉLMÉNYNAP</strong></span>"; 
$VIEW["name"] = "pages/".$routes[0];
$VIEW["vars"]["pics"] = CDN_WEB."oldalak/".$routes[0]."/";
$VIEW["vars"]["FORM_ADDRESS"] = $VIEW["vars"]["FORM_PERSONS"] = true;
$VIEW["meta"]["og:type"] = "article";
?>