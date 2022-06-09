<?php 
include(__DIR__."/../settings.php");
getController("Cron");
$cron = new CronController();
exit;
?>