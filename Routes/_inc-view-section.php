<?php
if(isset($VIEW["sections"][$INCLUDE_NAME]) AND !empty($VIEW["sections"][$INCLUDE_NAME])) 
{
	if(is_array($VIEW["sections"][$INCLUDE_NAME])) { $INCLUDE = $VIEW["sections"][$INCLUDE_NAME]; }
	else { $INCLUDE = [$VIEW["sections"][$INCLUDE_NAME]]; }
	
	foreach($INCLUDE AS $INCLUDE_ITEM)
	{
		include(DIR_VIEWS.$INCLUDE_ITEM.".php");
	}
} 
?>