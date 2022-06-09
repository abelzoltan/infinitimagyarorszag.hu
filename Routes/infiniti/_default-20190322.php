<?php 
#Get oldcar
$VIEW["vars"]["car"] = $car = $cars->getCarByURL($routes[0]);
#If no car: landing page?
if($car === false) { include($routesDir."page.php"); }
#Oldcar
elseif(!$car["active"]) { $URL->redirect(); }
else { include($routesDir."old-cars-details.php"); }
?>