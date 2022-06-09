<?php 
if(isset($VIEW["vars"]) AND !empty($VIEW["vars"]))
{
	foreach($VIEW["vars"] AS $key => $val) { $$key = $val; }
}
?>