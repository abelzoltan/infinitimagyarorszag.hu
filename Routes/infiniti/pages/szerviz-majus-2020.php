<?php 
$URL->redirect(["eien"]);
$VIEW["title"] = "Infiniti Eien - a korral nem öregszik"; 
$VIEW["name"] = "pages/".$routes[0];
$VIEW["vars"]["pics"] = CDN_WEB."oldalak/".$routes[0]."/";
$VIEW["meta"]["og:type"] = "article";
$VIEW["sections"]["headBottom"] = ["_inc-swiper"];
?>