<?php 
$VIEW["vars"]["news"] = $news = [
	"almai-tesztvezetese-az-infinititol" => [
		"name" => "ÁLMAI TESZTVEZETÉSE AZ INFINITITŐL",
		"text" => "1 NYERTES. 1 ÉLETRE SZÓLÓ ÉLMÉNY.",
		"img" => "almai-tesztvezetese-az-infinititol.jpg",
	],
	"infiniti-telivezetes" => [
		"name" => "INFINITI TÉLI VEZETÉS",
		"text" => "A TÉL KEZDETE NEM FELTÉTLENÜL JELENTI A KALANDOZÁS VÉGÉT!",
		"img" => "infiniti-telivezetes.jpg",
	],
	"a-qx-inspiration" => [
		"name" => "A QX Inspiration",
		"text" => "A QX INSPIRATION A KATEGÓRIÁK HATÁRAIT ÁTLÉPŐ ELEKTROMOS TANULMÁNYAUTÓ, AMELY ÚJRAÉRTELMEZHETI AZ ELEKTROMOS CROSSOVER FOGALMÁT.",
		"img" => "a-qx-inspiration.jpg",
	],
	"project-black-s" => [
		"name" => "PROJECT BLACK S",
		"text" => "ÍME, AZ ELSŐ EXKLUZÍV KÉP EGY SPORTAUTÓ TELJESÍTMÉNYÉNEK MEGTESTESÜLÉSÉRŐL.",
		"img" => "project-black-s.png",
	],
	"infiniti-prototype-10" => [
		"name" => "INFINITI PROTOTYPE 10",
		"text" => "AZ ALAPOK MEGTEREMTÉSE. A LEGMAGASABB SZINTŰ TELJESÍTMÉNY. SZÜNTELENÜL TÖREKSZÜNK A HALADÁSRA.",
		"img" => "infiniti-prototype-10.jpg",
	],
	"a-vilag-felfedezese-az-infiniti-vel" => [
		"name" => "A VILÁG FELFEDEZÉSE AZ INFINITI-VEL",
		"text" => "A FELFEDEZŐK KLUBJA DINOSZAURUSZ-FOSSZÍLIÁKRA VADÁSZIK A GÓBI SIVATAGBAN",
		"img" => "a-vilag-felfedezese-az-infiniti-vel.jpg",
	],
	"alan-geaam-hajlektalan-mosogatofiubol-michelin-csillagos-sef" => [
		"name" => "ALAN GEAAM: HAJLÉKTALAN MOSOGATÓFIÚBÓL MICHELIN CSILLAGOS SÉF",
		"text" => "AZ INFINITINEK ALKALMA NYÍLT EGY BESZÉLGETÉSRE ALANNEL, ÍGY ELSŐ KÉZBŐL HALLHATTA A FÉRFI INSPIRÁLÓ TÖRTÉNETÉT. ITT KÖVETHETI NYOMON UTAZÁSÁT.",
		"img" => "alan-geaam-hajlektalan-mosogatofiubol-michelin-csillagos-sef.jpg",
	],
	"belevagunk-az-elektromositasba" => [
		"name" => "BELEVÁGUNK AZ ELEKTROMOSÍTÁSBA",
		"text" => "EXKLUZÍV BEJELENTÉSEK A 2018-AS PEKINGI AUTÓSZALONRÓL. AZ INFINITI BEJELENTI ELSŐ LÉPÉSEIT AZ ELEKTROMOS JÖVŐ FELÉ.",
		"img" => "belevagunk-az-elektromositasba.jpg",
	],
	"infiniti-prototype-9" => [
		"name" => "INFINITI PROTOTYPE 9",
		"text" => "ISMERJE MEG VERSENYAUTÓ-TANULMÁNYUNKAT, MELYET A MÚLT IHLETETT, A JÖVŐ TECHNOLÓGIÁJA HAJT.",
		"img" => "infiniti-prototype-9.png",
	],
	"az-infiniti-vilagelso-megoldasai" => [
		"name" => "AZ INFINITI VILÁGELSŐ MEGOLDÁSAI",
		"text" => "OLYAN INNOVÁCIÓK EZEK, AMELYEK ÖNT HELYEZIK AZ UTAZÁS KÖZÉPPONTJÁBA, REAGÁLNAK A KÖRNYEZETI VISZONYOKRA – ÉS AZ ÖN VISELKEDÉSÉRE –, ÍGY VEZETŐKÉNT SOKKAL TÖBBRE LEHET KÉPES.",
		"img" => "az-infiniti-vilagelso-megoldasai.png",
	],
	"visszateres-kubaba" => [
		"name" => "Visszatérés Kubába",
		"text" => "58 ÉVE UGYANIS EZ AZ ELSŐ ALKALOM, HOGY EGY ÚJ, EGYESÜLT ÁLLAMOKBELI JÁRMŰ KERÜL FORGALOMBA KUBÁBAN, ÉS HAJT VÉGIG EZEKEN A TÖRTÉNELMI UTCÁKON.",
		"img" => "visszateres-kubaba.png",
	],
];

$VIEW["meta"]["og:type"] = "article";
$VIEW["vars"]["pics"] = CDN_WEB."oldalak/".$routes[0]."/";
if(isset($routes[1]) AND !empty($routes[1]))
{
	if(isset($news[$routes[1]]))
	{
		$VIEW["title"] = "<span style='line-height: 140%;'><strong>".$news[$routes[1]]["name"]."</strong></span>"; 
		$VIEW["name"] = "news/".$routes[1];
		$VIEW["vars"]["pics"] .= $routes[1]."/";
		$VIEW["sections"]["bodyBottom"][] = "_fancybox-new";
	}
	else { $URL->redirect([$routes[0]]); }
}
else
{
	$VIEW["title"] = "<span style='line-height: 140%;'><strong>Hírek és események</strong></span>"; 
	$VIEW["name"] = "news";
}
?>