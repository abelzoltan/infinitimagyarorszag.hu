<?php 
$emails = [];
$users = $cars->getUsers();
foreach($users AS $user) { $emails[$user["id"]] = $user["email"]; }

echo json_encode($emails);
exit;
?>