<?php 
class Base extends DB
{
	public $dbPrefix = "";
	public $DB; // for Laravel syncron
	
	#Constructor
	public function __construct($connectionData = [])
	{
		if(empty($connectionData)) { $this->dbPrefix = $this->checkDefine("MYSQL_PREFIX", ""); }
		else { $this->dbPrefix = $connectionData["prefix"]; }
		parent::__construct($connectionData);
	}
	
	#Now
	public function now()
	{
		return date("Y-m-d H:i:s");
	}
	
	#Unique field check (f.e: token, key, ...)
	public function checkUniqueField($table, $valueKey, $value, $params, $id = 0, $primaryKey = "id")
	{
		$query = "SELECT * FROM ".$table." WHERE ".$primaryKey." != :primaryKey AND ".$valueKey." = :valueKey";
		foreach($params AS $key => $val)
		{
			$query .= " AND ".$key." = :".$key;
		}
		$params["primaryKey"] = $id;
		$params["valueKey"] = $value;
		
		return $this->select($query, $params);
	}
}
?>