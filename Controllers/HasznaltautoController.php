<?php
class HasznaltautoController extends BaseController
{
	public $priceList = "Alapár";
	public $priceSale = "Kedvezményes ár";
	public $noPicSrc = DIR_PUBLIC_WEB."pics/auto-nincs-kep.jpg";
	
	#Cars
	public function getCar($id, $row = NULL, $allDatas = true)
	{
		if($row === NULL) { $row = $this->model->getCar($id); }
		if(!empty($row) AND isset($row->id) AND !empty($row->id))
		{
			#Basic
			$return = [];
			$return["car"] = $row;
			$return["id"] = $row->id;
			$return["active"] = ($row->active);
			$return["sourceID"] = $row->sourceID;
			$return["url"] = $row->url;
			$return["model"] = $row->model;
			
			$return["user"] = false;
			
			$return["brand"] = $row->brand;
			$return["name"] = $row->name;
			$return["text"] = $row->text;
			
			$fullName = [];
			if(!empty($return["brand"])) { $fullName[] = $return["brand"]; }
			if(!empty($return["name"])) { $fullName[] = $return["name"]; }
			$return["fullName"] = implode(" ", $fullName);
			
			#Main datas
			$return["main"] = [];
			$return["shortTextData"] = [];
			if(!empty($row->yearMonth))
			{
				$return["main"]["yearMonth"] = [
					"code" => "yearMonth",
					"name" => "Évjárat",
					"value" => $row->km,
					"after" => "",
					"formatted" => $row->yearMonth,
					"nameWithAfter" => "Évjárat",
				];
				$return["shortTextData"][] = $return["main"]["yearMonth"]["formatted"];
			}
			if(!empty($row->km))
			{
				$return["main"]["km"] = [
					"code" => "km",
					"name" => "Futott km",
					"value" => $row->km,
					"after" => "km",
					"formatted" => number_format($row->km, 0, ",", " ")." km",
					"nameWithAfter" => "Futott km",
				];
				$return["shortTextData"][] = $return["main"]["km"]["formatted"];
			}
			if(!empty($row->cm3))
			{
				$return["main"]["cm3"] = [
					"code" => "cm3",
					"name" => "Hengerűrtartalom",
					"value" => $row->cm3,
					"after" => "cm3",
					"formatted" => number_format($row->cm3, 0, ",", " ")." cm3",
					"nameWithAfter" => "Hengerűrtartalom (cm3)",
				];
				$return["shortTextData"][] = $return["main"]["cm3"]["formatted"];
			}
			if(!empty($row->kw))
			{
				$return["main"]["kw"] = [
					"code" => "kw",
					"name" => "Teljesítmény (kW)",
					"value" => $row->kw,
					"after" => "kW",
					"formatted" => number_format($row->kw, 0, ",", " ")." kW",
					"nameWithAfter" => "Teljesítmény (kW)",
				];
				
				$ps = $row->kw * 1.36;
				$return["main"]["le"] = [
					"code" => "le",
					"name" => "Teljesítmény (LE)",
					"value" => $ps,
					"after" => "LE",
					"formatted" => number_format($ps, 0, ",", " ")." LE",
					"nameWithAfter" => "Teljesítmény (LE)",
				];
				
				$return["shortTextData"][] = $return["main"]["le"]["formatted"];
			}
			$return["shortTextComma"] = implode(", ", $return["shortTextData"]);
			$return["shortTextSpace"] = implode("&nbsp;&nbsp;&nbsp;", $return["shortTextData"]);
			
			#Prices
			$return["price"] = $row->price;
			$return["priceOut"] = number_format($return["price"], 0, ",", " ")." Ft";
			
			$return["priceList"] = $row->priceList;
			if(!empty($return["priceList"]))
			{
				$return["priceLabel"] = $this->priceSale;
				$return["priceListOut"] = number_format($return["priceList"], 0, ",", " ")." Ft";
				$return["priceListLabel"] = $this->priceList;
				
			}
			else
			{
				$return["priceLabel"] = $this->priceList;
				$return["priceListOut"] = $return["priceListLabel"] = "";
			}
			
			#Pics
			$return["pics"] = $this->getPicsByCar($row->id);
			$return["hasPic"] = (count($return["pics"]) > 0);
			$return["defaultPic"] = ($return["hasPic"]) ? $return["pics"][0]["url"] : $this->noPicSrc;
			
			#Details
			if($allDatas)
			{
				$return["prices"] = $this->getPricesByCar($row->id);
				$return["datas"] = $this->getDatasByCar($row->id);
				
				$return["details"] = [
					"prices" => "Ár",
					"main" => "Kiemelt adatok",
					"datas" => "Részletek",
				];
			}
			
			return $return;
		}
		else { return false; }
	}
	
	public function getCarByURL($url, $allDatas = true)
	{
		$row = $this->model->getCarByURL($url);
		if(!empty($row) AND isset($row->id) AND !empty($row->id)) { return $this->getCar($row->id, $row, $allDatas); }
		else { return false; }
	}
	
	public function getCars($type = NULL, $model = NULL, $active = NULL, $deleted = 0, $key = "url", $orderBy = "price, name")
	{
		$return = [];
		$rows = $this->model->getCars($type, $model, $active, $deleted, "*", $orderBy);
		if(!empty($rows))
		{
			foreach($rows AS $i => $row)
			{
				$keyHere = (empty($key)) ? $i : $row->$key;
				$return[$keyHere] = $this->getCar($row->id, $row, false);
			}
		}
		return $return;
	}
	
	#Prices
	public function getPrice($id, $row = NULL)
	{
		if($row === NULL) { $row = $this->model->getPrice($id); }
		if(!empty($row) AND isset($row->id) AND !empty($row->id))
		{
			$return = (array)$row;
			$return["nameWithAfter"] = $return["name"];
			if(!empty($return["after"])) { $return["nameWithAfter"] .= $return["after"]; }
			
			return $return;
		}
		else { return false; }
	}

	public function getPricesByCar($car, $deleted = 0, $key = "code", $orderBy = "")
	{
		$return = [];
		$rows = $this->model->getPricesByCar($car, $deleted, "*", $orderBy);
		if(!empty($rows))
		{
			foreach($rows AS $i => $row)
			{
				$keyHere = (empty($key)) ? $i : $row->$key;
				$return[$keyHere] = $this->getPrice($row->id, $row);
			}
		}
		return $return;
	}
	
	#Datas
	public function getData($id, $row = NULL)
	{
		if($row === NULL) { $row = $this->model->getData($id); }
		if(!empty($row) AND isset($row->id) AND !empty($row->id))
		{
			$return = (array)$row;
			$return["nameWithAfter"] = $return["name"];
			if(!empty($return["after"])) { $return["nameWithAfter"] .= $return["after"]; }
			
			return $return;
		}
		else { return false; }
	}

	public function getDatasByCar($car, $deleted = 0, $key = "code", $orderBy = "")
	{
		$return = [];
		$rows = $this->model->getDatasByCar($car, $deleted, "*", $orderBy);
		if(!empty($rows))
		{
			foreach($rows AS $i => $row)
			{
				$keyHere = (empty($key)) ? $i : $row->$key;
				$return[$keyHere] = $this->getData($row->id, $row);
			}
		}
		return $return;
	}
	
	#Pics
	public function getPic($id, $row = NULL)
	{
		if($row === NULL) { $row = $this->model->getPic($id); }
		if(!empty($row) AND isset($row->id) AND !empty($row->id))
		{
			$return = (array)$row;
			return $return;
		}
		else { return false; }
	}

	public function getPicsByCar($car, $deleted = 0, $key = "", $orderBy = "orderNumber")
	{
		$return = [];
		$rows = $this->model->getPicsByCar($car, $deleted, "*", $orderBy);
		if(!empty($rows))
		{
			foreach($rows AS $i => $row)
			{
				$keyHere = (empty($key)) ? $i : $row->$key;
				$return[$keyHere] = $this->getPic($row->id, $row);
			}
		}
		return $return;
	}
	
	#Import
	public function importIntoDatabase()
	{
		$return = [];
		$types = $this->model->getTypes();
		if(!empty($types))
		{
			getController("HasznaltautoImport");
			$imp = new HasznaltautoImportController();
			foreach($types AS $type)
			{
				$impDatas = $imp->importProcess($type->hash);
				#SUCCESS
				if($impDatas["success"])
				{
					#Basic
					$insertedRows = $updatedRows = $deletedRows = 0;
					$carList = [];
					
					#Loop cars from import
					foreach($impDatas["cars"] AS $car)
					{							
						#Existing car (update)
						$carID = $this->model->getCarByTypeAndSourceID($type->id, $car["car"]["sourceID"], "id");
						if(!empty($carID))
						{
							$updatedRows++;
							
							#Car
							$params = $car["car"];
							$params["url"] = $this->setCarURL($car["car"]["name"], $carID);
							$this->model->editCar($carID, $params);
							
							#Get existing rows (prices, datas, pics)
							$pricesNow = $this->getPricesByCar($carID);
							$datasNow = $this->getDatasByCar($carID);
							$picsNow = $this->getPicsByCar($carID, 0, "url");
							
							#Prices
							$priceList = [];
							foreach($car["prices"] AS $priceKey => $price)
							{
								$priceParams = $price;
								if(isset($pricesNow[$priceParams["code"]])) 
								{ 
									$this->model->editPrice($pricesNow[$priceParams["code"]]["id"], $priceParams); 
									$priceList[] = $pricesNow[$priceParams["code"]]["id"];
								}
								else
								{
									$priceParams["car"] = $carID;
									$priceList[] = $this->model->newPrice($priceParams);
								}
							}
							
							#Datas
							$dataList = [];
							foreach($car["datas"] AS $dataKey => $data)
							{
								$dataParams = $data;
								if(isset($datasNow[$dataParams["code"]])) 
								{ 
									$this->model->editData($datasNow[$dataParams["code"]]["id"], $dataParams); 
									$dataList[] = $datasNow[$dataParams["code"]]["id"];
								}
								else
								{
									$dataParams["car"] = $carID;
									$dataList[] = $this->model->newData($dataParams);
								}
							}
							
							#Pics
							$picList = [];
							$i = 1;
							foreach($car["pics"] AS $pic)
							{
								if(isset($picsNow[$pic])) 
								{ 
									$this->model->editPic($picsNow[$pic]["id"], ["orderNumber" => $i]);
									$picList[] = $picsNow[$pic]["id"];
								}
								else
								{
									$picParams = [
										"car" => $carID,
										"url" => $pic,
										"orderNumber" => $i,
									];
									$picList[] = $this->model->newPic($picParams);
								}
								$i++;
							}
							
							#Delete prices not in import
							$checkList = $this->model->getPricesByCar($carID);
							foreach($checkList AS $checkRow)
							{
								if(!in_array($checkRow->id, $priceList)) { $this->model->delPrice($checkRow->id);  }
							}
							
							#Delete datas not in import
							$checkList = $this->model->getDatasByCar($carID);
							foreach($checkList AS $checkRow)
							{
								if(!in_array($checkRow->id, $dataList)) { $this->model->delData($checkRow->id);  }
							}
							
							#Delete pics not in import
							$checkList = $this->model->getPicsByCar($carID);
							foreach($checkList AS $checkRow)
							{
								if(!in_array($checkRow->id, $picList)) { $this->model->delPic($checkRow->id);  }
							}
						}
						#New car (insert)
						else
						{
							$insertedRows++;
							
							#Car
							$params = $car["car"];
							$params["date"] = $this->model->now();
							$params["type"] = $type->id;
							$params["url"] = $this->setCarURL($car["car"]["name"]);
							$carID = $this->model->newCar($params);
							
							#Prices
							foreach($car["prices"] AS $priceKey => $price)
							{
								$priceParams = $price;
								$priceParams["car"] = $carID;
								$this->model->newPrice($priceParams);
							}
							
							#Datas
							foreach($car["datas"] AS $dataKey => $data)
							{
								$dataParams = $data;
								$dataParams["car"] = $carID;
								$this->model->newData($dataParams);
							}
							
							#Pics
							$i = 1;
							foreach($car["pics"] AS $pic)
							{
								$picParams = [
									"car" => $carID,
									"url" => $pic,
									"orderNumber" => $i,
								];
								$this->model->newPic($picParams);
								$i++;
							}
						}						
						$carList[] = $carID;
					}
					
					#Delete cars not in import
					$cars = $this->model->getCars($type->id);
					foreach($cars AS $carRow)
					{
						if(!in_array($carRow->id, $carList)) 
						{ 
							$this->model->delCar($carRow->id); 
							$deletedRows++;
						}
					}
					
					#Log
					$errors = (!empty($impDatas["import"]["errors"])) ? $impDatas["import"]["errors"] : NULL;
					$return[] = $this->importLog($type->id, $impDatas["import"]["xmlString"], $errors, 1, $impDatas["import"]["xmlRowCount"], count($impDatas["cars"]), $insertedRows, $updatedRows, $deletedRows);
				}
				#ERROR
				else { $return[] = $this->importLog($type->id, $impDatas["import"]["xmlString"], $impDatas["import"]["errors"]); }
			}
		}
		else { $return[] = $this->importLog(NULL, NULL, ["No type rows!"]); }
		
		return $return;
	}
	
	public function importLog($type, $xmlString = "", $errors = [], $success = 0, $xmlRowCount = 0, $rowCount = 0, $insertedRows = 0, $updatedRows = 0, $deletedRows = 0)
	{
		$xmlString = NULL;
		$params = [
			"date" => $this->model->now(),
			"type" => $type,
			"xmlString" => $xmlString,
			"errors" => ($errors === NULL) ? $errors : $this->json($errors),
			"success" => $success,
			"xmlRowCount" => $xmlRowCount,
			"rowCount" => $rowCount,
			"insertedRows" => $insertedRows,
			"updatedRows" => $updatedRows,
			"deletedRows" => $deletedRows,
		];
		return $this->model->insert($this->model->tables("imports"), $params);
	}
	
	#Generate car URL
	public function setCarURL($name, $id = 0)
	{
		return $this->setUniqueURL($this->model->tables("cars"), "url", $name, "", ["del" => 0], $id);
	}
}
?>