<?php 
$file = $routesDir."pages/".$routes[0].".php";
if(file_exists($file)) { include($file); }
else { $URL->redirect(); }
?>