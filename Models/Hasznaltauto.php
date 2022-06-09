<?php 
class Hasznaltauto extends Base
{	
	#Tables
	public function tables($name = "")
	{
		$return = [
			"cars" => $this->dbPrefix."hil_cars",
			"datas" => $this->dbPrefix."hil_datas",
			"imports" => $this->dbPrefix."hil_imports",
			"pics" => $this->dbPrefix."hil_pics",
			"prices" => $this->dbPrefix."hil_prices",
			"types" => $this->dbPrefix."hil_types",
		];

		if(empty($name)) { return $return; }
		else { return $return[$name]; }
	}
	
	#Cars
	public function getCar($id, $field = "", $delCheck = 0)
	{
		return $this->selectByField($this->tables("cars"), "id", $id, $field, $delCheck);
	}
	
	public function getCarByURL($url, $field = "", $delCheck = 1)
	{
		return $this->selectByField($this->tables("cars"), "url", $url, $field, $delCheck);
	}
	
	public function getCarBySourceID($sourceID, $field = "", $delCheck = 1)
	{
		return $this->selectByField($this->tables("cars"), "sourceID", $sourceID, $field, $delCheck);
	}
	
	public function getCarByTypeAndSourceID($type, $sourceID, $field, $deleted = 0)
	{
		$query = "SELECT * FROM ".$this->tables("cars")." WHERE type = :type AND sourceID = :sourceID";
		$params = [
			"type" => $type,
			"sourceID" => $sourceID,
		];
		
		if($deleted !== NULL)
		{
			$query .= " AND del = :del";
			$params["del"] = $deleted;
		}

		$rows = $this->select($query, $params);
		if(!empty($rows) AND is_array($rows) AND isset($rows[0]) AND !empty($rows[0])) { return (!empty($field)) ? $rows[0]->$field : $rows[0]; }
		else { return false; }
	}
	
	public function getCars($type = NULL, $model = NULL, $active = NULL, $deleted = 0, $selectFields = "id", $orderBy = "price, name")
	{
		$params = [];
		$query = "SELECT ".$selectFields." FROM ".$this->tables("cars")." WHERE id != '0'";

		if($type !== NULL)
		{
			$query .= " AND type = :type";
			$params["type"] = $type;
		}
		
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
	
	public function newCar($params)
	{
		return $this->myInsert($this->tables("cars"), $params);
	}
	
	public function editCar($id, $params)
	{
		return $this->myUpdate($this->tables("cars"), $params, $id);
	}
	
	public function delCar($id, $really = 0)
	{
		return $this->myDelete($this->tables("cars"), $id, $really);
	}
	
	#Types
	public function getTypes($deleted = 0, $selectFields = "*", $orderBy = "orderNumber")
	{
		$params = [];
		$query = "SELECT ".$selectFields." FROM ".$this->tables("types")." WHERE id != '0'";

		if($deleted !== NULL)
		{
			$query .= " AND del = :del";
			$params["del"] = $deleted;
		}
		
		if(!empty($orderBy)) { $query .= " ORDER BY ".$orderBy; }

		return $this->select($query, $params);
	}
	
	#Prices
	public function getPrice($id, $field = "", $delCheck = 0)
	{
		return $this->selectByField($this->tables("prices"), "id", $id, $field, $delCheck);
	}
	
	public function getPricesByCar($car, $deleted = 0, $selectFields = "id", $orderBy = "")
	{
		$params = ["car" => $car];
		$query = "SELECT ".$selectFields." FROM ".$this->tables("prices")." WHERE car = :car";

		if($deleted !== NULL)
		{
			$query .= " AND del = :del";
			$params["del"] = $deleted;
		}
		
		if(!empty($orderBy)) { $query .= " ORDER BY ".$orderBy; }

		return $this->select($query, $params);
	}
	
	public function newPrice($params)
	{
		return $this->myInsert($this->tables("prices"), $params);
	}
	
	public function editPrice($id, $params)
	{
		return $this->myUpdate($this->tables("prices"), $params, $id);
	}
	
	public function delPrice($id, $really = 0)
	{
		return $this->myDelete($this->tables("prices"), $id, $really);
	}
	
	public function delPricesByCar($car, $really = 0)
	{
		$query = ($really) ? "DELETE FROM ".$this->tables("prices")." WHERE car = :car" : "UPDATE ".$this->tables("prices")." SET del = '1', deleted_at = '".$this->now()."' WHERE car = :car AND del = '0'";
		return $this->statement($query, ["car" => $car]);
	}
	
	#Datas
	public function getData($id, $field = "", $delCheck = 0)
	{
		return $this->selectByField($this->tables("datas"), "id", $id, $field, $delCheck);
	}
	
	public function getDatasByCar($car, $deleted = 0, $selectFields = "id", $orderBy = "")
	{
		$params = ["car" => $car];
		$query = "SELECT ".$selectFields." FROM ".$this->tables("datas")." WHERE car = :car";

		if($deleted !== NULL)
		{
			$query .= " AND del = :del";
			$params["del"] = $deleted;
		}
		
		if(!empty($orderBy)) { $query .= " ORDER BY ".$orderBy; }

		return $this->select($query, $params);
	}
	
	public function newData($params)
	{
		return $this->myInsert($this->tables("datas"), $params);
	}
	
	public function editData($id, $params)
	{
		return $this->myUpdate($this->tables("datas"), $params, $id);
	}
	
	public function delData($id, $really = 0)
	{
		return $this->myDelete($this->tables("datas"), $id, $really);
	}
	
	public function delDatasByCar($car, $really = 0)
	{
		$query = ($really) ? "DELETE FROM ".$this->tables("datas")." WHERE car = :car" : "UPDATE ".$this->tables("datas")." SET del = '1', deleted_at = '".$this->now()."' WHERE car = :car AND del = '0'";
		return $this->statement($query, ["car" => $car]);
	}
	
	#Pics
	public function getPic($id, $field = "", $delCheck = 0)
	{
		return $this->selectByField($this->tables("pics"), "id", $id, $field, $delCheck);
	}
	
	public function getPicsByCar($car, $deleted = 0, $selectFields = "id", $orderBy = "orderNumber")
	{
		$params = ["car" => $car];
		$query = "SELECT ".$selectFields." FROM ".$this->tables("pics")." WHERE car = :car";

		if($deleted !== NULL)
		{
			$query .= " AND del = :del";
			$params["del"] = $deleted;
		}
		
		if(!empty($orderBy)) { $query .= " ORDER BY ".$orderBy; }

		return $this->select($query, $params);
	}
	
	public function newPic($params)
	{
		return $this->myInsert($this->tables("pics"), $params);
	}
	
	public function editPic($id, $params)
	{
		return $this->myUpdate($this->tables("pics"), $params, $id);
	}
	
	public function delPic($id, $really = 0)
	{
		return $this->myDelete($this->tables("pics"), $id, $really);
	}
	
	public function delPicsByCar($car, $really = 0)
	{
		$query = ($really) ? "DELETE FROM ".$this->tables("pics")." WHERE car = :car" : "UPDATE ".$this->tables("pics")." SET del = '1', deleted_at = '".$this->now()."' WHERE car = :car AND del = '0'";
		return $this->statement($query, ["car" => $car]);
	}
}
?>