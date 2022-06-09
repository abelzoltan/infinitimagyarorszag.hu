<?php 
$VIEW["title"] = "Prospektusok"; 
$VIEW["meta"]["description"] = "Töltse le az INFINITI modellek összes adatát tartalmazó anyagokat";
$VIEW["meta"]["og:type"] = "product.group";
$VIEW["name"] = "pdf-list";
$VIEW["vars"]["carList"] = $cars->getModels();
?>