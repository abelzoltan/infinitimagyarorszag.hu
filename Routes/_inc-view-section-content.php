<?php
$VIEW["sections"]["content"] = $VIEW["name"];
if(isset($VIEW["sections"]["content"]) AND !empty($VIEW["sections"]["content"])) { $VIEW["sections"]["content"] = $GLOBALS["site"]->name."/".$VIEW["sections"]["content"]; }
else 
{
	$VIEW["sections"]["content"] = $GLOBALS["site"]->name."/";
	if(empty($GLOBALS["URL"]->routes[0])) { $VIEW["sections"]["content"] .= $GLOBALS["site"]->data->homepageURL; }
	else { $VIEW["sections"]["content"] .= implode("-", $GLOBALS["URL"]->routes); }
}
if(!viewExists($VIEW["sections"]["content"])) { $VIEW["sections"]["content"] = $GLOBALS["site"]->name."/404"; }
?>