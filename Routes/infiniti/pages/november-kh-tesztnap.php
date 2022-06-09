<?php 
$URL->redirect();

$VIEW["title"] = "<span style='line-height: 140%;'><strong>INFINITI tesztvezetés hét a K&H-nál</strong></span>"; 
$VIEW["name"] = "pages/".$routes[0];
$VIEW["vars"]["pics"] = CDN_WEB."oldalak/".$routes[0]."/";
getController("Email");
$emails = new EmailController();
$VIEW["vars"]["takenDates"] = $emails->getContactsByContactType($routes[0]);
$VIEW["meta"]["og:type"] = "article";
?>