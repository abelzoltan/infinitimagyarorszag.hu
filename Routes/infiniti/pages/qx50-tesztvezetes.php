<?php 
$URL->redirect();

$VIEW["title"] = "<span style='line-height: 140%;'><strong>Infiniti QX50</strong></span>"; 
$VIEW["name"] = "pages/".$routes[0];
$VIEW["vars"]["pics"] = CDN_WEB."oldalak/".$routes[0]."/";
$VIEW["vars"]["FORM_ADDRESS"] = $VIEW["vars"]["FORM_PERSONS"] = false;
$VIEW["meta"]["og:type"] = "article";
?>