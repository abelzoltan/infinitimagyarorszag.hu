<?php 
$URL->redirect(["szerviz-majus-2020"]);
$VIEW["title"] = "Tavaszindító ajánlatunk"; 
$VIEW["name"] = "pages/".$routes[0];
$VIEW["vars"]["pics"] = CDN_WEB."oldalak/".$routes[0]."/";
$VIEW["meta"]["og:type"] = "article";
$VIEW["sections"]["headBottom"] = ["_inc-swiper"];
?>