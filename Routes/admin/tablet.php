<?php
$tablet = new DB($dbGabliniOld);

$VIEW["name"] = "list-panel";
$VIEW["vars"]["LIST"] = [
	"order" => [
		"column" => 0,
		"type" => "desc",
	],
	"panelName" => "Regisztráltak listája",
	"table" => [
		"header" => [
			[
				"name" => "Dátum", 
				"class" => "", 
				"style" => "", 
			],	
			[
				"name" => "Tárgy", 
				"class" => "", 
				"style" => "", 
			],
			[
				"name" => "Modell(ek)", 
				"class" => "", 
				"style" => "", 
			],
			[
				"name" => "Név", 
				"class" => "", 
				"style" => "", 
			],
			[
				"name" => "E-mail cím", 
				"class" => "", 
				"style" => "", 
			],
			[
				"name" => "Telefonszám", 
				"class" => "", 
				"style" => "", 
			],
			[
				"name" => "Irsz.", 
				"class" => "", 
				"style" => "", 
			],
			[
				"name" => "Megjegyzés", 
				"class" => "", 
				"style" => "", 
			],
			[
				"name" => "Játék - Válaszok", 
				"class" => "", 
				"style" => "", 
			],				
		],
		"buttons" => [],
		"rows" => [],
	],
];

$rows = $tablet->select("SELECT * FROM tablet_regisztracio_infiniti WHERE del = '0' ORDER BY id DESC");
$i = 1;
foreach($rows AS $row)
{
	if($row->goodAnswers !== NULL) { $answers = "Jó válaszok: ".$row->goodAnswers."/".$row->allAnswers; }
	else { $answers = "<em>Csak érdeklődés!</em>"; }
	
	$VIEW["vars"]["LIST"]["table"]["rows"][$row->id] = [
		"row" => $row,
		"data" => $row,
		"columns" => [	
			[
				"name" => date("Y. m. d. H:i", strtotime($row->created_at)),
				"class" => "", 
				"style" => "", 
			],
			[
				"name" => $row->subject, 
				"class" => "", 
				"style" => "", 
			],
			[
				"name" => $row->car, 
				"class" => "", 
				"style" => "", 
			],
			[
				"name" => "<strong>".$row->name."</strong>", 
				"class" => "", 
				"style" => "", 
			],
			[
				"name" => "<a href='mailto:".$row->email."' target='_blank' class='color-blue'>".$row->email."</a>", 
				"class" => "", 
				"style" => "", 
			],
			[
				"name" => $row->phone, 
				"class" => "", 
				"style" => "", 
			],
			[
				"name" => $row->address, 
				"class" => "", 
				"style" => "", 
			],
			[
				"name" => $row->comment, 
				"class" => "", 
				"style" => "", 
			],
			[
				"name" => $answers, 
				"class" => "", 
				"style" => "", 
			],
		],
		"buttons" => [],	
	];
	$i++;
}
?>