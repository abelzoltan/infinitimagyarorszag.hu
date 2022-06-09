<?php 
if(!isset($routes[1]) OR empty($routes[1])) { $URL->redirect(); }
else
{
	$file = new FileController();
	$file->watchByURL($routes[1]);
	exit;
}
?>