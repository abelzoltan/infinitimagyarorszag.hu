<?php 
$VIEW["title"] = "MUNKATÁRSAINK"; 
$VIEW["meta"]["description"] = "Munkatársaink, Munkatársak, Értékesítők";
$VIEW["meta"]["og:type"] = "article";
$VIEW["name"] = "users";
$VIEW["vars"]["userList"] = $cars->getUsers();
?>