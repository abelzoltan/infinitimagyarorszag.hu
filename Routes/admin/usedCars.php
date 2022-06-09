<?php 
getController("UsedCar");
$cars = new UsedCarController();
$typeName = $routes[0];

if(isset($routes[1]) AND !empty($routes[1]))
{
	switch($routes[1])
	{
		case "new":
		case "edit":
			if($routes[1] == "edit")
			{
				$car = $cars->getCar($routes[2]);
				if($car === false) { $URL->redirect([$routes[0]], ["error" => "unknown"]); }
			}
			
			if(isset($_POST["process"]) AND $_POST["process"])
			{
				if($_POST["work"] != $routes[1]) { $URL->redirect([$routes[0]], ["error" => "unknown"]); }
				elseif($routes[1] == "edit" AND $_POST["id"] != $routes[2]) { $URL->redirect([$routes[0]], ["error" => "unknown"]); }
				else
				{
					$return = $cars->adminWork($routes[1], $_POST);
					$URL->redirect([$routes[0], "edit", $return["id"]], ["success" => $routes[1]]);
				}
			}
			else
			{
				if($routes[1] == "edit")
				{
					$VIEW["title"] = "Autó szerkesztése <br><small>".$car["name"]."</small>";
					$VIEW["vars"]["currentCar"] = $car;
					$VIEW["vars"]["formRow"] = $car["data"];
				}
				else
				{
					$VIEW["title"] = "Új autó felvitele";
					$VIEW["vars"]["currentCar"] = [];
					$VIEW["vars"]["formRow"] = new stdClass();
				}
				$VIEW["vars"]["postWork"] = $routes[1];
				$VIEW["vars"]["usedCarModels"] = $cars->getModelsForSelectWithDel();
				$VIEW["vars"]["usedCarUsers"] = $cars->getUsersForSelect();
				$VIEW["vars"]["usedCarPriceTexts"] = ["list" => $cars->priceList, "sale" => $cars->priceSale, "net" => $cars->priceNet];
				$VIEW["sections"]["titleRight"] = "admin/_title-right-back-btn";
				$VIEW["name"] = "used-cars-form";
			}
			break;
		case "gallery":
			$car = $cars->getCar($routes[2]);
			if($car === false) { $URL->redirect([$routes[0]], ["error" => "unknown"]); }
			else
			{
				$fileType = "used-cars-gallery";
				$files = new FileController();
				$fileList = $files->getFileList($fileType, $car["id"]);
				
				$VIEW["nameDir"] = "admin";
				$VIEW["name"] = "list-panel-files"; 
				$VIEW["vars"]["FILEDATAS"] = [
					"panelName" => $car["name"]." <em>[".$car["carBodyNumber"]."]</em>",
					"backButton" => $URL->link([$routes[0]]),
					"uploadLabel" => "Kép(ek) feltöltése",
					"uploadAction" => $URL->link(["file", "upload"], ["from" => $routes]),
					"editAction" => $URL->link(["file", "edit"], ["from" => $routes]),
					"from" => $routes,
					
					"type" => $fileType,
					"foreignKey" => $car["id"],
					"fileList" => $fileList,
				];
				$VIEW["title"] = "Galéria képek kezelése"; 
				$VIEW["sections"]["titleRight"] = "admin/_title-right-back-btn";
			}
			break;
		case "del":
		case "activate":
		case "deactivate":
			$cars->adminWork($routes[1], ["id" => $routes[2]]);
			$URL->redirect([$routes[0]], ["success" => $routes[1]]);
			break;
		default:
			$URL->redirect([$routes[0]]);
			break;		
	}
}
else
{
	$VIEW["sections"]["titleRight"] = "admin/_title-right-new-btn";
	$VIEW["name"] = "list-panel";
	$VIEW["vars"]["newButton"]["label"] = "Új autó felvitele";
	$VIEW["vars"]["LIST"] = [
		"panelName" => "Autók listája",
		"table" => [
			"header" => [
				[
					"name" => "ID", 
					"class" => "", 
					"style" => "", 
				],	
				[
					"name" => "Alvázszám", 
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => "Modell", 
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => "Név", 
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => "Rövid név", 
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => "Rövid ismertető", 
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => $cars->priceList, 
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => $cars->priceSale, 
					"class" => "", 
					"style" => "", 
				],			
			],
			"buttons" => ["edit", "gallery", "active", "del"],
			"rows" => [],
		],
	];
	
	$models = $cars->getModelsForSelect();
	$rows = $cars->getCars($typeName);
	$i = 1;
	foreach($rows["all"] AS $rowKey => $row)
	{
		$VIEW["vars"]["LIST"]["table"]["rows"][$row["id"]] = [
			"row" => $row,
			"data" => $row["data"],
			"columns" => [	
				[
					"name" => $row["id"],
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => $row["carBodyNumber"], 
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => $models[$row["data"]->model], 
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => $row["name"]."<br><a href='".PATH_ROOT_WEB.$row["url"]."' target='_blank'><small class='color-gray'>".$row["url"]."</small></a>", 
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => $row["shortName"], 
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => $row["shortText"], 
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => $row["priceListOut"], 
					"class" => "", 
					"style" => "", 
				],
				[
					"name" => $row["priceSaleOut"], 
					"class" => "", 
					"style" => "", 
				],
				
			],
			"buttons" => [
				"gallery" => [
					"class" => "dark",
					"icon" => "picture-o",
					"href" => $URL->link([$routes[0], "gallery", $row["id"]]),
					"title" => "Galéria (További képek)",
				],
			],	
		];
		$i++;
	}
}
?>