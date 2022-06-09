<?php
class UsedCarController extends BaseController
{	
	public $priceCurrency = "Ft";
	public $priceNet = " + Áfa";
	public $priceList = "Alapár";
	public $priceSale = "Kedvezményes ár";
	public $noPicSrc = DIR_PUBLIC_WEB."pics/auto-nincs-kep.jpg";
	public $tirePicSrc = NULL;
	
	#Get car
	public function getCar($id, $allDatas = true)
	{
		$row = $this->model->getCar($id);
		if(!empty($row) AND isset($row->id) AND !empty($row->id))
		{
			#Basic
			$return = [];
			$return["data"] = $row;
			$return["id"] = $row->id;
			$return["active"] = $row->active;
			$return["url"] = $row->url;
			$return["name"] = $row->name;
			$return["shortName"] = $row->shortName;
			$return["shortText"] = $row->shortText;
			$return["carBodyNumber"] = $row->carBodyNumber;
			$return["tipus"] = $row->type;
			
			#Price
			$return["priceListTxt"] = $this->priceList;
			$return["priceSaleTxt"] = $this->priceSale;
			$return["priceList"] = $row->priceList;
			$return["priceListOut"] = number_format($return["priceList"], 0, ",", " ")." ".$this->priceCurrency;
			$return["priceSale"] = $row->priceSale;
			$return["priceSaleOut"] = (!empty($return["priceSale"])) ? number_format($return["priceSale"], 0, ",", " ")." ".$this->priceCurrency : "-";
			
			$priceOut = number_format($row->price, 0, ",", " ")." ".$this->priceCurrency;
			if($row->isNet) 
			{ 
				$priceOut .= $this->priceNet; 
				$return["priceListOut"] .= $this->priceNet; 
				$return["priceSaleOut"] .= $this->priceNet; 
			}
			
			if((!empty($return["priceSale"]) AND $return["priceSale"] < $return["priceList"]))
			{
				$priceTxt = $return["priceSaleTxt"];
				$return["priceInUse"] = "sale";
			}
			else
			{
				$priceTxt = $return["priceListTxt"];
				$return["priceInUse"] = "list";
			}
			$return["price"] = [
				"inUse" => $return["priceInUse"],
				"price" => $row->price,
				"out" => $priceOut,
				"isNet" => $row->isNet,
				"txt" => $priceTxt,
			];
			
			#Pic
			getController("File");
			$file = new FileController();
			$return["pic"] = false;
			$return["picSrc"] = $this->noPicSrc;
			if(!empty($row->pic)) 
			{ 
				$pic = $file->getFile($row->pic); 
				if(!empty($pic["path"]["inner"]) AND file_exists($pic["path"]["inner"])) 
				{ 
					$return["pic"] = $pic;
					$return["picSrc"] = $pic["path"]["web"]; 
				}
			}
			
			#Gallery
			$return["gallery"] = $file->getFileList("used-cars-gallery", $row->id);
			if($return["pic"] === false AND count($return["gallery"]) > 0)
			{
				$pic = array_values($return["gallery"])[0];
				if(!empty($pic["path"]["inner"]) AND file_exists($pic["path"]["inner"])) 
				{ 
					$return["pic"] = $pic;
					$return["picSrc"] = $pic["path"]["web"]; 
					array_shift($return["gallery"]);
				}
			}
			
			#All datas
			if($allDatas)
			{
				#Datas
				$return["text"] = $row->text;
				$return["facility"] = $row->facility;
								
				#Document
				$return["document"] = false;
				$return["documentSrc"] = NULL;
				if(!empty($row->document)) 
				{ 
					$document = $file->getFile($row->document); 
					if(!empty($document["path"]["inner"]) AND file_exists($document["path"]["inner"])) 
					{ 
						$return["document"] = $document;
						$return["documentSrc"] = $document["path"]["web"]; 
					}
				}
				
				#Type
				$return["type"] = $this->model->getType($row->type);
				
				#Model
				$return["model"] = (!empty($row->model)) ? $this->model->getModel($row->model) : false;
				
				#User
				$return["user"] = (!empty($row->user)) ? $this->getUser($row->user) : false;
			}
		}
		else { $return = false; }
		
		return $return;
	}
	
	public function getCarByURL($url, $allDatas = true)
	{
		$id = $this->model->getCarByURL($url, "id");
		if(empty($id) OR !$id) { return false; }
		else { return $this->getCar($id, $allDatas); }
	}
	
	public function getCars($typeName, $model = NULL, $limit = NULL, $active = NULL, $field = "id")
	{
		$return = [
			"all" => [],
			"active" => [],
			"inactive" => [],
			"model" => [
				"all" => [],
				"active" => [],
				"inactive" => [],
			],
		];
		
		$typeID = $this->model->getTypeByURL($typeName, "id");
		$selectField = ($field == "id") ? $field : $field.", id";
		
		$rows = $this->model->getCars($typeID, $model, $active, 0, $selectField);
		if($limit !== NULL) { $limitInner = $limit - 1; }
		if(!empty($rows))
		{
			foreach($rows AS $i => $row) 
			{ 
				$car = $this->getCar($row->id, false);
				$return["all"][$row->$field] = $car;
				$return["model"]["all"][$car["data"]->model][$row->$field] = $car;
				
				if($car["active"]) 
				{ 
					$return["active"][$row->$field] = $car;
					$return["model"]["active"][$car["data"]->model][$row->$field] = $car;
				}				
				else 
				{ 
					$return["inactive"][$row->$field] = $car; 
					$return["model"]["inactive"][$car["data"]->model][$row->$field] = $car;
				}
				
				if($limit !== NULL AND $i >= $limitInner) { break; }				
			}
		}
		
		return $return;
	}
	
	#Get models
	public function getModels($key = "id", $deleted = 0, $selectFields = "*", $orderBy = "name")
	{
		$return = [];
		$rows = $this->model->getModels($deleted, $selectFields, $orderBy);
		if(!empty($rows)) { foreach($rows AS $row) { $return[$row->$key] = $row; } }
		
		return $return;
	}
	
	#Get models for select
	public function getModelsForSelect($key = "id")
	{
		$return = [];
		$rows = $this->model->getModelsForSelect();
		if(!empty($rows)) { foreach($rows AS $row) { $return[$row->$key] = $row->name; } }
		
		return $return;
	}
	
	public function getModelsForSelectWithDel($key = "id")
	{
		$return = [];
		$rows = $this->model->getModelsForSelectWithDel();
		if(!empty($rows)) { foreach($rows AS $row) { $return[$row->$key] = $row->name; } }
		
		return $return;
	}
	
	#Get user
	public function getUser($id)
	{
		$row = $this->model->getUser($id);
		if(!empty($row) AND isset($row->id) AND !empty($row->id))
		{
			#Basic
			$return = [];
			$return["data"] = $row;
			$return["id"] = $row->id;
			$return["name"] = $row->name;
			$return["email"] = $row->email;
			// $return["emailX"] = preg_replace('/[a-zA-Z0-9]/', "x", $return["email"]);
			$return["emailX"] = "Megtekintéshez kattintson ide";
			$return["picFileName"] = $row->pic;
			$return["pic"] = PATH_WEB."pics/ertekesitok/".$return["picFileName"];
			
			#Datas
			$return["position"] = $row->position;	
			$return["premise"] = $row->premise;	
			$return["address"] = $row->address;	
			$return["phone"] = $row->phone;	
			$return["mobile"] = $row->mobile;	
		}
		else { $return = false; }
		
		return $return;
	}
	
	#Get users
	public function getUsers($sales = NULL, $key = "id", $deleted = 0, $selectFields = "*", $orderBy = "orderNumber, name")
	{
		$return = [];
		$rows = $this->model->getUsers($sales, $deleted, $selectFields, $orderBy);
		if(!empty($rows)) { foreach($rows AS $row) { $return[$row->$key] = $this->getUser($row->id); } }
		
		return $return;
	}
	
	#Get users for select
	public function getUsersForSelect($sales = 1, $deleted = 0)
	{
		$return = [];
		$rows = $this->model->getUsers($sales, $deleted, "id, name");
		if(!empty($rows)) { foreach($rows AS $row) { $return[$row->id] = $row->name; } }
		
		return $return;
	}
	
	#Get tire
	public function getTire($id)
	{
		$row = $this->model->getTire($id);
		if(!empty($row) AND isset($row->id) AND !empty($row->id))
		{
			#Basic
			$return = [];
			$return["data"] = $row;
			$return["id"] = $row->id;
			
			#Datas
			$return["modelURL"] = $row->model;	
			$return["brand"] = $row->brand;	
			$return["name"] = $row->name;	
			$return["type"] = $row->type;	
			$return["size"] = $row->size;
			
			#Model
			$return["model"] = (!empty($return["modelURL"])) ? $this->model->getModelByURL($return["modelURL"], "", 0) : false;
			
			#Prices
			$return["price"] = $return["priceList"] = $return["priceSale"] = $return["priceListOut"] = $return["priceSaleOut"] = $return["priceOut"] = NULL;
			$return["priceListName"] = $this->priceList;
			$return["priceSaleName"] = $this->priceSale;
			if(!empty($row->priceList))
			{
				$return["price"] = $return["priceList"] = $row->priceList;
				$return["priceOut"] = $return["priceListOut"] = number_format($return["priceList"], 0, ",", " ")." ".$this->priceCurrency;				
			}
			if(!empty($row->priceSale))
			{
				$return["price"] = $return["priceSale"] = $row->priceSale;
				$return["priceOut"] = $return["priceSaleOut"] = number_format($return["priceSale"], 0, ",", " ")." ".$this->priceCurrency;				
			}
			
			#Full name details
			$return["fullName"] = $return["name"];
			$return["fullBrand"] = [];
			if(!empty($return["brand"])) { $return["fullBrand"][] = $return["brand"]; }
			if(!empty($return["type"])) { $return["fullBrand"][] = $return["type"]; }
			if(!empty($return["fullBrand"])) 
			{ 
				$return["fullBrand"] = implode(" ", $return["fullBrand"]); 
				$return["fullName"] = $return["fullBrand"]." ".$return["fullName"];
			}
			
			#Pics
			$return["picTire"] = $this->tirePicSrc.$row->id."_felni.png";
			$return["picCar"] = $this->tirePicSrc.$row->id."_auto.png";
		}
		else { $return = false; }
		
		return $return;
	}
	
	#Get tires
	public function getTires($model = NULL, $deleted = 0, $selectFields = "id", $orderBy = "orderNumber, model")
	{
		$return = [];
		$rows = $this->model->getTires($model, $deleted, $selectFields, $orderBy);
		if(!empty($rows)) { foreach($rows AS $row) { $return[$row->id] = $this->getTire($row->id); } }
		
		return $return;
	}
	
	#Adminwork
	public function adminWork($work, $datas)
	{
		#Datas
		$tableKey = "cars";
		$table = $this->model->tables($tableKey);
		$return = [
			"work" => $work,
			"datas" => $datas,
			"table" => $table,
			"success" => true,
			"id" => NULL,
		];
		
		#Work
		switch($work)
		{
			case "new":
			case "edit":
				#Id
				$id = ($work == "edit") ? $datas["id"] : 0;
				
				#Fields and params
				$params = [];
				$fields = ["user", "model", "active", "name", "shortName", "shortText", "priceList", "priceSale", "isNet", "text", "facility", "carBodyNumber"];
				foreach($fields AS $field)
				{
					if(isset($datas[$field])) { $params[$field] = trim($datas[$field]); }
				}
				if(isset($params["priceSale"]) AND empty($params["priceSale"])) { $params["priceSale"] = NULL; }
				if(!isset($params["active"]) OR empty($params["active"])) { $params["active"] = 0; }
				if(!isset($params["isNet"]) OR empty($params["isNet"])) { $params["isNet"] = 0; }
				
				#Special params
				if($work == "new") { $params["type"] = $this->model->getTypeByURL($GLOBALS["URL"]->routes[0], "id"); }
				$params["url"] = $this->setCarURL($params["name"], $id);
				$params["price"] = (isset($params["priceSale"]) AND $params["priceSale"] < $params["priceList"]) ? $params["priceSale"] : $params["priceList"];
				
				#Database command
				if($work == "edit") { $this->model->myUpdate($table, $params, $datas["id"]); }
				else { $id = $this->model->myInsert($table, $params); }
				$return["id"] = $id;
				
				#Pic, Document
				getController("File");
				$file = new FileController();
				
				$fileReturn = $file->upload("pic", "used-cars-pic", $id);
				if($fileReturn[0]["type"] == "success") { $this->model->myUpdate($table, ["pic" => $fileReturn[0]["fileID"]], $id); }
				
				$fileReturn = $file->upload("mydocument", "used-cars-document", $id);
				if($fileReturn[0]["type"] == "success") { $this->model->myUpdate($table, ["document" => $fileReturn[0]["fileID"]], $id); }
				break;
			case "del":
				$this->model->myDelete($table, $datas["id"]);
				$return["id"] = $datas["id"];
				break;
			case "activate":
			case "deactivate":
				$active = ($work == "activate") ? 1 : 0;
				$this->model->myUpdate($table, ["active" => $active], $datas["id"]);
				$return["id"] = $datas["id"];
				break;
			case "pic-del":
				$this->model->myUpdate($table, ["pic" => NULL], $datas["id"]);
				$return["id"] = $datas["id"];
				break;	
			case "document-del":
				$this->model->myUpdate($table, ["document" => NULL], $datas["id"]);
				$return["id"] = $datas["id"];
				break;		
		}
		
		#Log
		if(isset($GLOBALS["log"]))
		{
			$logParams = [
				"vchar1" => "UsedCar",
				"vchar2" => $tableKey,
				"vchar3" => $work,
				"text1" => $this->json($return),
			];
			$GLOBALS["log"]->log($return, $logParams);
		}
		
		#Return
		return $return;
	}
	
	#Generate car URL
	public function setCarURL($name, $id = 0)
	{
		return $this->setUniqueURL($this->model->tables("cars"), "url", $name, "", ["del" => 0], $id);
	}
	
	#Check car URL duplication
	public function checkCarURL($url, $id = 0)
	{
		$rows = $this->model->checkUniqueField($this->model->tables("cars"), "name", $url, ["del" => 0], $id);
		if(count($rows) > 0) { return false; }
		else { return true; }
	}
}
?>