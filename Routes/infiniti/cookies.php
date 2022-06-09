<?php 
if(isset($routes[1]) AND $routes[1] == "biztos-vagyok-benne")
{
	setcookie("cookiesAccepted", false, time() + 10, "/"); 
	$GLOBALS["URL"]->redirect();
}
else { setcookie("cookiesAccepted", true, time() + (86400 * 365), "/"); }	
exit;
?>