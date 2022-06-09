<?php
class HasznaltautoImportController extends BaseController
{
	public function import($hash)
	{
		$return = [
			"hash" => $hash,
			"exportLink" => "https://www.jarmukeszlet.hu/export/".$hash,
			"getXMLMode" => NULL,
			"errors" => [],
		];
		
		if(ini_get("allow_url_fopen")) 
		{
			$return["getXMLMode"] = "file_get_contents()";
			$xmlString = @file_get_contents($return["exportLink"]);
		} 
		elseif(function_exists("curl_init")) 
		{
			$return["getXMLMode"] = "curl_init()";
			
			$curl = @curl_init();
			@curl_setopt($curl, CURLOPT_URL, $return["exportLink"]);
			@curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			if(!$xmlString = @curl_exec($curl)) {	$return["errors"]["DOWNLOAD => Get XML File: CURL"] = "An error occured during the CURL methods: ".@curl_error($curl); }
			@curl_close($curl);
		} 
		else 
		{ 
			$return["getXMLMode"] = "ERROR";
			$return["errors"]["DOWNLOAD => Get XML File"] = "HIL can't be donwloaded because of the server settings!";
		}
		
		if(!$xmlString) { $return["errors"]["DOWNLOAD => XML string download"] = "An error occured during downloading the XML string ('xmlString')."; }
		else
		{	
			#Change charset
			$xmlString = iconv("iso-8859-2", "utf-8", $xmlString);
			
			#Cheching HIL XML
			libxml_use_internal_errors(true);
			$objDomDocument = new \DomDocument();
			$objDomDocument->loadXML($xmlString);
			if(!$xmlRows = @simplexml_import_dom($objDomDocument)) { $return["errors"]["CHECKING => Empty XML"] = "The XML file is empty OR it's format isn't XML: ".$return["exportLink"]; }
			else
			{
				#Count rows
				$xmlRowCount = count($xmlRows->children());
				if($xmlRowCount == 0) { $return["errors"]["CHECKING => Row count"] = "Currently there are no active rows!"; }
				
				#Loop XML rows
				$rows = [];
				if(count($return["errors"]) == 0)
				{
					$i = 0;
					foreach($xmlRows AS $xmlRow)
					{
						$rows[$i] = [
							"attributes" => [],
							"datas" => [],
							"pics" => [],
						];
						
						#Row attributes
						foreach($xmlRow->attributes() AS $key => $val) { $rows[$i]["attributes"][$key] = (string)$val; }
						
						#Row children
						foreach($xmlRow->children() AS $itemKey => $itemVal)
						{
							switch($itemKey)
							{
								case "kepek":
									$j = 0;
									foreach($itemVal->children() AS $key => $val) 
									{ 
										$rows[$i]["pics"][$j] = [];
										$rows[$i]["pics"][$j]["itemValue"] = (string)$val;
										foreach($val->attributes() AS $key2 => $val2) { $rows[$i]["pics"][$j][$key2] = (string)$val2; } 
										$j++;
									}
									break;
								default:
									$rows[$i]["datas"][$itemKey] = [];
									$rows[$i]["datas"][$itemKey]["itemValue"] = (string)$itemVal;
									foreach($itemVal->attributes() AS $key => $val) { $rows[$i]["datas"][$itemKey][$key] = (string)$val; }
									break;
							}
						}
						$i++;
					}
				}
			}
		}
		
		$return["xmlString"] = (isset($xmlString)) ? $xmlString : NULL;
		$return["xmlRowCount"] = (isset($xmlRowCount)) ? $xmlRowCount : NULL;
		$return["xmlRowCount"] = (isset($xmlRowCount)) ? $xmlRowCount : NULL;
		$return["rows"] = (isset($rows)) ? $rows : NULL;
		return $return;
	}
	
	public function importProcess($hash)
	{
		$return = [
			"success" => false,
			"cars" => [],
			"import" => $this->import($hash),
		];
		if($return["import"]["rows"] !== NULL AND count($return["import"]["rows"]) > 0)
		{
			$return["success"] = true;
			$options = $this->fieldOptions();
			$optionKeys = array_keys($options);
			$otherDatas = $this->otherDatas();
			
			foreach($return["import"]["rows"] AS $i => $row)
			{			
				#Main datas
				$carName = (isset($row["datas"]["tipusjel"]) AND !empty($row["datas"]["tipusjel"]["itemValue"])) ? $row["datas"]["tipusjel"]["itemValue"] : NULL;
				if($carName === NULL) { continue; }
				
				$priceOriginal = (isset($row["datas"]["vetelar"]) AND !empty($row["datas"]["vetelar"]["itemValue"])) ? $row["datas"]["vetelar"]["itemValue"] : 0;
				$priceSale = (isset($row["datas"]["akciosar"]) AND !empty($row["datas"]["akciosar"]["itemValue"])) ? $row["datas"]["akciosar"]["itemValue"] : 0;
				$priceFull = (isset($row["datas"]["vetelar_teljes"]) AND !empty($row["datas"]["vetelar_teljes"]["itemValue"])) ? $row["datas"]["vetelar_teljes"]["itemValue"] : 0;
				
				$priceOutList = NULL;
				$priceOutListType = NULL;
				$priceOut = NULL;
				$priceOutType = NULL;
				if($priceFull > 0)
				{
					#All 3 prices are filled out
					if($priceSale > 0 AND $priceOriginal > 0)
					{
						$array = ["priceFull" => $priceFull, "priceSale" => $priceSale, "priceOriginal" => $priceOriginal];
						
						$max = max($array);
						$min = min($array);
						
						$maxs = array_keys($array, $max);
						$mins = array_keys($array, $min);						
					
						if($max > $min)
						{
							$priceOut = $array[$mins[0]];
							$priceOutType = $mins[0];
							
							$priceOutList = $array[$maxs[0]];
							$priceOutListType = $maxs[0];
						}
						else
						{
							$priceOut = $array[$maxs[0]];
							$priceOutType = $maxs[0];
						}
					}
					#Has 2 prices: full AND original
					elseif($priceOriginal > 0)
					{
						if($priceFull > $priceOriginal)
						{
							$priceOut = $priceFull;
							$priceOutType = "priceFull";
						}
						else
						{
							$priceOut = $priceOriginal;
							$priceOutType = "priceOriginal";
						}
					}
					#Has 2 prices: full AND sale
					elseif($priceSale > 0)
					{
						#Has sale price
						if($priceSale < $priceFull)
						{
							$priceOut = $priceSale;
							$priceOutType = "priceSale";
							
							$priceOutList = $priceFull;
							$priceOutListType = "priceFull";
						}
						else
						{
							$priceOut = $priceSale;
							$priceOutType = "priceSale";
						}
					}
					#Only full price is filled out
					else
					{
						$priceOut = $priceFull;
						$priceOutType = "priceFull";
					}
				}
				else
				{
					#Has 2 prices: sale AND original
					if($priceSale > 0 AND $priceOriginal > 0)
					{
						#Has sale price
						if($priceSale < $priceOriginal)
						{
							$priceOut = $priceSale;
							$priceOutType = "priceSale";
							
							$priceOutList = $priceOriginal;
							$priceOutListType = "priceOriginal";
						}
						else
						{
							$priceOut = $priceSale;
							$priceOutType = "priceSale";
						}
					}
					#Has 1 price: sale OR original
					elseif($priceOriginal > 0)
					{
						$priceOut = $priceOriginal;
						$priceOutType = "priceOriginal";
					}
					elseif($priceSale > 0)
					{
						$priceOut = $priceSale;
						$priceOutType = "priceSale";
					}
				}
				
				$car = [
					"sourceID" => (isset($row["attributes"]) AND isset($row["attributes"]["belsoazonosito"]) AND !empty($row["attributes"]["belsoazonosito"])) ? $row["attributes"]["belsoazonosito"] : NULL,
					"brand" => (isset($row["datas"]["gyartmany"]) AND isset($options["gyartmany"][$row["datas"]["gyartmany"]["itemValue"]])) ? $options["gyartmany"][$row["datas"]["gyartmany"]["itemValue"]] : NULL,
					"name" => $carName,
					"model" => (!empty($carName)) ? strtolower(explode(" ", $carName)[0]) : NULL,
					"yearMonth" => (isset($row["datas"]["evjarat"]) AND !empty($row["datas"]["evjarat"]["itemValue"])) ? str_replace("-", "/", $row["datas"]["evjarat"]["itemValue"]) : NULL,
					
					"km" => (isset($row["datas"]["futottkm"]) AND !empty($row["datas"]["futottkm"]["itemValue"])) ? $row["datas"]["futottkm"]["itemValue"] : NULL,
					"cm3" => (isset($row["datas"]["hengerurt"]) AND !empty($row["datas"]["hengerurt"]["itemValue"])) ? $row["datas"]["hengerurt"]["itemValue"] : NULL,
					"kw" => (isset($row["datas"]["teljesitmeny"]) AND !empty($row["datas"]["teljesitmeny"]["itemValue"])) ? $row["datas"]["teljesitmeny"]["itemValue"] : NULL,
					
					"priceList" => $priceOutList,
					"priceListType" => $priceOutListType,
					"price" => $priceOut,
					"priceType" => $priceOutType,
					
					"text" => (isset($row["datas"]["leiras"]) AND !empty($row["datas"]["leiras"]["itemValue"])) ? $row["datas"]["leiras"]["itemValue"] : NULL,
				];
				
				#Pictures
				$carPics = [];
				if(isset($row["pics"]) AND !empty($row["pics"]))
				{
					foreach($row["pics"] AS $pic) { $carPics[] = $pic["itemValue"]; }
				}
				
				#Prices
				$carPrices = [];
				$carPricesFields = [
					"vetelar" => "Vételár",
					"regado" => "Plusz regisztrációs adó",
					"vam" => "Plusz vám",
					"akciosar" => "Akciós ár",
					"vetelar_teljes" => "Teljes vételár magyarországi forgalomba helyezés esetén",
				];
				foreach($carPricesFields AS $carPricesFieldKey => $carPricesFieldVal)
				{
					$value = (isset($row["datas"][$carPricesFieldKey]) AND !empty($row["datas"][$carPricesFieldKey]["itemValue"])) ? $row["datas"][$carPricesFieldKey]["itemValue"] : NULL;
					if($value !== NULL)
					{
						$formatted = number_format($value, 0, ",", " ")." Ft";
						$carPrices[$carPricesFieldKey] = [
							"code" => $carPricesFieldKey,
							"name" => $carPricesFieldVal,
							"value" => $value,
							"after" => "Ft",
							"formatted" => $formatted,
						];
					}
				}
				
				#Other datas
				$carDatas = [];
				$otherDataNumber = ["osszsuly", "szemszama", "ajtok", "csomagtarto"];
				foreach($otherDatas AS $otherDataKey => $otherData)
				{
					if(in_array($otherDataKey, $optionKeys)) { $value = (isset($row["datas"][$otherDataKey]) AND isset($options[$otherDataKey][$row["datas"][$otherDataKey]["itemValue"]])) ? $options[$otherDataKey][$row["datas"][$otherDataKey]["itemValue"]] : NULL; }
					else { $value = (isset($row["datas"][$otherDataKey]) AND !empty($row["datas"][$otherDataKey]["itemValue"])) ? $row["datas"][$otherDataKey]["itemValue"] : NULL; }
					if($value !== NULL)
					{
						$formatted = $value;
						if(in_array($otherDataKey, $otherDataNumber)) { $formatted = number_format($value, 0, ",", " "); }
						if(!empty($otherData["after"])) { $formatted .= " ".$otherData["after"]; }
						
						if($otherDataKey == "telefon_1")
						{ 
							if($value = "0000000") { continue; }
							elseif($row["datas"][$otherDataKey]["orszagkod"] == "H") { $formatted = $value = "+36".$row["datas"][$otherDataKey]["korzetszam"].$row["datas"][$otherDataKey]["itemValue"]; }
							else { $formatted = $value = $row["datas"][$otherDataKey]["korzetszam"].$row["datas"][$otherDataKey]["itemValue"]; }
						}
						
						$carDatas[$otherDataKey] = [
							"code" => $otherDataKey,
							"name" => $otherData["name"],
							"value" => $value,
							"after" => $otherData["after"],
							"formatted" => $formatted,
						];
					}
				}
				
				#Return
				$return["cars"][] = [
					"car" => $car,
					"prices" => $carPrices,
					"pics" => $carPics,
					"datas" => $carDatas,
				];
			}
		}
		
		return $return;
	}
	
	public function otherDatas($key = "", $val = "")
	{
		$return = [
			"kivitel" => ["name" => "Kivitel", "after" => ""],
			"veteran" => ["name" => "Veterán?", "after" => ""],
			"allapot" => ["name" => "Állapot", "after" => ""],
			"okmany_jelleg" => ["name" => "Okmányok jellege", "after" => ""],
			"okmany_ervenyes" => ["name" => "Okmányok érvényessége", "after" => ""],
			"eurotaxkod" => ["name" => "Eurotax kód", "after" => ""],
			"tipusjel_eurotax" => ["name" => "Eurotax kód - Típusjel", "after" => ""],

			"jelleg" => ["name" => "Jelleg", "after" => ""],
			"motor" => ["name" => "Üzemanyag", "after" => ""],
			"hengerelrendezes" => ["name" => "Hengerelrendezés", "after" => ""],
			"hajtas" => ["name" => "Hajtás", "after" => ""],
			"kornyezetvedelmiosztaly" => ["name" => "Környezetvédelmi osztály", "after" => ""],
			
			"onsuly" => ["name" => "Önsúly", "after" => "kg"],
			"osszsuly" => ["name" => "Összsúly", "after" => "kg"],
			"szemszama" => ["name" => "Szállítható személyek száma", "after" => "fő"],
			"ajtok" => ["name" => "Ajtók száma", "after" => "db"],
			"szin" => ["name" => "Szín", "after" => ""],
			"metal" => ["name" => "Metál?", "after" => ""],
			"karpitszin1" => ["name" => "Kárpit színei", "after" => ""],
			"karpitszin2" => ["name" => "Kárpit színei", "after" => ""],
			"sebessegvalto" => ["name" => "Sebességváltó fajtája", "after" => ""],
			"felezo_valto" => ["name" => "Felező sebességváltó?", "after" => ""],
			"muszaki" => ["name" => "Műszaki vizsga érvényességi dátuma", "after" => ""],
			"csomagtarto" => ["name" => "Csomagtartó", "after" => "liter"],
			"teto" => ["name" => "Tető", "after" => ""],
			"abroncsmeret" => ["name" => "Abroncsméret", "after" => ""],
			"futasido" => ["name" => "Futásidő", "after" => ""],
			
			"garancialis" => ["name" => "Garanciális", "after" => ""],
			"gar_tipus" => ["name" => "Garancia típusa", "after" => ""],
			"gar_lejarat" => ["name" => "Garancia lejárata", "after" => ""],
			"gar_lejarat_datum" => ["name" => "Garancia lejárata", "after" => ""],
			
			"klima" => ["name" => "Klíma", "after" => ""],
			// "extra_muszaki" => ["name" => "Műszaki felszereltség", "after" => ""],
			// "extra_kenyelmi" => ["name" => "Kényelmi felszereltség", "after" => ""],
			// "extra_biztonsagi" => ["name" => "Biztonsági felszereltség", "after" => ""],
			// "extra_egyeb" => ["name" => "Egyéb információk", "after" => ""],
			// "extra_audio" => ["name" => "HiFi és Multimédia", "after" => ""],
			
			"eklima" => ["name" => "Extra Klíma", "after" => ""],
			// "eextra_muszaki" => ["name" => "Extra Műszaki felszereltség", "after" => ""],
			// "eextra_kenyelmi" => ["name" => "Extra Kényelmi felszereltség", "after" => ""],
			// "eextra_biztonsagi" => ["name" => "Extra Biztonsági felszereltség", "after" => ""],
			// "eextra_egyeb" => ["name" => "Extra Egyéb információk", "after" => ""],
			
			"emailcim" => ["name" => "Email cím", "after" => ""],
			"telefon_1" => ["name" => "Telefonszám", "after" => ""],
		];
		
		if(!empty($key) AND !empty($val)) { return $return[$key][$val]; }
		elseif(!empty($key)) { return $return[$key]; }
		else { return $return; }
	}
	
	public function fieldOptions($key = "", $val = "")
	{
		$return = [
			#Boolean
			"veteran" => ["true" => "Igen", "1" => "Igen", "false" => "Nem", "0" => "Nem"],
			"metal" => ["true" => "Igen", "1" => "Igen", "false" => "Nem", "0" => "Nem"],
			"felezo_valto" => ["true" => "Igen", "1" => "Igen", "false" => "Nem", "0" => "Nem"],
			#List
			"gyartmany" => [
				"5621" => "ABARTH", "7945" => "AC", "20" => "ACURA", "25" => "ADLER", "27" => "AERO", "30" => "AIXAM", "40" => "ALEKO", "50" => "ALFA ROMEO", "7738" => "ALKE", "7804" => "ALL-CARS", "7946" => "ALLARD", "60" => "ALPINA", "5622" => "ALPINE", "62" => "AMC", "7947" => "AMERICAN AUSTIN", "7948" => "AMERICAN BANTAM", "7949" => "ANADOL", "7950" => "ANCHI", "7951" => "ANFINI", "2155" => "ARIEL", "65" => "ARO", "7952" => "ARTEGA", "68" => "ASIA", "70" => "ASTON MARTIN", "7953" => "ASÜNA", "7954" => "AUBURN", "80" => "AUDI", "100" => "AUSTIN", "110" => "AUSTIN MORRIS", "7955" => "AUSTIN-HEALEY", "112" => "AUTO UNION", "90" => "AUTOBIANCHI", "7749" => "AUTOMIRAGE", "115" => "AUVERLAND", "7956" => "AVANTI", "5266" => "AVIONS VOISIN", "2180" => "BAJAJ", "9129" => "BAOYA", "120" => "BARKAS", "1200" => "BEDFORD", "125" => "BELLIER", "130" => "BENTLEY", "140" => "BERTONE", "7745" => "BIRDIE", "160" => "BMA", "150" => "BMW", "5777" => "BORGWARD", "162" => "BRILLIANCE (BMW)", "7943" => "BRILLIANCE (JINBEI)", "7944" => "BRILLIANCE (ZHONGHUA)", "165" => "BUGATTI", "170" => "BUICK", "7970" => "BYD", "180" => "CADILLAC", "183" => "CASALINI", "184" => "CATERHAM", "185" => "CHATENET", "7751" => "CHECKER", "187" => "CHERY", "190" => "CHEVROLET", "200" => "CHRYSLER", "210" => "CITROEN", "7763" => "CMC", "220" => "COBRA", "230" => "DACIA", "240" => "DAEWOO", "1310" => "DAF", "250" => "DAIHATSU", "260" => "DAIMLER", "265" => "DATSUN", "270" => "DE LOREAN", "7910" => "DELTA", "7918" => "DESOTO", "290" => "DETOMASO", "285" => "DKW", "300" => "DODGE", "9593" => "DONKERVOORT", "7992" => "DR", "9360" => "DS", "7896" => "DUCATI ENERGIA", "7764" => "DUE", "5267" => "DUESENBERG", "310" => "EAGLE", "7888" => "ELECTROAUTO", "315" => "ERAD", "7996" => "ESSEX", "6000" => "EXCALIBUR", "7756" => "FARGO", "320" => "FERRARI", "330" => "FIAT", "7912" => "FISKER", "340" => "FORD", "8011" => "FOTON", "345" => "FSM", "1420" => "FSO", "8023" => "GAC GONOW", "350" => "GAZ", "5271" => "GEM CAR", "360" => "GEO", "8021" => "GLAS", "370" => "GMC", "5627" => "GOGGOMOBIL", "7874" => "GRAF-CARELLO", "8024" => "GRAHAM", "7894" => "GREAT WALL", "372" => "GRECAV", "9223" => "GÁSPÁR AUTOMOBIL", "375" => "HILLMAN", "380" => "HOLDEN", "390" => "HONDA", "5276" => "HUDSON", "395" => "HUMBER", "400" => "HUMMER", "410" => "HYUNDAI", "1510" => "IFA", "3500" => "IKARUS", "420" => "INFINITI", "430" => "INNOCENTI", "9563" => "INTERMOTOR", "5648" => "INTERNATIONAL", "435" => "ISIGO", "440" => "ISUZU", "9142" => "ITALCAR", "1530" => "IVECO", "450" => "JAGUAR", "455" => "JDM", "460" => "JEEP", "465" => "JENSEN", "9548" => "JIANGLING", "7878" => "KEWET", "470" => "KIA", "9372" => "KOENIGSEGG", "480" => "LADA", "9143" => "LAM", "490" => "LAMBORGHINI", "500" => "LANCIA", "510" => "LAND ROVER", "1700" => "LDV", "515" => "LEA-FRANCIS", "520" => "LEXUS", "525" => "LIGIER", "530" => "LINCOLN", "5277" => "LLOYD", "9184" => "LONDON", "540" => "LOTUS", "7736" => "LTI (CARBODIES)", "5610" => "LUAZ", "560" => "MAHINDRA", "570" => "MARCOS", "580" => "MARUTI", "590" => "MASERATI", "5268" => "MATRA", "605" => "MAYBACH", "600" => "MAZDA", "7762" => "MCLAREN", "1772" => "MEGA", "9259" => "MERCEDES-AMG", "610" => "MERCEDES-BENZ", "9324" => "MERCEDES-MAYBACH", "620" => "MERCURY", "9176" => "MEV", "630" => "MG", "9541" => "MIA ELECTRIC", "635" => "MICROCAR", "9199" => "MINAUTO", "640" => "MINI", "7921" => "MINI-EL", "650" => "MITSUBISHI", "660" => "MORGAN", "5273" => "MORRIS", "670" => "MOSZKVICS", "8065" => "NASH", "680" => "NISSAN", "690" => "NSU", "6975" => "NYSA", "700" => "OKA", "710" => "OLDSMOBILE", "720" => "OLTCIT", "730" => "OPEL", "6534" => "OTOSAN", "740" => "PACKARD", "5623" => "PAGANI", "9171" => "PANHARD", "745" => "PANTHER", "750" => "PEUGEOT", "755" => "PGO", "2850" => "PIAGGIO", "760" => "PLYMOUTH", "765" => "POLONEZ", "780" => "POLSKI FIAT", "770" => "PONTIAC", "790" => "PORSCHE", "5638" => "PRAGA", "8076" => "PREMIER", "800" => "PROTON", "5639" => "PUCH", "805" => "PULI", "816" => "RAMBLER", "814" => "RAYTON FISSORE", "7897" => "RELIANT", "820" => "RENAULT", "7942" => "REO", "9172" => "REPLIKA", "825" => "REVA", "5650" => "RILEY", "830" => "ROLLS-ROYCE", "840" => "ROVER", "850" => "SAAB", "855" => "SALEEN", "857" => "SANTANA", "860" => "SATURN", "870" => "SEAT", "875" => "SHUANGHUAN", "890" => "SIMCA", "880" => "SKODA", "900" => "SMART", "9434" => "SPARTAN", "905" => "SPYKER", "910" => "SSANGYONG", "912" => "STEYR PUCH", "914" => "STUDEBAKER", "920" => "SUBARU", "930" => "SUNBEAM", "940" => "SUZUKI", "950" => "TALBOT", "5620" => "TASSO", "960" => "TATA", "962" => "TATRA", "970" => "TAVRIA", "8101" => "TAZZARI", "7737" => "TESLA", "8102" => "THINK", "980" => "TOYOTA", "990" => "TRABANT", "1000" => "TRIUMPH", "5624" => "TVR", "1010" => "UAZ", "1015" => "UMM", "1020" => "VAUXHALL", "2972" => "VELOREX", "1025" => "VENTURI", "5272" => "VERSENYAUTÓ", "7729" => "VESPA", "1030" => "VOLGA", "1040" => "VOLKSWAGEN", "1050" => "VOLVO", "9413" => "W MOTORS", "182" => "WAAIJENBERG", "9591" => "WANDERER", "1070" => "WARSZAWA", "1060" => "WARTBURG", "1075" => "WIESMANN", "5606" => "WOLSELEY", "1077" => "YES", "1080" => "YUGO", "1090" => "ZAPOROZSEC", "1100" => "ZASTAVA", "1110" => "ZAZ", "1120" => "ZIL", "1130" => "ZISZ", "Kishaszonjármű gyártmányok", "9374" => "A3", "30" => "AIXAM", "40" => "ALEKO", "50" => "ALFA ROMEO", "2157" => "ARCTIC CAT", "7767" => "ARGO", "65" => "ARO", "5693" => "ASQUITH", "1161" => "ATLAS", "80" => "AUDI", "115" => "AUVERLAND", "1170" => "AVIA", "120" => "BARKAS", "1200" => "BEDFORD", "7745" => "BIRDIE", "1206" => "BMC", "150" => "BMW", "2235" => "BOMBARDIER", "5777" => "BORGWARD", "180" => "CADILLAC", "190" => "CHEVROLET", "200" => "CHRYSLER", "210" => "CITROEN", "230" => "DACIA", "240" => "DAEWOO", "1310" => "DAF", "250" => "DAIHATSU", "280" => "DISALCAR", "300" => "DODGE", "7925" => "DONGFENG (XIAOKANG)", "5948" => "DUTRO", "1360" => "EBRO", "7888" => "ELECTROAUTO", "330" => "FIAT", "1390" => "FIAT-IVECO", "340" => "FORD", "7926" => "FORTA", "7759" => "FRAMO", "1410" => "FREIGHTLINER", "1420" => "FSO", "350" => "GAZ", "370" => "GMC", "7894" => "GREAT WALL", "9269" => "GRILLO", "1490" => "HINO", "390" => "HONDA", "400" => "HUMMER", "410" => "HYUNDAI", "3500" => "IKARUS", "440" => "ISUZU", "1530" => "IVECO", "1540" => "IVECO-MAGIRUS", "2490" => "IZS", "460" => "JEEP", "9608" => "JIANGXI", "2510" => "KAWASAKI", "470" => "KIA", "2540" => "KTM", "1670" => "KUBOTA", "2530" => "KYMCO", "480" => "LADA", "510" => "LAND ROVER", "1690" => "LATVIA", "1700" => "LDV", "525" => "LIGIER", "1300" => "LUBLIN", "560" => "MAHINDRA", "1760" => "MAN", "600" => "MAZDA", "1772" => "MEGA", "9436" => "MELEX", "610" => "MERCEDES-BENZ", "9604" => "MICRO-VETT", "640" => "MINI", "650" => "MITSUBISHI", "670" => "MOSZKVICS", "1820" => "MULTICAR", "680" => "NISSAN", "6975" => "NYSA", "720" => "OLTCIT", "730" => "OPEL", "6534" => "OTOSAN", "1865" => "OVERLANDER", "750" => "PEUGEOT", "2850" => "PIAGGIO", "2855" => "POLARIS", "820" => "RENAULT", "6680" => "SAMSUNG", "870" => "SEAT", "880" => "SKODA", "910" => "SSANGYONG", "1994" => "STEYR", "920" => "SUBARU", "940" => "SUZUKI", "6813" => "TAM", "960" => "TATA", "980" => "TOYOTA", "2035" => "TRAILOR", "1010" => "UAZ", "1020" => "VAUXHALL", "1040" => "VOLKSWAGEN", "1050" => "VOLVO", "1060" => "WARTBURG", "2990" => "YAMAHA", "2090" => "ZASTAVA-IVECO", "2135" => "ZSUK"
			],
			"kivitel" => [
				"30" => "Buggy", "40" => "Cabrio", "50" => "Coupe", "130" => "Egyéb", "60" => "Egyterű", "120" => "Ferdehátú", "65" => "Hot rod", "80" => "Kisbusz", "70" => "Kombi", "20" => "Lépcsőshátú", "85" => "Mopedautó", "90" => "Pickup", "10" => "Sedan", "100" => "Sport", "110" => "Terepjáró", "115" => "Városi terepjáró (crossover)"
			],
			"allapot" => [
				"16" => "Fődarab hibás", "18" => "Elektronika hibás", "19" => "Fékhibás", "20" => "Futómű hibás", "15" => "Motorhibás", "17" => "Váltóhibás", "14" => "Hiányos", "1" => "Normál", "2" => "Kitűnő", "3" => "Megkímélt", "5" => "Sérülésmentes", "4" => "Újszerű", "6" => "Sérült", "10" => "Baloldala sérült", "8" => "Eleje sérült", "7" => "Enyhén sérült", "9" => "Hátulja sérült", "11" => "Jobboldala sérült"
			],
			"okmany_jelleg" => [
				"2" => "külföldi okmányokkal", "1" => "magyar okmányokkal", "3" => "okmányok nélkül"
			],
			"okmany_ervenyes" => [
				"1" => "érvényes okmányokkal", "3" => "forgalomból ideiglenesen kivont", "2" => "lejárt okmányokkal", "4" => "okmányok nélkül"
			],
			"motor" => [
				"3" => "Benzin/Gáz", "9" => "CNG/benzin", "8" => "LPG/benzin", "1" => "Benzin", "10" => "Biodízel", "4" => "Dízel/Gáz", "15" => "CNG/dízel", "14" => "LPG/dízel", "2" => "Dízel", "6" => "Elektromos", "7" => "Etanol", "13" => "Gáz", "5" => "Hibrid", "11" => "Benzin/elektromos", "12" => "Dízel/elektromos", "16" => "Hidrogén/elektromos", "17" => "Kerozin"
			],
			"hengerelrendezes" => [
				"3" => "Boxer", "1" => "Soros", "4" => "Soros Álló", "5" => "Soros Fekvő", "2" => "V", "6" => "W", "7" => "Wankel"
			],
			"hajtas" => [
				"1" => "Első kerék", "2" => "Hátsó kerék", "3" => "Összkerék", "5" => "Állandó összkerék", "4" => "Kapcsolható összkerék"
			],
			"kornyezetvedelmiosztaly" => [
				"3" => "Dízel-motoros (EURO1)", "4" => "Dízel-motoros (EURO2)", "7" => "Dízel-motoros (EURO3)", "0" => "Katalizátor nélküli, Otto-motoros", "1" => "Katalizátoros, nem szabályozott keverékképzésű, Otto-motoros", "6" => "Katalizátoros, szabályozott keverékképzésű, OBD-rendszerrel ellátott Otto-motoros", "9" => "Katalizátoros, szabályozott keverékképzésű, OBD-rendszerrel ellátott Otto-motoros (EURO4)", "2" => "Katalizátoros, szabályozott keverékképzésű, Otto-motoros", "14" => "Meghatározott határértékek alapján jóváhagyott légszennyezésű gépkocsi (EURO5) (715/2007/EK I/1)", "15" => "Meghatározott határértékek alapján jóváhagyott légszennyezésű gépkocsi (EURO6) (715/2007/EK I/2)", "13" => "OBD-rendszerrel ellátott Dízel-motoros (EEV)", "8" => "OBD-rendszerrel ellátott Dízel-motoros (EURO3)", "11" => "OBD-rendszerrel ellátott Dízel-motoros (EURO4) (ENSZ-EGB 49.03 előírás)", "10" => "OBD-rendszerrel ellátott Dízel-motoros (EURO4) (ENSZ-EGB 83.05 előírás)", "12" => "OBD-rendszerrel ellátott Dízel-motoros (EURO5)", "5" => "Tiszta gázüzemű, vagy elektromos meghajtású, illetőleg hibrid"
			],
			"szin" => [
				"90" => "barna", "92" => "sötétbarna", "91" => "világosbarna", "140" => "bézs", "81" => "bíborvörös", "200" => "bordó", "40" => "ezüst", "10" => "fehér", "11" => "törtfehér", "190" => "fekete", "150" => "homok", "160" => "ibolya", "20" => "kék", "24" => "ibolyakék", "23" => "óceánkék", "22" => "sötétkék", "21" => "világoskék", "80" => "lila", "110" => "narancs", "170" => "okker", "50" => "pezsgő", "30" => "piros", "100" => "rózsaszín", "70" => "sárga", "73" => "aranysárga", "72" => "citromsárga", "71" => "narancssárga", "130" => "szürke", "132" => "sötétszürke", "131" => "világosszürke", "120" => "terep", "210" => "türkiz", "180" => "vajszínű", "60" => "zöld", "63" => "olajzöld", "62" => "sötétzöld", "61" => "világoszöld"
			],
			"karpitszin1" => [
				"90" => "barna", "92" => "sötétbarna", "91" => "világosbarna", "140" => "bézs", "81" => "bíborvörös", "200" => "bordó", "40" => "ezüst", "10" => "fehér", "11" => "törtfehér", "190" => "fekete", "150" => "homok", "160" => "ibolya", "20" => "kék", "24" => "ibolyakék", "23" => "óceánkék", "22" => "sötétkék", "21" => "világoskék", "80" => "lila", "110" => "narancs", "170" => "okker", "50" => "pezsgő", "30" => "piros", "100" => "rózsaszín", "70" => "sárga", "73" => "aranysárga", "72" => "citromsárga", "71" => "narancssárga", "130" => "szürke", "132" => "sötétszürke", "131" => "világosszürke", "120" => "terep", "210" => "türkiz", "180" => "vajszínű", "60" => "zöld", "63" => "olajzöld", "62" => "sötétzöld", "61" => "világoszöld"
			],
			"karpitszin2" => [
				"90" => "barna", "92" => "sötétbarna", "91" => "világosbarna", "140" => "bézs", "81" => "bíborvörös", "200" => "bordó", "40" => "ezüst", "10" => "fehér", "11" => "törtfehér", "190" => "fekete", "150" => "homok", "160" => "ibolya", "20" => "kék", "24" => "ibolyakék", "23" => "óceánkék", "22" => "sötétkék", "21" => "világoskék", "80" => "lila", "110" => "narancs", "170" => "okker", "50" => "pezsgő", "30" => "piros", "100" => "rózsaszín", "70" => "sárga", "73" => "aranysárga", "72" => "citromsárga", "71" => "narancssárga", "130" => "szürke", "132" => "sötétszürke", "131" => "világosszürke", "120" => "terep", "210" => "türkiz", "180" => "vajszínű", "60" => "zöld", "63" => "olajzöld", "62" => "sötétzöld", "61" => "világoszöld"
			],
			"sebessegvalto" => [
				"A0" => "automata sebességváltó", "A3" => "automata (3 fokozatú) sebességváltó", "A4" => "automata (4 fokozatú) sebességváltó", "A5" => "automata (5 fokozatú) sebességváltó", "A6" => "automata (6 fokozatú) sebességváltó", "A7" => "automata (7 fokozatú) sebességváltó", "A8" => "automata (8 fokozatú) sebességváltó", "A9" => "automata (9 fokozatú) sebességváltó", "A10" => "automata (10 fokozatú) sebességváltó", "F0" => "félautomata sebességváltó", "V0" => "fokozatmentes automata sebességváltó", "M0" => "manuális sebességváltó", "M3" => "manuális (3 fokozatú) sebességváltó", "M4" => "manuális (4 fokozatú) sebességváltó", "M5" => "manuális (5 fokozatú) sebességváltó", "M6" => "manuális (6 fokozatú) sebességváltó", "M7" => "manuális (7 fokozatú) sebességváltó", "S0" => "szekvenciális sebességváltó", "S4" => "szekvenciális (4 fokozatú) sebességváltó", "S5" => "szekvenciális (5 fokozatú) sebességváltó", "S6" => "szekvenciális (6 fokozatú) sebességváltó", "S7" => "szekvenciális (7 fokozatú) sebességváltó", "S8" => "szekvenciális (8 fokozatú) sebességváltó", "T0" => "tiptronic sebességváltó", "T4" => "automata (4 fokozatú tiptronic) sebességváltó", "T5" => "automata (5 fokozatú tiptronic) sebességváltó", "T6" => "automata (6 fokozatú tiptronic) sebességváltó", "T7" => "automata (7 fokozatú tiptronic) sebességváltó", "T8" => "automata (8 fokozatú tiptronic) sebességváltó", "T9" => "automata (9 fokozatú tiptronic) sebességváltó"
			],
			"teto" => [
				"10" => "elhúzható napfénytető", "8" => "fix napfénytető", "5" => "fix üvegtető", "4" => "harmonikatető", "7" => "lemeztető", "11" => "motoros napfénytető", "3" => "nyitható keménytető", "9" => "nyitható napfénytető", "6" => "panoráma tető", "1" => "targatető", "2" => "vászontető"
			],
			"gar_lejarat" => [
				"2" => "Egy év", "1" => "Fél év", "4" => "Három év", "3" => "Két év"
			],
			"klima" => [
				"2" => "automata klíma", "4" => "digitális kétzónás klíma", "3" => "digitális klíma", "5" => "digitális többzónás klíma", "1" => "manuális klíma", "0" => "nincs"
			],
			"extra_muszaki" => [
				"1" => "állítható kormány", "8" => "centrálzár", "16" => "elektromos ablak elöl", "32" => "elektromos ablak hátul", "64" => "elektromos tükör", "128" => "fedélzeti komputer", "256" => "fűthető tükör", "1024" => "könnyűfém felni", "16384" => "riasztó", "32768" => "szervokormány", "65536" => "színezett üveg", "131072" => "tempomat", "262144" => "vonóhorog", "1048576" => "tolóajtó", "8388608" => "részecskeszűrő", "16777216" => "kulcsnélküli indítás", "33554432" => "kormányváltó", "67108864" => "chiptuning", "134217728" => "állítható felfüggesztés", "268435456" => "defektjavító készlet", "536870912" => "króm felni", "1073741824" => "tolótető (napfénytető)", "2147483648" => "elektromos tolótető", "4294967296" => "EDC (elektronikus lengéscsillapítás vezérlés)", "8589934592" => "sebességfüggő szervókormány", "17179869184" => "sportfutómű", "34359738368" => "kerámia féktárcsák", "68719476736" => "sportülések", "137438953472" => "távolságtartó tempomat", "274877906944" => "sperr differenciálmű"
			],
			"extra_kenyelmi" => [
				"1" => "állítható hátsó ülések", "2" => "bőr belső", "16" => "dönthető utasülések", "128" => "faberakás", "256" => "full extra", "512" => "fűthető ülés", "4096" => "memóriás vezetőülés", "16384" => "plüss kárpit", "65536" => "tolatóradar", "131072" => "ülésmagasság állítás", "4194304" => "állófűtés", "16777216" => "fűthető kormány", "33554432" => "középső kartámasz", "67108864" => "ajtószervó", "134217728" => "pótkerék", "268435456" => "tolatókamera", "536870912" => "üléshűtés/szellőztetés", "1073741824" => "távolsági fényszóró asszisztens", "4294967296" => "álló helyzeti klíma", "8589934592" => "automatikusan sötétedő belső tükör", "17179869184" => "automatikusan sötétedő külső tükör", "34359738368" => "automatikus csomagtér-ajtó", "68719476736" => "masszírozós ülés", "137438953472" => "hűthető kartámasz", "274877906944" => "hűthető kesztyűtartó", "549755813888" => "fűthető szélvédő", "1099511627776" => "elektromosan behajtható külső tükrök", "2199023255552" => "multifunkciós kormánykerék", "4398046511104" => "garázsajtó távirányító", "8796093022208" => "elektronikus futómű hangolás", "17592186044416" => "elektromosan állítható fejtámlák", "35184372088832" => "velúr kárpit", "70368744177664" => "műbőr-kárpit", "140737488355328" => "fűthető ablakmosó fúvókák", "281474976710656" => "állítható combtámasz", "562949953421312" => "deréktámasz", "1125899906842620" => "elektromos ülésállítás vezetőoldal", "2251799813685240" => "elektromos ülésállítás utasoldal", "4503599627370490" => "bőr-szövet huzat"
			],
			"extra_biztonsagi" => [
				"1" => "ABS (blokkolásgátló)", "2" => "ASR (kipörgésgátló)", "4" => "bukócső", "8" => "csomag rögzítő", "16" => "függönylégzsák", "32" => "hátsó oldal légzsák", "64" => "ISOFIX rendszer", "128" => "ködlámpa", "256" => "kikapcsolható légzsák", "512" => "oldallégzsák", "1024" => "utasoldali légzsák", "2048" => "vezetőoldali légzsák", "4096" => "xenon fényszóró", "8192" => "ESP (menetstabilizátor)", "524288" => "kanyarkövető fényszóró", "2097152" => "sebességváltó zár", "16777216" => "ADS (adaptív lengéscsillapító)", "33554432" => "EBD/EBV (elektronikus fékerő-elosztó)", "67108864" => "EDS (elektronikus differenciálzár)", "134217728" => "bi-xenon fényszóró", "268435456" => "esőszenzor", "536870912" => "APS (parkolóradar)", "1073741824" => "térdlégzsák", "2147483648" => "sávtartó rendszer", "4294967296" => "ARD (automatikus távolságtartó)", "8589934592" => "tábla-felismerő funkció", "17179869184" => "éjjellátó asszisztens", "34359738368" => "defekttűrő abroncsok", "68719476736" => "holttér-figyelő rendszer", "137438953472" => "guminyomás-ellenőrző rendszer", "274877906944" => "bukólámpa", "549755813888" => "LED fényszóró", "1099511627776" => "hátsó fejtámlák", "2199023255552" => "rablásgátló", "4398046511104" => "indításgátló (immobiliser)", "8796093022208" => "kiegészítő fényszóró", "17592186044416" => "fényszóró magasságállítás", "35184372088832" => "fényszórómosó", "70368744177664" => "sávváltó asszisztens", "140737488355328" => "visszagurulás-gátló", "281474976710656" => "lejtmenet asszisztens", "562949953421312" => "beépített gyerekülés", "1125899906842620" => "fékasszisztens", "2251799813685240" => "MSR (motorféknyomaték szabályzás)", "4503599627370490" => "GPS nyomkövető", "9007199254740990" => "gyalogos légzsák"
			],
			"extra_egyeb" => [
				"1" => "autóbeszámítás lehetséges", "2" => "első tulajdonostól", "4" => "garázsban tartott", "8" => "hölgy tulajdonostól", "16" => "keveset futott", "32" => "második tulajdonostól", "64" => "nem dohányzó", "128" => "rendszeresen karbantartott", "256" => "szervizkönyv", "512" => "taxi", "1024" => "törzskönyv", "2048" => "garanciális", "8192" => "rendelhető", "16384" => "azonnal elvihető", "32768" => "amerikai modell", "65536" => "jobbkormányos", "131072" => "bemutató jármű", "16777216" => "mozgássérült", "33554432" => "frissen szervizelt", "67108864" => "Magyarországon újonnan üzembe helyezett", "134217728" => "motorbeszámítás lehetséges", "268435456" => "tekert kilométeróra"
			],
			"extra_audio" => [
				"1" => "rádió", "2" => "rádiós magnó", "4" => "CD-s autórádió", "8" => "CD tár", "16" => "DVD", "32" => "memóriakártya-olvasó", "64" => "merevlemez", "128" => "FM transzmitter", "256" => "GPS (navigáció)", "512" => "kihangosító", "1024" => "bluetooth-os kihangosító", "2048" => "iPhone/iPod csatlakozó", "4096" => "USB csatlakozó", "8192" => "AUX csatlakozó", "16384" => "erősítő kimenet", "32768" => "HDMI bemenet", "65536" => "tolatókamera bemenet", "131072" => "mikrofon bemenet", "262144" => "DVB tuner", "524288" => "DVB-T tuner", "1048576" => "analóg TV tuner", "2097152" => "MP3 lejátszás", "4194304" => "MP4 lejátszás", "8388608" => "WMA lejátszás", "16777216" => "távirányító", "33554432" => "kormányra szerelhető távirányító", "67108864" => "érintőkijelző", "536870912" => "erősítő", "1073741824" => "gyári erősítő", "2147483648" => "fejtámlamonitor", "4294967296" => "tetőmonitor", "8589934592" => "1 DIN", "17179869184" => "2 DIN", "34359738368" => "2 hangszóró", "68719476736" => "4 hangszóró", "137438953472" => "5 hangszóró", "274877906944" => "6 hangszóró", "549755813888" => "7 hangszóró", "1099511627776" => "8 hangszóró", "2199023255552" => "9 hangszóró", "4398046511104" => "10 hangszóró", "8796093022208" => "11 hangszóró", "17592186044416" => "12 hangszóró", "35184372088832" => "mélynyomó", "70368744177664" => "autótelefon", "140737488355328" => "TV", "281474976710656" => "HIFI"
			],
			"eklima" => [
				"2" => "automata klíma", "4" => "digitális kétzónás klíma", "3" => "digitális klíma", "5" => "digitális többzónás klíma", "1" => "manuális klíma", "0" => "nincs"
			],
			"eextra_muszaki" => [
				"1" => "állítható kormány", "8" => "centrálzár", "16" => "elektromos ablak elöl", "32" => "elektromos ablak hátul", "64" => "elektromos tükör", "128" => "fedélzeti komputer", "256" => "fűthető tükör", "1024" => "könnyűfém felni", "16384" => "riasztó", "32768" => "szervokormány", "65536" => "színezett üveg", "131072" => "tempomat", "262144" => "vonóhorog", "1048576" => "tolóajtó", "8388608" => "részecskeszűrő", "16777216" => "kulcsnélküli indítás", "33554432" => "kormányváltó", "67108864" => "chiptuning", "134217728" => "állítható felfüggesztés", "268435456" => "defektjavító készlet", "536870912" => "króm felni", "1073741824" => "tolótető (napfénytető)", "2147483648" => "elektromos tolótető", "4294967296" => "EDC (elektronikus lengéscsillapítás vezérlés)", "8589934592" => "sebességfüggő szervókormány", "17179869184" => "sportfutómű", "34359738368" => "kerámia féktárcsák", "68719476736" => "sportülések", "137438953472" => "távolságtartó tempomat", "274877906944" => "sperr differenciálmű"
			],
			"eextra_kenyelmi" => [
				"1" => "állítható hátsó ülések", "2" => "bőr belső", "16" => "dönthető utasülések", "128" => "faberakás", "256" => "full extra", "512" => "fűthető ülés", "4096" => "memóriás vezetőülés", "16384" => "plüss kárpit", "65536" => "tolatóradar", "131072" => "ülésmagasság állítás", "4194304" => "állófűtés", "16777216" => "fűthető kormány", "33554432" => "középső kartámasz", "67108864" => "ajtószervó", "134217728" => "pótkerék", "268435456" => "tolatókamera", "536870912" => "üléshűtés/szellőztetés", "1073741824" => "távolsági fényszóró asszisztens", "4294967296" => "álló helyzeti klíma", "8589934592" => "automatikusan sötétedő belső tükör", "17179869184" => "automatikusan sötétedő külső tükör", "34359738368" => "automatikus csomagtér-ajtó", "68719476736" => "masszírozós ülés", "137438953472" => "hűthető kartámasz", "274877906944" => "hűthető kesztyűtartó", "549755813888" => "fűthető szélvédő", "1099511627776" => "elektromosan behajtható külső tükrök", "2199023255552" => "multifunkciós kormánykerék", "4398046511104" => "garázsajtó távirányító", "8796093022208" => "elektronikus futómű hangolás", "17592186044416" => "elektromosan állítható fejtámlák", "35184372088832" => "velúr kárpit", "70368744177664" => "műbőr-kárpit", "140737488355328" => "fűthető ablakmosó fúvókák", "281474976710656" => "állítható combtámasz", "562949953421312" => "deréktámasz", "1125899906842620" => "elektromos ülésállítás vezetőoldal", "2251799813685240" => "elektromos ülésállítás utasoldal", "4503599627370490" => "bőr-szövet huzat"
			],
			"eextra_biztonsagi" => [
				"1" => "ABS (blokkolásgátló)", "2" => "ASR (kipörgésgátló)", "4" => "bukócső", "8" => "csomag rögzítő", "16" => "függönylégzsák", "32" => "hátsó oldal légzsák", "64" => "ISOFIX rendszer", "128" => "ködlámpa", "256" => "kikapcsolható légzsák", "512" => "oldallégzsák", "1024" => "utasoldali légzsák", "2048" => "vezetőoldali légzsák", "4096" => "xenon fényszóró", "8192" => "ESP (menetstabilizátor)", "524288" => "kanyarkövető fényszóró", "2097152" => "sebességváltó zár", "16777216" => "ADS (adaptív lengéscsillapító)", "33554432" => "EBD/EBV (elektronikus fékerő-elosztó)", "67108864" => "EDS (elektronikus differenciálzár)", "134217728" => "bi-xenon fényszóró", "268435456" => "esőszenzor", "536870912" => "APS (parkolóradar)", "1073741824" => "térdlégzsák", "2147483648" => "sávtartó rendszer", "4294967296" => "ARD (automatikus távolságtartó)", "8589934592" => "tábla-felismerő funkció", "17179869184" => "éjjellátó asszisztens", "34359738368" => "defekttűrő abroncsok", "68719476736" => "holttér-figyelő rendszer", "137438953472" => "guminyomás-ellenőrző rendszer", "274877906944" => "bukólámpa", "549755813888" => "LED fényszóró", "1099511627776" => "hátsó fejtámlák", "2199023255552" => "rablásgátló", "4398046511104" => "indításgátló (immobiliser)", "8796093022208" => "kiegészítő fényszóró", "17592186044416" => "fényszóró magasságállítás", "35184372088832" => "fényszórómosó", "70368744177664" => "sávváltó asszisztens", "140737488355328" => "visszagurulás-gátló", "281474976710656" => "lejtmenet asszisztens", "562949953421312" => "beépített gyerekülés", "1125899906842620" => "fékasszisztens", "2251799813685240" => "MSR (motorféknyomaték szabályzás)", "4503599627370490" => "GPS nyomkövető", "9007199254740990" => "gyalogos légzsák"
			],
			"eextra_egyeb" => [
				"1" => "autóbeszámítás lehetséges", "2" => "első tulajdonostól", "4" => "garázsban tartott", "8" => "hölgy tulajdonostól", "16" => "keveset futott", "32" => "második tulajdonostól", "64" => "nem dohányzó", "128" => "rendszeresen karbantartott", "256" => "szervizkönyv", "512" => "taxi", "1024" => "törzskönyv", "2048" => "garanciális", "8192" => "rendelhető", "16384" => "azonnal elvihető", "32768" => "amerikai modell", "65536" => "jobbkormányos", "131072" => "bemutató jármű", "16777216" => "mozgássérült", "33554432" => "frissen szervizelt", "67108864" => "Magyarországon újonnan üzembe helyezett", "134217728" => "motorbeszámítás lehetséges", "268435456" => "tekert kilométeróra"
			],
			"eextra_audio" => [
				"1" => "rádió", "2" => "rádiós magnó", "4" => "CD-s autórádió", "8" => "CD tár", "16" => "DVD", "32" => "memóriakártya-olvasó", "64" => "merevlemez", "128" => "FM transzmitter", "256" => "GPS (navigáció)", "512" => "kihangosító", "1024" => "bluetooth-os kihangosító", "2048" => "iPhone/iPod csatlakozó", "4096" => "USB csatlakozó", "8192" => "AUX csatlakozó", "16384" => "erősítő kimenet", "32768" => "HDMI bemenet", "65536" => "tolatókamera bemenet", "131072" => "mikrofon bemenet", "262144" => "DVB tuner", "524288" => "DVB-T tuner", "1048576" => "analóg TV tuner", "2097152" => "MP3 lejátszás", "4194304" => "MP4 lejátszás", "8388608" => "WMA lejátszás", "16777216" => "távirányító", "33554432" => "kormányra szerelhető távirányító", "67108864" => "érintőkijelző", "536870912" => "erősítő", "1073741824" => "gyári erősítő", "2147483648" => "fejtámlamonitor", "4294967296" => "tetőmonitor", "8589934592" => "1 DIN", "17179869184" => "2 DIN", "34359738368" => "2 hangszóró", "68719476736" => "4 hangszóró", "137438953472" => "5 hangszóró", "274877906944" => "6 hangszóró", "549755813888" => "7 hangszóró", "1099511627776" => "8 hangszóró", "2199023255552" => "9 hangszóró", "4398046511104" => "10 hangszóró", "8796093022208" => "11 hangszóró", "17592186044416" => "12 hangszóró", "35184372088832" => "mélynyomó", "70368744177664" => "autótelefon", "140737488355328" => "TV", "281474976710656" => "HIFI"
			],
			"futasido" => [
				"3" => "előrendelt", "2" => "tesztjármű", "1" => "újjármű"
			],
		];
		
		if(!empty($key) AND !empty($val)) { return $return[$key][$val]; }
		elseif(!empty($key)) { return $return[$key]; }
		else { return $return; }
	}
}
?>