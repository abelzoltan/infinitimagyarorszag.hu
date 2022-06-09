<?php
class Cron extends Base
{
	#Tables
	public function tables($name = "")
	{
		$return = [
			"cron" => $this->dbPrefix."cron",
			"types" => $this->dbPrefix."cron_types",
		];

		if(empty($name)) { return $return; }
		else { return $return[$name]; }
	}
	
	#Get all
	public function getTypes()
	{
		return $this->select("SELECT * FROM ".$this->tables("types")." WHERE del = '0' ORDER BY orderNumber");
	}
}
