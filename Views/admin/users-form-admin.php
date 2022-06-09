<script>
function formCheck()
{
	if($("#password1").val() != $("#password2").val())
	{
		alert("A jelszavak nem egyeznek!");
		return false;
	}
	else { return true; }
}
</script>
<?php
if(!isset($formRow)) 
{ 
	$work = "new";
	$panel2Labels = ["Jelszó", "Jelszó", "Jelszó ismét"];
	$formRow = ["data" => new stdClass()]; 
	
	if(isset($_SESSION[SESSION_PREFIX."post-data"]))
	{
		foreach($_SESSION[SESSION_PREFIX."post-data"] AS $dataKey => $dataVal) { $formRow["data"]->$dataKey = $dataVal; }
	}
}
else
{
	$work = "edit";
	$panel2Labels = ["Jelszócsere", "Új jelszó", "Új jelszó ismét"];
}

if(isset($_SESSION[SESSION_PREFIX."return-errors"]) AND !empty($_SESSION[SESSION_PREFIX."return-errors"]))
{
	$errors = $_SESSION[SESSION_PREFIX."return-errors"];
	$errorsOut = [];
	if(in_array("missingFields", $errors)) { $errorsOut[] = "A csillaggal jelölt mezők kitöltése kötelező!"; }
	if(in_array("passwordMismatch", $errors)) { $errorsOut[] = "A jelszavak nem egyeznek!"; }
	if(in_array("doubleEmail", $errors)) { $errorsOut[] = "Az e-mail cím már szerepel az adatbázisban!"; }
	
	?>
	<div class="row">
		<div class="col-xs-12">
			<div class="height-5"></div>
			<h2 class="color-danger font-bold">
				<?php echo implode("<br>", $errorsOut); ?>
			</h2>
			<div class="height-5"></div>
		</div>
	</div>
	<?php
	unset($_SESSION[SESSION_PREFIX."return-errors"]);
}

$panels = [
	[
		"name" => "Adatok",
		"inputs" => [
			[
				"type" => "hidden",
				"input" => [
					"name" => "process",
					"value" => "1",
					
				],
			],
			[
				"type" => "hidden",
				"input" => [
					"name" => "work",
					"value" => $GLOBALS["URL"]->routes[1],
					
				],
			],
			[
				"type" => "hidden",
				"input" => [
					"name" => "id",
					"value" => $formRow["data"]->id,
					
				],
			],
			[
				"control-label" => "Profilkép",
				"type" => "file",
				"file" => [
					"name" => "pic",
					"from" => $GLOBALS["URL"]->routes,
					"id" => $formRow["data"]->pic,
					"row" => $formRow["pic"],
				],
			],
			[
				"control-label" => "Vezetéknév",
				"type" => "text",
				"input" => [
					"name" => "lastName",
					"value" => $formRow["data"]->lastName,
					"required" => true,
				],
			],
			[
				"control-label" => "Keresztnév",
				"type" => "text",
				"input" => [
					"name" => "firstName",
					"value" => $formRow["data"]->firstName,
					"required" => true,
				],
			],
			[
				"control-label" => "E-mail cím",
				"type" => "email",
				"input" => [
					"name" => "email",
					"value" => $formRow["data"]->email,
					"required" => true,
				],
			],
			[
				"control-label" => "Rang",
				"type" => "select",
				"input" => [
					"name" => "rank",
					"value" => $formRow["data"]->rank,
					"required" => true,
				],
				"type" => "select",
				"select-options" => $GLOBALS["users"]->getRanksSelect($GLOBALS["user"]["rankNumber"]),
			],
			[
				"control-label" => "Azonosító (Token)",
				"type" => "text",
				"input" => [
					"name" => "token",
					"value" => $formRow["data"]->token,
					"readonly" => true,
				],
			],
			
		],
		"buttons" => [
			[
				"type" => "back",
				"href" => $GLOBALS["URL"]->link([$GLOBALS["URL"]->routes[0]]),
			],
			[
				"type" => "submit",
			],
		],
	],
	[
		"name" => $panel2Labels[0],
		"inputs" => [
			[
				"control-label" => $panel2Labels[1],
				"type" => "password",
				"input" => [
					"name" => "password1",
				],
				"id" => "password1",
			],
			[
				"control-label" => $panel2Labels[2],
				"type" => "password",
				"input" => [
					"name" => "password2",
				],
				"id" => "password2",
			],
		],
		"buttons" => [
			[
				"type" => "back",
				"href" => $GLOBALS["URL"]->link([$GLOBALS["URL"]->routes[0]]),
			],
			[
				"type" => "submit",
			],
		],
	],
];

if($work == "new")
{
	unset($panels[0]["inputs"][3]);
	unset($panels[0]["inputs"][8]);
}

$details = [
	"action" => $GLOBALS["URL"]->currentURL,
	"method" => "post",
	"enctype" => "multipart/form-data",
	"onsubmit" => "return formCheck()",
];

getController("Form");
$form = new FormController();
echo $form->createForm($details, $panels);
unset($_SESSION[SESSION_PREFIX."post-data"]);
?>