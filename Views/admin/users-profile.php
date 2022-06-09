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

/*$(document).ready(function(){
    $(".has-error input, .has-error select").change(function(){
        $(this).parents().removeClass("has-error");
        $(this).parents().removeClass("has-feedback");
		
        $(this).siblings().hide();
    });
});*/
</script>
<?php 
$row = $GLOBALS["user"];
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
				"control-label" => "Profilkép",
				"type" => "file",
				"file" => [
					"name" => "pic",
					"from" => $GLOBALS["URL"]->routes[0],
					"id" => $row["data"]->pic,
					"row" => $row["pic"],
				],
			],
			[
				"control-label" => "Vezetéknév",
				"type" => "text",
				"input" => [
					"name" => "lastName",
					"value" => $row["data"]->lastName,
					"required" => true,
				],
			],
			[
				"control-label" => "Keresztnév",
				"type" => "text",
				"input" => [
					"name" => "firstName",
					"value" => $row["data"]->firstName,
					"required" => true,
				],
			],
			[
				"control-label" => "E-mail cím",
				"type" => "email",
				"input" => [
					"name" => "email",
					"value" => $row["data"]->email,
					"required" => true,
				],
			],
			[
				"type" => "ln_solid",
			],
			[
				"control-label" => "Azonosító (Token)",
				"type" => "text",
				"input" => [
					"name" => "token",
					"value" => $row["data"]->token,
					"readonly" => true,
				],
			],
			[
				"control-label" => "Rang",
				"type" => "text",
				"input" => [
					"name" => "rank",
					"value" => $row["rank"]->name,
					"readonly" => true,
				],
			],
		],
		"buttons" => [
			[
				"type" => "submit",
			],
		],
	],
	[
		"name" => "Jelszócsere",
		"inputs" => [
			[
				"control-label" => "Új jelszó",
				"type" => "password",
				"input" => [
					"name" => "password1",
				],
				"id" => "password1",
			],
			[
				"control-label" => "Új jelszó ismét",
				"type" => "password",
				"input" => [
					"name" => "password2",
				],
				"id" => "password2",
			],
		],
		"buttons" => [
			[
				"type" => "submit",
			],
		],
	],
];

$details = [
	"action" => PATH_WEB.$GLOBALS["URL"]->routes[0],
	"method" => "post",
	"enctype" => "multipart/form-data",
	"onsubmit" => "return formCheck()",
];

getController("Form");
$form = new FormController();
echo $form->createForm($details, $panels);
?>