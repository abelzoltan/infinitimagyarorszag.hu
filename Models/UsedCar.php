<?php 
class UsedCar extends Base
{	
	#Tables
	public function tables($name = "")
	{
		$return = [
			"cars" => $this->dbPrefix."usedCars",
			"models" => $this->dbPrefix."usedCars_models",
			"tires" => $this->dbPrefix."usedCars_tires",
			"types" => $this->dbPrefix."usedCars_types",
			"users" => $this->dbPrefix."usedCars_users",
		];

		if(empty($name)) { return $return; }
		else { return $return[$name]; }
	}
	
	#Get car
	public function getCar($id, $field = "", $delCheck = 0)
	{
		return $this->selectByField($this->tables("cars"), "id", $id, $field, $delCheck);
	}
	
	public function getCarByURL($url, $field = "", $delCheck = 1)
	{
		return $this->selectByField($this->tables("cars"), "url", $url, $field, $delCheck);
	}
	
	public function getCars($type, $model = NULL, $active = NULL, $deleted = 0, $selectFields = "id", $orderBy = "model, price, name")
	{
		$params = ["type" => $type];
		$query = "SELECT ".$selectFields." FROM ".$this->tables("cars")." WHERE type = :type";
		
		if($model !== NULL)
		{
			$query .= " AND model = :model";
			$params["model"] = $model;
		}
		
		if($active !== NULL)
		{
			$query .= " AND active = :active";
			$params["active"] = $active;
		}
		
		if($deleted !== NULL)
		{
			$query .= " AND del = :del";
			$params["del"] = $deleted;
		}
		
		if(!empty($orderBy)) { $query .= " ORDER BY ".$orderBy; }

		return $this->select($query, $params);
	}
	
	#Get model
	public function getModel($id, $field = "", $delCheck = 0)
	{
		return $this->selectByField($this->tables("models"), "id", $id, $field, $delCheck);
	}
	
	public function getModelByURL($url, $field = "", $delCheck = 1)
	{
		return $this->selectByField($this->tables("models"), "url", $url, $field, $delCheck);
	}
	
	public function getModels($deleted = 0, $selectFields = "*", $orderBy = "name")
	{
		$params = [];
		$query = "SELECT ".$selectFields." FROM ".$this->tables("models")." WHERE id != '0'";
		if($deleted !== NULL)
		{
			$query .= " AND del = :del";
			$params["del"] = $deleted;
		}
		
		if(!empty($orderBy)) { $query .= " ORDER BY ".$orderBy; }
		
		return $this->select($query, $params);
	}
	
	public function getModelsForSelect()
	{
		return $this->select("SELECT id, url, name FROM ".$this->tables("models")." WHERE del = '0' ORDER BY orderNumber");
	}
	
	public function getModelsForSelectWithDel()
	{
		return $this->select("SELECT id, url, name FROM ".$this->tables("models")." ORDER BY orderNumber");
	}
	
	#Get type
	public function getType($id, $field = "", $delCheck = 0)
	{
		return $this->selectByField($this->tables("types"), "id", $id, $field, $delCheck);
	}
	
	public function getTypeByURL($url, $field = "", $delCheck = 1)
	{
		return $this->selectByField($this->tables("types"), "url", $url, $field, $delCheck);
	}
	
	#Get user
	public function getUser($id, $field = "", $delCheck = 0)
	{
		return $this->selectByField($this->tables("users"), "id", $id, $field, $delCheck);
	}
	
	public function getUserByEmail($email, $field = "", $delCheck = 1)
	{
		return $this->selectByField($this->tables("users"), "email", $email, $field, $delCheck);
	}
	
	public function getUsers($sales = NULL, $deleted = 0, $selectFields = "id", $orderBy = "orderNumber, name")
	{
		$params = [];
		$query = "SELECT ".$selectFields." FROM ".$this->tables("users")." WHERE id != '0'";

		if($sales !== NULL)
		{
			$query .= " AND sales = :sales";
			$params["sales"] = $sales;
		}
		
		if($deleted !== NULL)
		{
			$query .= " AND del = :del";
			$params["del"] = $deleted;
		}
		
		if(!empty($orderBy)) { $query .= " ORDER BY ".$orderBy; }
		
		return $this->select($query, $params);
	}
	
	#Get tire
	public function getTire($id, $field = "", $delCheck = 0)
	{
		return $this->selectByField($this->tables("tires"), "id", $id, $field, $delCheck);
	}
	
	public function getTires($model = NULL, $deleted = 0, $selectFields = "id", $orderBy = "orderNumber, model")
	{
		$params = [];
		$query = "SELECT ".$selectFields." FROM ".$this->tables("tires")." WHERE id != '0'";

		if($model !== NULL)
		{
			$query .= " AND model = :model";
			$params["model"] = $model;
		}
		
		if($deleted !== NULL)
		{
			$query .= " AND del = :del";
			$params["del"] = $deleted;
		}
		
		if(!empty($orderBy)) { $query .= " ORDER BY ".$orderBy; }
		
		return $this->select($query, $params);
	}
}
?>