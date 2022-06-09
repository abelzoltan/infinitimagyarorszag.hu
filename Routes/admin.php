<?php
#Settings
$users->loginAcceptedRanks = [3, 4];
$adminRoutes = DIR_ROUTES."admin/";
$VIEW["frame"] = $site->name;

#With login
if($_SESSION[USER_LOGGED_IN])
{
	#Navigation
	include($adminRoutes."_navigation.php");

	#Routes
	switch($routes[0])
	{
		#Homepage
		case "":
			$VIEW["name"] = "home";
			break;
		case $site->data->homepageURL:
			$URL->redirect();
			break;
		#Log In and Out
		case "login":
			$URL->redirect();
			break;
		case "logout":
			$users->logout();
			$URL->redirect();
			break;
		#File
		case "file":
			include($adminRoutes."files.php");
			break;
		#Users
		case "profile":
			include($adminRoutes."users/profile.php");
			break;
		case "users":
			include($adminRoutes."users/users.php");
			break;
		#Used cars	
		case "stock":	
		case "approved":	
			include($adminRoutes."usedCars.php");
			break;
		#Tablet registration
		case "tablet-registration":	
			include($adminRoutes."tablet.php");
			break;
		default:
			break;
	}
}
#Without login
else
{
	switch($routes[0])
	{
		case "":
			$VIEW["title"] = "Bejelentkezés";
			$VIEW["name"] = "without-login/login";
			break;
		case "login":
			include($adminRoutes."users/login.php");
			break;
		case "logout":
			$URL->redirect();
			break;
		case "registration":
			include($adminRoutes."users/registration.php");
			break;
		case "forgot-password":
			include($adminRoutes."users/forgot-password.php");
			break;
		case "new-password":
			include($adminRoutes."users/new-password.php");
			break;
		default:
			$URL->redirect([], ["error" => "required", "url" => $URL->htaccess, "get" => $URL->getString]);
			break;
	}
}

#"Content" section
if(file_exists(DIR_ROUTES."_inc-view-section-content.php")) { include(DIR_ROUTES."_inc-view-section-content.php"); }
?>