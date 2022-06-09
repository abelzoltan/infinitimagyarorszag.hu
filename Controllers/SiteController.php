<?php 
class SiteController extends BaseController
{
	public $routes;
	public $data;
	public $name;
	public $baseName;
	
	public function __construct($connectionData = [])
	{
		#Model
		$this->getModel($connectionData);
		
		#URL
		$url = $GLOBALS["rootURL"];
		
		#Get site
		$siteID = $this->getSiteByBaseUrlAndName($url->routes[0], $_SERVER["SERVER_NAME"]); // By first route AND Server name 
		if(empty($siteID))
		{
			$siteID = $this->getSiteByBaseUrlAndName("", $_SERVER["SERVER_NAME"]); // By empty first route AND Server name
			if(empty($siteID)) 
			{ 
				$siteID = $this->getSiteByBaseUrlAndName($url->routes[0], NULL); // By first route
				if(empty($siteID)) { $siteID = $this->getSiteByBaseUrlAndName("", NULL);  } // By empty first route
			}
		}

		if(!empty($siteID))
		{
			$this->data = $this->model->getSite($siteID);
			$this->name = $this->data->url;
			$this->routes = $this->name.".php";
			$this->baseName = $this->data->baseName;
			if(!empty($this->baseName)) { $this->baseName .= "/"; }
		}
	}
	
	#Pager
	public function pager($rowCount, $itemsPerPage = 25, $link = NULL, $getDataName = "oldal")
	{
		#Basic
		$getData = $GLOBALS["URL"]->get;
		if($link === NULL) { $link = $GLOBALS["URL"]->currentURL; }
		
		#Set from and to
		$allPages = ceil($rowCount / $itemsPerPage);
		if(isset($_GET[$getDataName])) 
		{ 
			if($_GET[$getDataName] >= ($allPages - 1)) { $activePage = $allPages - 1; }
			elseif(empty($_GET[$getDataName]) OR $_GET[$getDataName] < 0) { $activePage = 0; }
			else { $activePage = $_GET[$getDataName]; }
		}
		else { $activePage = 0; }
		$from = $activePage * $itemsPerPage;
		
		$return = [
			"link" => $link,
			"getDataName" => $getDataName,
			"itemsPerPage" => $itemsPerPage,
			"rowCount" => $rowCount,
			"allPages" => $allPages,
			"activePage" => $activePage,
			"from" => $from,
			"to" => $from + $itemsPerPage - 1,
			"pageList" => [],
		];
		
		#Set pages
		for($i = 1; $i <= $return["allPages"]; $i++)
		{
			$page = [];
			$page["index"] = $i;
			$page["page"] = $i - 1;
			$page["from"] = $page["page"] * $return["itemsPerPage"];
			$page["fromOut"] = $page["from"] + 1;
			if($i < $return["allPages"]) 
			{ 
				$page["to"] = $page["from"] + $return["itemsPerPage"] - 1; 
				$page["toOut"] = $page["to"] + 1;
			}
			else { $page["to"] = $page["toOut"] = $rowCount; }
			$page["label"] = $page["fromOut"]." - ".$page["toOut"];
			 
			if($i > 1) { $getData[$getDataName] = $page["page"]; }
			elseif(isset($getData[$getDataName])) { unset($getData[$getDataName]); }
			$page["link"] = $link;
			if(!empty($getData)) { $page["link"] .= "?".http_build_query($getData); }
			
			$return["pageList"][$page["page"]] = $page;
		}
		
		return $return;
	}
	
	#Get site
	public function getSite($id, $allData = true)
	{
		$return = [];
		$return["data"] = $site = $this->model->getSite($id);
		
		if($allData)
		{
			getController("File");
			$file = new FileController();
			$return["sliders"] = $this->getActiveSlides($site->id);
			$return["slider"] = [];
			$return["sliderMobile"] = [];
			foreach($return["sliders"] AS $rowID => $row)
			{
				if(isset($row["picPC"])) { $return["slider"][$rowID] = ["data" => $row["data"], "file" => $row["picPC"]]; }
				if(isset($row["picMobile"])) { $return["sliderMobile"][$rowID] = ["data" => $row["data"], "file" => $row["picMobile"]]; }
			}
		}
		
		return $return;
	}
	
	public function getSiteByURL($url, $allData = true)
	{
		$id = $this->model->getSiteByURL($url, "id");
		return $this->getSite($id, $allData);
	}
	
	public function getSiteByBaseUrlAndName($name = "", $url)
	{
		$table = $this->model->tables("sites");
		$query = "SELECT id FROM ".$table." WHERE baseName = :baseName";
		$params = ["baseName" => $name];
		if(!empty($url))
		{
			$query .= " AND baseURL = :baseURL";
			$params["baseURL"] = $url;
		}
		
		$rows = $this->model->select($query, $params);
		if(!empty($rows)) { $return = $rows[0]->id; }
		else { $return = false; }
		
		return $return;
	}
	
	#Get all sites
	public function getSites($orderBy = "url", $key = "url")
	{
		$rows = $this->model->getSites($orderBy);
		$return = [];
		foreach($rows AS $i => $row) 
		{ 
			if(!empty($key)) { $keyHere = $row->$key; }
			else { $keyHere = $i; }
			$return[$keyHere] = $row; 
		}
		
		return $return;
	}
	
	#Get slides
	public function getSlide($id, $allData = true)
	{
		$return = [];
		$return["data"] = $slide = $this->model->getSlide($id);
		if($allData)
		{
			getController("File");
			$file = new FileController();
			if(!empty($slide->picPC)) { $return["picPC"] = $file->getFile($slide->picPC); }
			if(!empty($slide->picMobile)) { $return["picMobile"] = $file->getFile($slide->picMobile); }
		}
		
		return $return;
	}
	
	public function getSlides($site, $deleted = 0, $key = "id")
	{
		$return = [];
		$rows = $this->model->getSlides($site, $deleted);		
		foreach($rows AS $row) { $return[$row->$key] = $this->getSlide($row->id, false); }		
		return $return;
	}
	
	#Get active slides
	public function getActiveSlides($site)
	{
		$return = [];
		$rows = $this->model->getActiveSlides($site);
		foreach($rows AS $row) { $return[$row->id] = $this->getSlide($row->id, true); }	
		return $return;		
	}
	
	#Adminwork
	public function adminWork($tableName, $workType, $datas)
	{
		$table = $this->model->tables($tableName);
		$return = [
			"table" => $tableName,
			"work" => $workType,
			"datas" => $datas,
			"errors" => [],
			"type" => "success",
			"params" => [],
			"id" => NULL,
		];
		
		switch($tableName)
		{
			case "sliders":
				$fields = ["name", "href", "hrefTargetBlank", "dateFrom", "dateTo", "buttonText", "buttonStyle"];
				$required = ["name"];
				$orderWhere = "del = '0' AND site = :site";
				$orderParams = ["site" => $datas["site"]];
				switch($workType)
				{
					case "new":
					case "edit":
						if($workType == "new") { $id = 0; }
						else { $id = $datas["id"];  }

						#Required
						foreach($required AS $requiredField)
						{
							if(!isset($datas[$requiredField]) OR empty($datas[$requiredField]))
							{
								$return["errors"]["required"][] = $requiredField;
								$return["type"] = "error";
							}
						}
						
						if($return["type"] == "success")
						{							
							#Params
							$params = [];
							foreach($fields AS $field)
							{
								if($field == "active" AND (!isset($datas[$field]) OR empty($datas[$field]))) { $datas[$field] = 0; }
								if($field == "dateFrom" AND (!isset($datas[$field]) OR empty($datas[$field]))) { $datas[$field] = NULL; }
								if($field == "dateTo" AND (!isset($datas[$field]) OR empty($datas[$field]))) { $datas[$field] = NULL; }
								$params[$field] = $datas[$field];
							}
							
							#OrderNumber, database command
							if($workType == "new") 
							{ 
								$fields[] = "site";
								$params["site"] = $datas["site"];
								
								$fields[] = "orderNumber";
								$params["orderNumber"] = $this->model->reOrder($table, $orderWhere, $orderParams);
								
								$return["id"] = $this->model->insert($table, $params);
							}
							else
							{ 
								$this->model->update($table, $params, $id);
								$return["id"] = $id;
							}
							
							$return["params"] = $params;
						}
						break;
					case "del":
						$this->model->delete($table, $datas["id"]);
						$this->model->reOrder($table, $orderWhere, $orderParams);
						break;
					case "activate":
						$this->model->update($table, ["active" => 1], $datas["id"]);
						break;	
					case "deactivate":
						$this->model->update($table, ["active" => 0], $datas["id"]);
						break;		
					case "order":
						$return["order"] = $this->model->newOrder($datas["orderType"], $datas["id"], $table, $orderWhere, $orderParams);
						break;
					case "pic-pc":	
						$this->model->update($table, ["picPC" => $datas["pic"]], $datas["id"]);
						break;
					case "pic-mobile":	
						$this->model->update($table, ["picMobile" => $datas["pic"]], $datas["id"]);
						break;	
					default:
						$return["errors"]["others"] = "unknown-worktype";
						$return["type"] = "error";
						break;	
				}
			break;	
			default:
				$return["errors"]["others"] = "unknown-table";
				$return["type"] = "error";
				break;	
		}
		return $return;
	}
}
?>