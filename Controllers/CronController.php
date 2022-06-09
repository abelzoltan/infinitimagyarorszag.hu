<?php
class CronController extends BaseController
{	
	public $dateTime;
	
	#Construct
	public function __construct($connectionData = [])
	{
		$this->getModel($connectionData);
		$this->dateTime = date("Y-m-d H:i:s");

		$types = $this->model->getTypes();
		foreach($types AS $i => $type)
		{
			$last = $this->getLastCronByType($type->id);
			#Always run
			if(empty($type->intervalSeconds)) { $okay = true; }
			#Has run before
			elseif($last !== false)
			{
				$dateTime = strtotime($this->dateTime);
				$lastTime = strtotime($last->date);
				$differenceInSeconds = $dateTime - $lastTime;
				
				#Can run again --> required time has passed
				if($differenceInSeconds >= $type->intervalSeconds) { $okay = true; }
				#Can NOT run again --> required time has not passed
				else { $okay = false; }
			}
			#Never had run before
			else { $okay = true; }
			
			#If can run
			if($okay)
			{
				$methodName = $type->url;
				$return = $this->$methodName();
				$this->log($type->id, $return);
			}
		}
	}
	
	public function log($type, $return)
	{
		$params = [
			"type" => $type,
			"date" => $this->dateTime,
			"returnData" => $this->json($return),
		];
		$this->model->myInsert($this->model->tables("cron"), $params);
	}
	
	public function getLastCronByType($type)
	{
		$rows = $this->model->select("SELECT * FROM ".$this->model->tables("cron")." WHERE del = '0' AND type = :type ORDER BY id DESC LIMIT 0, 1", ["type" => $type]);
		if(count($rows) > 0) { $return = $rows[0]; }
		else { $return = false; }
		
		return $return;
	}
	
	public function json($array)
	{
		return json_encode($array, JSON_UNESCAPED_UNICODE);
	}
	
	#---------------------------------------------------------------------------------------------------------------------------------------------------------------------
	
	public function cronProcess()
	{
		$return = [];
		$types = $this->model->getTypes();
		foreach($types AS $i => $type)
		{
			$return[$type->id] = [
				"url" => $type->url,
				"name" => $type->name,
				"interval" => $type->intervalSeconds,
			];
		}
		
		return $return;
	}
	
	public function hasznaltautoImport()
	{
		$timeStart = microtime(true);
		
		getController("Hasznaltauto");
		$hil = new HasznaltautoController;
		$imports = $hil->importIntoDatabase();	
		
		$timeEnd = microtime(true);
		$executionTimeSec = $timeEnd - $timeStart;
		
		$return = [
			"imports" => $imports,
			"timeStart" => $timeStart,
			"timeEnd" => $timeEnd,
			"executionTimeSec" => $executionTimeSec,
		];
		
		return $return;
	}
}
