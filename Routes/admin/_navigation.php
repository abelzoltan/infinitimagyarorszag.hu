<?php 
#Menus
$VIEW["vars"]["navigation"] = $navigation = [
	"manage" => [
		"name" => "Menedzsment",
		"ranks" => [4], 
		"menu" => [	
			"users" => [
				"url" => PATH_WEB."users",
				"targetBlank" => false,
				"icon" => "fa fa-user",
				"name" => "Felhasználók",
			],
		],
	],
	"infiniti" => [
		"name" => INFINITI_GABLINI,
		"ranks" => [3, 4], 
		"menu" => [	
			"stock" => [
				"url" => PATH_WEB."stock",
				"targetBlank" => false,
				"icon" => "fa fa-key",
				"name" => "Készleten lévő autók",
			],
			"approved" => [
				"url" => PATH_WEB."approved",
				"targetBlank" => false,
				"icon" => "fa fa-car",
				"name" => "Használtautók [Approved]",
			],
			"tablet-registration" => [
				"url" => PATH_WEB."tablet-registration",
				"targetBlank" => false,
				"icon" => "fa fa-tablet",
				"name" => "Tablet (iPad) regisztrációk",
			],
		],
	],
	"others" => [
		"name" => "Külső hivatkozások",
		"ranks" => [3, 4], 
		"menu" => [
			"infiniti" => [
				"url" => "https://www.infiniti.hu",
				"targetBlank" => true,
				"icon" => "fa fa-italic",
				"name" => "Infiniti.hu",
				"ranks" => [], 
				"menu" => [], 
			],
			"gablini" => [
				"url" => "https://gablini.hu",
				"targetBlank" => true,
				"icon" => "fa fa-google",
				"name" => "Gablini.hu",
				"ranks" => [], 
				"menu" => [], 
			],
			"public" => [
				"url" => PATH_ROOT_WEB,
				"targetBlank" => true,
				"icon" => "fa fa-sign-in",
				"name" => "Weboldal",
				"ranks" => [], 
				"menu" => [], 
			],
		],
	],
	"hidden" => [
		"name" => "Rejtett menük",
		"ranks" => [3, 4], 
		"menu" => [
			"home" => [
				"url" => PATH_WEB,
				"targetBlank" => false,
				"icon" => "",
				"name" => "Főoldal",
				"ranks" => [], 
				"menu" => [], 
			],
			"profile" => [
				"url" => PATH_WEB."profile",
				"targetBlank" => false,
				"icon" => "",
				"name" => "Profil",
				"ranks" => [], 
				"menu" => [], 
			],
		],
	],
];

#Active menu
$VIEW["vars"]["activeMenu"] = $activeMenu = [
	"navKey" => "",
	"menuKey" => "",
	"subMenuKey" => "",
	"navData" => "",
	"menuData" => "",
	"subMenuData" => "",
	"level" => 0,
];
foreach($navigation AS $navKey => $navData)
{
	if(count($navData["menu"]) > 0)
	{
		foreach($navData["menu"] AS $menuKey => $menu)
		{
			if(!empty($menu["url"]) AND ($GLOBALS["URL"]->currentURL == $menu["url"] OR PATH_WEB.$routes[0] == $menu["url"] OR PATH_WEB.$routes[0]."/".$routes[1] == $menu["url"]))
			{
				$VIEW["vars"]["activeMenu"]["navKey"] = $activeMenu["navKey"] = $navKey;
				$VIEW["vars"]["activeMenu"]["menuKey"] = $activeMenu["menuKey"] = $menuKey;
				$VIEW["vars"]["activeMenu"]["navData"] = $activeMenu["navData"] = $navData;
				$VIEW["vars"]["activeMenu"]["menuData"] = $activeMenu["menuData"] = $menu;
				$VIEW["vars"]["activeMenu"]["level"] = $activeMenu["level"] = 1;
				$VIEW["title"] = $menu["name"];
			}
			elseif(count($menu["menu"]) > 0)
			{
				foreach($menu["menu"] AS $subMenuKey => $subMenu)
				{
					if(!empty($subMenu["url"]) AND ($GLOBALS["URL"]->currentURL == $subMenu["url"] OR PATH_WEB.$routes[0] == $subMenu["url"] OR PATH_WEB.$routes[0]."/".$routes[1] == $subMenu["url"]))
					{
						$VIEW["vars"]["activeMenu"]["navKey"] = $activeMenu["navKey"] = $navKey;
						$VIEW["vars"]["activeMenu"]["menuKey"] = $activeMenu["menuKey"] = $menuKey;
						$VIEW["vars"]["activeMenu"]["subMenuKey"] = $activeMenu["menuKey"] = $subMenuKey;
						$VIEW["vars"]["activeMenu"]["navData"] = $activeMenu["navData"] = $navData;
						$VIEW["vars"]["activeMenu"]["menuData"] = $activeMenu["menuData"] = $menu;
						$VIEW["vars"]["activeMenu"]["subMenuData"] = $activeMenu["subMenuData"] = $subMenu;
						$VIEW["vars"]["activeMenu"]["level"] = $activeMenu["level"] = 2;
						$VIEW["title"] = $subMenu["name"];
					}
				}
			}
		}
	}
}
?>