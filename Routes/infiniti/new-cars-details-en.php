<?php 
$title = ($routes[0] == "q50-en") ? "THE NEW Q50" : "Q30";		
$VIEW["title"] = "<span style='font-size: 180% !important; line-height: 140%;'><strong>INFINITI ".$title."</strong></span>"; 
$VIEW["name"] = "new-cars/".$routes[0];
$VIEW["vars"]["pics"] = CDN_WEB."oldalak/".$routes[0]."/";
$VIEW["meta"]["og:type"] = "article";

$VIEW["vars"]["mainHeaderMenusShow"] = false;
$VIEW["vars"]["mainLang"] = "en";

#Users
getController("UsedCar");
$cars = new UsedCarController();

$VIEW["vars"]["userList"] = [
	"3" => $cars->getUser(3),
	"2" => $cars->getUser(2),
	"1" => $cars->getUser(1),
];

$nameArray = explode(" ", $VIEW["vars"]["userList"][3]["name"]);
$VIEW["vars"]["userList"][3]["name"] = $nameArray[1]." ".$nameArray[0];

$nameArray = explode(" ", $VIEW["vars"]["userList"][2]["name"]);
$VIEW["vars"]["userList"][2]["name"] = $nameArray[1]." ".$nameArray[0];

$nameArray = explode(" ", $VIEW["vars"]["userList"][1]["name"]);
$VIEW["vars"]["userList"][1]["name"] = $nameArray[1]." ".$nameArray[0];

$VIEW["vars"]["userList"][3]["position"] = "Brand Manager";
$VIEW["vars"]["userList"][2]["position"] = $VIEW["vars"]["userList"][1]["position"] = "Sales Manager";
?>