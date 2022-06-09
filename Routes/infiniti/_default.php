<?php 
#Get oldcar
/*getController("Hasznaltauto");
$hil = new HasznaltautoController;
$VIEW["vars"]["car"] = $car = $hil->getCarByURL($routes[0]);*/
getController("Hex");
$hex = new HexController($dbGablini);
$VIEW["vars"]["car"] = $car = $hex->getCarByURL($routes[0]);

#If no car: landing page?
if($car === false) { include($routesDir."page.php"); }
#Oldcar
elseif(!$car["active"]) { $URL->redirect(); }
else { include($routesDir."old-cars-details.php"); }
?>