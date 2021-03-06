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
					"vetelar" => "V??tel??r",
					"regado" => "Plusz regisztr??ci??s ad??",
					"vam" => "Plusz v??m",
					"akciosar" => "Akci??s ??r",
					"vetelar_teljes" => "Teljes v??tel??r magyarorsz??gi forgalomba helyez??s eset??n",
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
			"veteran" => ["name" => "Veter??n?", "after" => ""],
			"allapot" => ["name" => "??llapot", "after" => ""],
			"okmany_jelleg" => ["name" => "Okm??nyok jellege", "after" => ""],
			"okmany_ervenyes" => ["name" => "Okm??nyok ??rv??nyess??ge", "after" => ""],
			"eurotaxkod" => ["name" => "Eurotax k??d", "after" => ""],
			"tipusjel_eurotax" => ["name" => "Eurotax k??d - T??pusjel", "after" => ""],

			"jelleg" => ["name" => "Jelleg", "after" => ""],
			"motor" => ["name" => "??zemanyag", "after" => ""],
			"hengerelrendezes" => ["name" => "Hengerelrendez??s", "after" => ""],
			"hajtas" => ["name" => "Hajt??s", "after" => ""],
			"kornyezetvedelmiosztaly" => ["name" => "K??rnyezetv??delmi oszt??ly", "after" => ""],
			
			"onsuly" => ["name" => "??ns??ly", "after" => "kg"],
			"osszsuly" => ["name" => "??sszs??ly", "after" => "kg"],
			"szemszama" => ["name" => "Sz??ll??that?? szem??lyek sz??ma", "after" => "f??"],
			"ajtok" => ["name" => "Ajt??k sz??ma", "after" => "db"],
			"szin" => ["name" => "Sz??n", "after" => ""],
			"metal" => ["name" => "Met??l?", "after" => ""],
			"karpitszin1" => ["name" => "K??rpit sz??nei", "after" => ""],
			"karpitszin2" => ["name" => "K??rpit sz??nei", "after" => ""],
			"sebessegvalto" => ["name" => "Sebess??gv??lt?? fajt??ja", "after" => ""],
			"felezo_valto" => ["name" => "Felez?? sebess??gv??lt???", "after" => ""],
			"muszaki" => ["name" => "M??szaki vizsga ??rv??nyess??gi d??tuma", "after" => ""],
			"csomagtarto" => ["name" => "Csomagtart??", "after" => "liter"],
			"teto" => ["name" => "Tet??", "after" => ""],
			"abroncsmeret" => ["name" => "Abroncsm??ret", "after" => ""],
			"futasido" => ["name" => "Fut??sid??", "after" => ""],
			
			"garancialis" => ["name" => "Garanci??lis", "after" => ""],
			"gar_tipus" => ["name" => "Garancia t??pusa", "after" => ""],
			"gar_lejarat" => ["name" => "Garancia lej??rata", "after" => ""],
			"gar_lejarat_datum" => ["name" => "Garancia lej??rata", "after" => ""],
			
			"klima" => ["name" => "Kl??ma", "after" => ""],
			// "extra_muszaki" => ["name" => "M??szaki felszerelts??g", "after" => ""],
			// "extra_kenyelmi" => ["name" => "K??nyelmi felszerelts??g", "after" => ""],
			// "extra_biztonsagi" => ["name" => "Biztons??gi felszerelts??g", "after" => ""],
			// "extra_egyeb" => ["name" => "Egy??b inform??ci??k", "after" => ""],
			// "extra_audio" => ["name" => "HiFi ??s Multim??dia", "after" => ""],
			
			"eklima" => ["name" => "Extra Kl??ma", "after" => ""],
			// "eextra_muszaki" => ["name" => "Extra M??szaki felszerelts??g", "after" => ""],
			// "eextra_kenyelmi" => ["name" => "Extra K??nyelmi felszerelts??g", "after" => ""],
			// "eextra_biztonsagi" => ["name" => "Extra Biztons??gi felszerelts??g", "after" => ""],
			// "eextra_egyeb" => ["name" => "Extra Egy??b inform??ci??k", "after" => ""],
			
			"emailcim" => ["name" => "Email c??m", "after" => ""],
			"telefon_1" => ["name" => "Telefonsz??m", "after" => ""],
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
				"5621" => "ABARTH", "7945" => "AC", "20" => "ACURA", "25" => "ADLER", "27" => "AERO", "30" => "AIXAM", "40" => "ALEKO", "50" => "ALFA ROMEO", "7738" => "ALKE", "7804" => "ALL-CARS", "7946" => "ALLARD", "60" => "ALPINA", "5622" => "ALPINE", "62" => "AMC", "7947" => "AMERICAN AUSTIN", "7948" => "AMERICAN BANTAM", "7949" => "ANADOL", "7950" => "ANCHI", "7951" => "ANFINI", "2155" => "ARIEL", "65" => "ARO", "7952" => "ARTEGA", "68" => "ASIA", "70" => "ASTON MARTIN", "7953" => "AS??NA", "7954" => "AUBURN", "80" => "AUDI", "100" => "AUSTIN", "110" => "AUSTIN MORRIS", "7955" => "AUSTIN-HEALEY", "112" => "AUTO UNION", "90" => "AUTOBIANCHI", "7749" => "AUTOMIRAGE", "115" => "AUVERLAND", "7956" => "AVANTI", "5266" => "AVIONS VOISIN", "2180" => "BAJAJ", "9129" => "BAOYA", "120" => "BARKAS", "1200" => "BEDFORD", "125" => "BELLIER", "130" => "BENTLEY", "140" => "BERTONE", "7745" => "BIRDIE", "160" => "BMA", "150" => "BMW", "5777" => "BORGWARD", "162" => "BRILLIANCE (BMW)", "7943" => "BRILLIANCE (JINBEI)", "7944" => "BRILLIANCE (ZHONGHUA)", "165" => "BUGATTI", "170" => "BUICK", "7970" => "BYD", "180" => "CADILLAC", "183" => "CASALINI", "184" => "CATERHAM", "185" => "CHATENET", "7751" => "CHECKER", "187" => "CHERY", "190" => "CHEVROLET", "200" => "CHRYSLER", "210" => "CITROEN", "7763" => "CMC", "220" => "COBRA", "230" => "DACIA", "240" => "DAEWOO", "1310" => "DAF", "250" => "DAIHATSU", "260" => "DAIMLER", "265" => "DATSUN", "270" => "DE LOREAN", "7910" => "DELTA", "7918" => "DESOTO", "290" => "DETOMASO", "285" => "DKW", "300" => "DODGE", "9593" => "DONKERVOORT", "7992" => "DR", "9360" => "DS", "7896" => "DUCATI ENERGIA", "7764" => "DUE", "5267" => "DUESENBERG", "310" => "EAGLE", "7888" => "ELECTROAUTO", "315" => "ERAD", "7996" => "ESSEX", "6000" => "EXCALIBUR", "7756" => "FARGO", "320" => "FERRARI", "330" => "FIAT", "7912" => "FISKER", "340" => "FORD", "8011" => "FOTON", "345" => "FSM", "1420" => "FSO", "8023" => "GAC GONOW", "350" => "GAZ", "5271" => "GEM CAR", "360" => "GEO", "8021" => "GLAS", "370" => "GMC", "5627" => "GOGGOMOBIL", "7874" => "GRAF-CARELLO", "8024" => "GRAHAM", "7894" => "GREAT WALL", "372" => "GRECAV", "9223" => "G??SP??R AUTOMOBIL", "375" => "HILLMAN", "380" => "HOLDEN", "390" => "HONDA", "5276" => "HUDSON", "395" => "HUMBER", "400" => "HUMMER", "410" => "HYUNDAI", "1510" => "IFA", "3500" => "IKARUS", "420" => "INFINITI", "430" => "INNOCENTI", "9563" => "INTERMOTOR", "5648" => "INTERNATIONAL", "435" => "ISIGO", "440" => "ISUZU", "9142" => "ITALCAR", "1530" => "IVECO", "450" => "JAGUAR", "455" => "JDM", "460" => "JEEP", "465" => "JENSEN", "9548" => "JIANGLING", "7878" => "KEWET", "470" => "KIA", "9372" => "KOENIGSEGG", "480" => "LADA", "9143" => "LAM", "490" => "LAMBORGHINI", "500" => "LANCIA", "510" => "LAND ROVER", "1700" => "LDV", "515" => "LEA-FRANCIS", "520" => "LEXUS", "525" => "LIGIER", "530" => "LINCOLN", "5277" => "LLOYD", "9184" => "LONDON", "540" => "LOTUS", "7736" => "LTI (CARBODIES)", "5610" => "LUAZ", "560" => "MAHINDRA", "570" => "MARCOS", "580" => "MARUTI", "590" => "MASERATI", "5268" => "MATRA", "605" => "MAYBACH", "600" => "MAZDA", "7762" => "MCLAREN", "1772" => "MEGA", "9259" => "MERCEDES-AMG", "610" => "MERCEDES-BENZ", "9324" => "MERCEDES-MAYBACH", "620" => "MERCURY", "9176" => "MEV", "630" => "MG", "9541" => "MIA ELECTRIC", "635" => "MICROCAR", "9199" => "MINAUTO", "640" => "MINI", "7921" => "MINI-EL", "650" => "MITSUBISHI", "660" => "MORGAN", "5273" => "MORRIS", "670" => "MOSZKVICS", "8065" => "NASH", "680" => "NISSAN", "690" => "NSU", "6975" => "NYSA", "700" => "OKA", "710" => "OLDSMOBILE", "720" => "OLTCIT", "730" => "OPEL", "6534" => "OTOSAN", "740" => "PACKARD", "5623" => "PAGANI", "9171" => "PANHARD", "745" => "PANTHER", "750" => "PEUGEOT", "755" => "PGO", "2850" => "PIAGGIO", "760" => "PLYMOUTH", "765" => "POLONEZ", "780" => "POLSKI FIAT", "770" => "PONTIAC", "790" => "PORSCHE", "5638" => "PRAGA", "8076" => "PREMIER", "800" => "PROTON", "5639" => "PUCH", "805" => "PULI", "816" => "RAMBLER", "814" => "RAYTON FISSORE", "7897" => "RELIANT", "820" => "RENAULT", "7942" => "REO", "9172" => "REPLIKA", "825" => "REVA", "5650" => "RILEY", "830" => "ROLLS-ROYCE", "840" => "ROVER", "850" => "SAAB", "855" => "SALEEN", "857" => "SANTANA", "860" => "SATURN", "870" => "SEAT", "875" => "SHUANGHUAN", "890" => "SIMCA", "880" => "SKODA", "900" => "SMART", "9434" => "SPARTAN", "905" => "SPYKER", "910" => "SSANGYONG", "912" => "STEYR PUCH", "914" => "STUDEBAKER", "920" => "SUBARU", "930" => "SUNBEAM", "940" => "SUZUKI", "950" => "TALBOT", "5620" => "TASSO", "960" => "TATA", "962" => "TATRA", "970" => "TAVRIA", "8101" => "TAZZARI", "7737" => "TESLA", "8102" => "THINK", "980" => "TOYOTA", "990" => "TRABANT", "1000" => "TRIUMPH", "5624" => "TVR", "1010" => "UAZ", "1015" => "UMM", "1020" => "VAUXHALL", "2972" => "VELOREX", "1025" => "VENTURI", "5272" => "VERSENYAUT??", "7729" => "VESPA", "1030" => "VOLGA", "1040" => "VOLKSWAGEN", "1050" => "VOLVO", "9413" => "W MOTORS", "182" => "WAAIJENBERG", "9591" => "WANDERER", "1070" => "WARSZAWA", "1060" => "WARTBURG", "1075" => "WIESMANN", "5606" => "WOLSELEY", "1077" => "YES", "1080" => "YUGO", "1090" => "ZAPOROZSEC", "1100" => "ZASTAVA", "1110" => "ZAZ", "1120" => "ZIL", "1130" => "ZISZ", "Kishaszonj??rm?? gy??rtm??nyok", "9374" => "A3", "30" => "AIXAM", "40" => "ALEKO", "50" => "ALFA ROMEO", "2157" => "ARCTIC CAT", "7767" => "ARGO", "65" => "ARO", "5693" => "ASQUITH", "1161" => "ATLAS", "80" => "AUDI", "115" => "AUVERLAND", "1170" => "AVIA", "120" => "BARKAS", "1200" => "BEDFORD", "7745" => "BIRDIE", "1206" => "BMC", "150" => "BMW", "2235" => "BOMBARDIER", "5777" => "BORGWARD", "180" => "CADILLAC", "190" => "CHEVROLET", "200" => "CHRYSLER", "210" => "CITROEN", "230" => "DACIA", "240" => "DAEWOO", "1310" => "DAF", "250" => "DAIHATSU", "280" => "DISALCAR", "300" => "DODGE", "7925" => "DONGFENG (XIAOKANG)", "5948" => "DUTRO", "1360" => "EBRO", "7888" => "ELECTROAUTO", "330" => "FIAT", "1390" => "FIAT-IVECO", "340" => "FORD", "7926" => "FORTA", "7759" => "FRAMO", "1410" => "FREIGHTLINER", "1420" => "FSO", "350" => "GAZ", "370" => "GMC", "7894" => "GREAT WALL", "9269" => "GRILLO", "1490" => "HINO", "390" => "HONDA", "400" => "HUMMER", "410" => "HYUNDAI", "3500" => "IKARUS", "440" => "ISUZU", "1530" => "IVECO", "1540" => "IVECO-MAGIRUS", "2490" => "IZS", "460" => "JEEP", "9608" => "JIANGXI", "2510" => "KAWASAKI", "470" => "KIA", "2540" => "KTM", "1670" => "KUBOTA", "2530" => "KYMCO", "480" => "LADA", "510" => "LAND ROVER", "1690" => "LATVIA", "1700" => "LDV", "525" => "LIGIER", "1300" => "LUBLIN", "560" => "MAHINDRA", "1760" => "MAN", "600" => "MAZDA", "1772" => "MEGA", "9436" => "MELEX", "610" => "MERCEDES-BENZ", "9604" => "MICRO-VETT", "640" => "MINI", "650" => "MITSUBISHI", "670" => "MOSZKVICS", "1820" => "MULTICAR", "680" => "NISSAN", "6975" => "NYSA", "720" => "OLTCIT", "730" => "OPEL", "6534" => "OTOSAN", "1865" => "OVERLANDER", "750" => "PEUGEOT", "2850" => "PIAGGIO", "2855" => "POLARIS", "820" => "RENAULT", "6680" => "SAMSUNG", "870" => "SEAT", "880" => "SKODA", "910" => "SSANGYONG", "1994" => "STEYR", "920" => "SUBARU", "940" => "SUZUKI", "6813" => "TAM", "960" => "TATA", "980" => "TOYOTA", "2035" => "TRAILOR", "1010" => "UAZ", "1020" => "VAUXHALL", "1040" => "VOLKSWAGEN", "1050" => "VOLVO", "1060" => "WARTBURG", "2990" => "YAMAHA", "2090" => "ZASTAVA-IVECO", "2135" => "ZSUK"
			],
			"kivitel" => [
				"30" => "Buggy", "40" => "Cabrio", "50" => "Coupe", "130" => "Egy??b", "60" => "Egyter??", "120" => "Ferdeh??t??", "65" => "Hot rod", "80" => "Kisbusz", "70" => "Kombi", "20" => "L??pcs??sh??t??", "85" => "Mopedaut??", "90" => "Pickup", "10" => "Sedan", "100" => "Sport", "110" => "Terepj??r??", "115" => "V??rosi terepj??r?? (crossover)"
			],
			"allapot" => [
				"16" => "F??darab hib??s", "18" => "Elektronika hib??s", "19" => "F??khib??s", "20" => "Fut??m?? hib??s", "15" => "Motorhib??s", "17" => "V??lt??hib??s", "14" => "Hi??nyos", "1" => "Norm??l", "2" => "Kit??n??", "3" => "Megk??m??lt", "5" => "S??r??l??smentes", "4" => "??jszer??", "6" => "S??r??lt", "10" => "Baloldala s??r??lt", "8" => "Eleje s??r??lt", "7" => "Enyh??n s??r??lt", "9" => "H??tulja s??r??lt", "11" => "Jobboldala s??r??lt"
			],
			"okmany_jelleg" => [
				"2" => "k??lf??ldi okm??nyokkal", "1" => "magyar okm??nyokkal", "3" => "okm??nyok n??lk??l"
			],
			"okmany_ervenyes" => [
				"1" => "??rv??nyes okm??nyokkal", "3" => "forgalomb??l ideiglenesen kivont", "2" => "lej??rt okm??nyokkal", "4" => "okm??nyok n??lk??l"
			],
			"motor" => [
				"3" => "Benzin/G??z", "9" => "CNG/benzin", "8" => "LPG/benzin", "1" => "Benzin", "10" => "Biod??zel", "4" => "D??zel/G??z", "15" => "CNG/d??zel", "14" => "LPG/d??zel", "2" => "D??zel", "6" => "Elektromos", "7" => "Etanol", "13" => "G??z", "5" => "Hibrid", "11" => "Benzin/elektromos", "12" => "D??zel/elektromos", "16" => "Hidrog??n/elektromos", "17" => "Kerozin"
			],
			"hengerelrendezes" => [
				"3" => "Boxer", "1" => "Soros", "4" => "Soros ??ll??", "5" => "Soros Fekv??", "2" => "V", "6" => "W", "7" => "Wankel"
			],
			"hajtas" => [
				"1" => "Els?? ker??k", "2" => "H??ts?? ker??k", "3" => "??sszker??k", "5" => "??lland?? ??sszker??k", "4" => "Kapcsolhat?? ??sszker??k"
			],
			"kornyezetvedelmiosztaly" => [
				"3" => "D??zel-motoros (EURO1)", "4" => "D??zel-motoros (EURO2)", "7" => "D??zel-motoros (EURO3)", "0" => "Kataliz??tor n??lk??li, Otto-motoros", "1" => "Kataliz??toros, nem szab??lyozott kever??kk??pz??s??, Otto-motoros", "6" => "Kataliz??toros, szab??lyozott kever??kk??pz??s??, OBD-rendszerrel ell??tott Otto-motoros", "9" => "Kataliz??toros, szab??lyozott kever??kk??pz??s??, OBD-rendszerrel ell??tott Otto-motoros (EURO4)", "2" => "Kataliz??toros, szab??lyozott kever??kk??pz??s??, Otto-motoros", "14" => "Meghat??rozott hat??r??rt??kek alapj??n j??v??hagyott l??gszennyez??s?? g??pkocsi (EURO5) (715/2007/EK I/1)", "15" => "Meghat??rozott hat??r??rt??kek alapj??n j??v??hagyott l??gszennyez??s?? g??pkocsi (EURO6) (715/2007/EK I/2)", "13" => "OBD-rendszerrel ell??tott D??zel-motoros (EEV)", "8" => "OBD-rendszerrel ell??tott D??zel-motoros (EURO3)", "11" => "OBD-rendszerrel ell??tott D??zel-motoros (EURO4) (ENSZ-EGB 49.03 el????r??s)", "10" => "OBD-rendszerrel ell??tott D??zel-motoros (EURO4) (ENSZ-EGB 83.05 el????r??s)", "12" => "OBD-rendszerrel ell??tott D??zel-motoros (EURO5)", "5" => "Tiszta g??z??zem??, vagy elektromos meghajt??s??, illet??leg hibrid"
			],
			"szin" => [
				"90" => "barna", "92" => "s??t??tbarna", "91" => "vil??gosbarna", "140" => "b??zs", "81" => "b??borv??r??s", "200" => "bord??", "40" => "ez??st", "10" => "feh??r", "11" => "t??rtfeh??r", "190" => "fekete", "150" => "homok", "160" => "ibolya", "20" => "k??k", "24" => "ibolyak??k", "23" => "??ce??nk??k", "22" => "s??t??tk??k", "21" => "vil??gosk??k", "80" => "lila", "110" => "narancs", "170" => "okker", "50" => "pezsg??", "30" => "piros", "100" => "r??zsasz??n", "70" => "s??rga", "73" => "aranys??rga", "72" => "citroms??rga", "71" => "narancss??rga", "130" => "sz??rke", "132" => "s??t??tsz??rke", "131" => "vil??gossz??rke", "120" => "terep", "210" => "t??rkiz", "180" => "vajsz??n??", "60" => "z??ld", "63" => "olajz??ld", "62" => "s??t??tz??ld", "61" => "vil??gosz??ld"
			],
			"karpitszin1" => [
				"90" => "barna", "92" => "s??t??tbarna", "91" => "vil??gosbarna", "140" => "b??zs", "81" => "b??borv??r??s", "200" => "bord??", "40" => "ez??st", "10" => "feh??r", "11" => "t??rtfeh??r", "190" => "fekete", "150" => "homok", "160" => "ibolya", "20" => "k??k", "24" => "ibolyak??k", "23" => "??ce??nk??k", "22" => "s??t??tk??k", "21" => "vil??gosk??k", "80" => "lila", "110" => "narancs", "170" => "okker", "50" => "pezsg??", "30" => "piros", "100" => "r??zsasz??n", "70" => "s??rga", "73" => "aranys??rga", "72" => "citroms??rga", "71" => "narancss??rga", "130" => "sz??rke", "132" => "s??t??tsz??rke", "131" => "vil??gossz??rke", "120" => "terep", "210" => "t??rkiz", "180" => "vajsz??n??", "60" => "z??ld", "63" => "olajz??ld", "62" => "s??t??tz??ld", "61" => "vil??gosz??ld"
			],
			"karpitszin2" => [
				"90" => "barna", "92" => "s??t??tbarna", "91" => "vil??gosbarna", "140" => "b??zs", "81" => "b??borv??r??s", "200" => "bord??", "40" => "ez??st", "10" => "feh??r", "11" => "t??rtfeh??r", "190" => "fekete", "150" => "homok", "160" => "ibolya", "20" => "k??k", "24" => "ibolyak??k", "23" => "??ce??nk??k", "22" => "s??t??tk??k", "21" => "vil??gosk??k", "80" => "lila", "110" => "narancs", "170" => "okker", "50" => "pezsg??", "30" => "piros", "100" => "r??zsasz??n", "70" => "s??rga", "73" => "aranys??rga", "72" => "citroms??rga", "71" => "narancss??rga", "130" => "sz??rke", "132" => "s??t??tsz??rke", "131" => "vil??gossz??rke", "120" => "terep", "210" => "t??rkiz", "180" => "vajsz??n??", "60" => "z??ld", "63" => "olajz??ld", "62" => "s??t??tz??ld", "61" => "vil??gosz??ld"
			],
			"sebessegvalto" => [
				"A0" => "automata sebess??gv??lt??", "A3" => "automata (3 fokozat??) sebess??gv??lt??", "A4" => "automata (4 fokozat??) sebess??gv??lt??", "A5" => "automata (5 fokozat??) sebess??gv??lt??", "A6" => "automata (6 fokozat??) sebess??gv??lt??", "A7" => "automata (7 fokozat??) sebess??gv??lt??", "A8" => "automata (8 fokozat??) sebess??gv??lt??", "A9" => "automata (9 fokozat??) sebess??gv??lt??", "A10" => "automata (10 fokozat??) sebess??gv??lt??", "F0" => "f??lautomata sebess??gv??lt??", "V0" => "fokozatmentes automata sebess??gv??lt??", "M0" => "manu??lis sebess??gv??lt??", "M3" => "manu??lis (3 fokozat??) sebess??gv??lt??", "M4" => "manu??lis (4 fokozat??) sebess??gv??lt??", "M5" => "manu??lis (5 fokozat??) sebess??gv??lt??", "M6" => "manu??lis (6 fokozat??) sebess??gv??lt??", "M7" => "manu??lis (7 fokozat??) sebess??gv??lt??", "S0" => "szekvenci??lis sebess??gv??lt??", "S4" => "szekvenci??lis (4 fokozat??) sebess??gv??lt??", "S5" => "szekvenci??lis (5 fokozat??) sebess??gv??lt??", "S6" => "szekvenci??lis (6 fokozat??) sebess??gv??lt??", "S7" => "szekvenci??lis (7 fokozat??) sebess??gv??lt??", "S8" => "szekvenci??lis (8 fokozat??) sebess??gv??lt??", "T0" => "tiptronic sebess??gv??lt??", "T4" => "automata (4 fokozat?? tiptronic) sebess??gv??lt??", "T5" => "automata (5 fokozat?? tiptronic) sebess??gv??lt??", "T6" => "automata (6 fokozat?? tiptronic) sebess??gv??lt??", "T7" => "automata (7 fokozat?? tiptronic) sebess??gv??lt??", "T8" => "automata (8 fokozat?? tiptronic) sebess??gv??lt??", "T9" => "automata (9 fokozat?? tiptronic) sebess??gv??lt??"
			],
			"teto" => [
				"10" => "elh??zhat?? napf??nytet??", "8" => "fix napf??nytet??", "5" => "fix ??vegtet??", "4" => "harmonikatet??", "7" => "lemeztet??", "11" => "motoros napf??nytet??", "3" => "nyithat?? kem??nytet??", "9" => "nyithat?? napf??nytet??", "6" => "panor??ma tet??", "1" => "targatet??", "2" => "v??szontet??"
			],
			"gar_lejarat" => [
				"2" => "Egy ??v", "1" => "F??l ??v", "4" => "H??rom ??v", "3" => "K??t ??v"
			],
			"klima" => [
				"2" => "automata kl??ma", "4" => "digit??lis k??tz??n??s kl??ma", "3" => "digit??lis kl??ma", "5" => "digit??lis t??bbz??n??s kl??ma", "1" => "manu??lis kl??ma", "0" => "nincs"
			],
			"extra_muszaki" => [
				"1" => "??ll??that?? korm??ny", "8" => "centr??lz??r", "16" => "elektromos ablak el??l", "32" => "elektromos ablak h??tul", "64" => "elektromos t??k??r", "128" => "fed??lzeti komputer", "256" => "f??thet?? t??k??r", "1024" => "k??nny??f??m felni", "16384" => "riaszt??", "32768" => "szervokorm??ny", "65536" => "sz??nezett ??veg", "131072" => "tempomat", "262144" => "von??horog", "1048576" => "tol??ajt??", "8388608" => "r??szecskesz??r??", "16777216" => "kulcsn??lk??li ind??t??s", "33554432" => "korm??nyv??lt??", "67108864" => "chiptuning", "134217728" => "??ll??that?? felf??ggeszt??s", "268435456" => "defektjav??t?? k??szlet", "536870912" => "kr??m felni", "1073741824" => "tol??tet?? (napf??nytet??)", "2147483648" => "elektromos tol??tet??", "4294967296" => "EDC (elektronikus leng??scsillap??t??s vez??rl??s)", "8589934592" => "sebess??gf??gg?? szerv??korm??ny", "17179869184" => "sportfut??m??", "34359738368" => "ker??mia f??kt??rcs??k", "68719476736" => "sport??l??sek", "137438953472" => "t??vols??gtart?? tempomat", "274877906944" => "sperr differenci??lm??"
			],
			"extra_kenyelmi" => [
				"1" => "??ll??that?? h??ts?? ??l??sek", "2" => "b??r bels??", "16" => "d??nthet?? utas??l??sek", "128" => "faberak??s", "256" => "full extra", "512" => "f??thet?? ??l??s", "4096" => "mem??ri??s vezet????l??s", "16384" => "pl??ss k??rpit", "65536" => "tolat??radar", "131072" => "??l??smagass??g ??ll??t??s", "4194304" => "??ll??f??t??s", "16777216" => "f??thet?? korm??ny", "33554432" => "k??z??ps?? kart??masz", "67108864" => "ajt??szerv??", "134217728" => "p??tker??k", "268435456" => "tolat??kamera", "536870912" => "??l??sh??t??s/szell??ztet??s", "1073741824" => "t??vols??gi f??nysz??r?? asszisztens", "4294967296" => "??ll?? helyzeti kl??ma", "8589934592" => "automatikusan s??t??ted?? bels?? t??k??r", "17179869184" => "automatikusan s??t??ted?? k??ls?? t??k??r", "34359738368" => "automatikus csomagt??r-ajt??", "68719476736" => "massz??roz??s ??l??s", "137438953472" => "h??thet?? kart??masz", "274877906944" => "h??thet?? keszty??tart??", "549755813888" => "f??thet?? sz??lv??d??", "1099511627776" => "elektromosan behajthat?? k??ls?? t??kr??k", "2199023255552" => "multifunkci??s korm??nyker??k", "4398046511104" => "gar??zsajt?? t??vir??ny??t??", "8796093022208" => "elektronikus fut??m?? hangol??s", "17592186044416" => "elektromosan ??ll??that?? fejt??ml??k", "35184372088832" => "vel??r k??rpit", "70368744177664" => "m??b??r-k??rpit", "140737488355328" => "f??thet?? ablakmos?? f??v??k??k", "281474976710656" => "??ll??that?? combt??masz", "562949953421312" => "der??kt??masz", "1125899906842620" => "elektromos ??l??s??ll??t??s vezet??oldal", "2251799813685240" => "elektromos ??l??s??ll??t??s utasoldal", "4503599627370490" => "b??r-sz??vet huzat"
			],
			"extra_biztonsagi" => [
				"1" => "ABS (blokkol??sg??tl??)", "2" => "ASR (kip??rg??sg??tl??)", "4" => "buk??cs??", "8" => "csomag r??gz??t??", "16" => "f??gg??nyl??gzs??k", "32" => "h??ts?? oldal l??gzs??k", "64" => "ISOFIX rendszer", "128" => "k??dl??mpa", "256" => "kikapcsolhat?? l??gzs??k", "512" => "oldall??gzs??k", "1024" => "utasoldali l??gzs??k", "2048" => "vezet??oldali l??gzs??k", "4096" => "xenon f??nysz??r??", "8192" => "ESP (menetstabiliz??tor)", "524288" => "kanyark??vet?? f??nysz??r??", "2097152" => "sebess??gv??lt?? z??r", "16777216" => "ADS (adapt??v leng??scsillap??t??)", "33554432" => "EBD/EBV (elektronikus f??ker??-eloszt??)", "67108864" => "EDS (elektronikus differenci??lz??r)", "134217728" => "bi-xenon f??nysz??r??", "268435456" => "es??szenzor", "536870912" => "APS (parkol??radar)", "1073741824" => "t??rdl??gzs??k", "2147483648" => "s??vtart?? rendszer", "4294967296" => "ARD (automatikus t??vols??gtart??)", "8589934592" => "t??bla-felismer?? funkci??", "17179869184" => "??jjell??t?? asszisztens", "34359738368" => "defektt??r?? abroncsok", "68719476736" => "holtt??r-figyel?? rendszer", "137438953472" => "guminyom??s-ellen??rz?? rendszer", "274877906944" => "buk??l??mpa", "549755813888" => "LED f??nysz??r??", "1099511627776" => "h??ts?? fejt??ml??k", "2199023255552" => "rabl??sg??tl??", "4398046511104" => "ind??t??sg??tl?? (immobiliser)", "8796093022208" => "kieg??sz??t?? f??nysz??r??", "17592186044416" => "f??nysz??r?? magass??g??ll??t??s", "35184372088832" => "f??nysz??r??mos??", "70368744177664" => "s??vv??lt?? asszisztens", "140737488355328" => "visszagurul??s-g??tl??", "281474976710656" => "lejtmenet asszisztens", "562949953421312" => "be??p??tett gyerek??l??s", "1125899906842620" => "f??kasszisztens", "2251799813685240" => "MSR (motorf??knyomat??k szab??lyz??s)", "4503599627370490" => "GPS nyomk??vet??", "9007199254740990" => "gyalogos l??gzs??k"
			],
			"extra_egyeb" => [
				"1" => "aut??besz??m??t??s lehets??ges", "2" => "els?? tulajdonost??l", "4" => "gar??zsban tartott", "8" => "h??lgy tulajdonost??l", "16" => "keveset futott", "32" => "m??sodik tulajdonost??l", "64" => "nem doh??nyz??", "128" => "rendszeresen karbantartott", "256" => "szervizk??nyv", "512" => "taxi", "1024" => "t??rzsk??nyv", "2048" => "garanci??lis", "8192" => "rendelhet??", "16384" => "azonnal elvihet??", "32768" => "amerikai modell", "65536" => "jobbkorm??nyos", "131072" => "bemutat?? j??rm??", "16777216" => "mozg??ss??r??lt", "33554432" => "frissen szervizelt", "67108864" => "Magyarorsz??gon ??jonnan ??zembe helyezett", "134217728" => "motorbesz??m??t??s lehets??ges", "268435456" => "tekert kilom??ter??ra"
			],
			"extra_audio" => [
				"1" => "r??di??", "2" => "r??di??s magn??", "4" => "CD-s aut??r??di??", "8" => "CD t??r", "16" => "DVD", "32" => "mem??riak??rtya-olvas??", "64" => "merevlemez", "128" => "FM transzmitter", "256" => "GPS (navig??ci??)", "512" => "kihangos??t??", "1024" => "bluetooth-os kihangos??t??", "2048" => "iPhone/iPod csatlakoz??", "4096" => "USB csatlakoz??", "8192" => "AUX csatlakoz??", "16384" => "er??s??t?? kimenet", "32768" => "HDMI bemenet", "65536" => "tolat??kamera bemenet", "131072" => "mikrofon bemenet", "262144" => "DVB tuner", "524288" => "DVB-T tuner", "1048576" => "anal??g TV tuner", "2097152" => "MP3 lej??tsz??s", "4194304" => "MP4 lej??tsz??s", "8388608" => "WMA lej??tsz??s", "16777216" => "t??vir??ny??t??", "33554432" => "korm??nyra szerelhet?? t??vir??ny??t??", "67108864" => "??rint??kijelz??", "536870912" => "er??s??t??", "1073741824" => "gy??ri er??s??t??", "2147483648" => "fejt??mlamonitor", "4294967296" => "tet??monitor", "8589934592" => "1 DIN", "17179869184" => "2 DIN", "34359738368" => "2 hangsz??r??", "68719476736" => "4 hangsz??r??", "137438953472" => "5 hangsz??r??", "274877906944" => "6 hangsz??r??", "549755813888" => "7 hangsz??r??", "1099511627776" => "8 hangsz??r??", "2199023255552" => "9 hangsz??r??", "4398046511104" => "10 hangsz??r??", "8796093022208" => "11 hangsz??r??", "17592186044416" => "12 hangsz??r??", "35184372088832" => "m??lynyom??", "70368744177664" => "aut??telefon", "140737488355328" => "TV", "281474976710656" => "HIFI"
			],
			"eklima" => [
				"2" => "automata kl??ma", "4" => "digit??lis k??tz??n??s kl??ma", "3" => "digit??lis kl??ma", "5" => "digit??lis t??bbz??n??s kl??ma", "1" => "manu??lis kl??ma", "0" => "nincs"
			],
			"eextra_muszaki" => [
				"1" => "??ll??that?? korm??ny", "8" => "centr??lz??r", "16" => "elektromos ablak el??l", "32" => "elektromos ablak h??tul", "64" => "elektromos t??k??r", "128" => "fed??lzeti komputer", "256" => "f??thet?? t??k??r", "1024" => "k??nny??f??m felni", "16384" => "riaszt??", "32768" => "szervokorm??ny", "65536" => "sz??nezett ??veg", "131072" => "tempomat", "262144" => "von??horog", "1048576" => "tol??ajt??", "8388608" => "r??szecskesz??r??", "16777216" => "kulcsn??lk??li ind??t??s", "33554432" => "korm??nyv??lt??", "67108864" => "chiptuning", "134217728" => "??ll??that?? felf??ggeszt??s", "268435456" => "defektjav??t?? k??szlet", "536870912" => "kr??m felni", "1073741824" => "tol??tet?? (napf??nytet??)", "2147483648" => "elektromos tol??tet??", "4294967296" => "EDC (elektronikus leng??scsillap??t??s vez??rl??s)", "8589934592" => "sebess??gf??gg?? szerv??korm??ny", "17179869184" => "sportfut??m??", "34359738368" => "ker??mia f??kt??rcs??k", "68719476736" => "sport??l??sek", "137438953472" => "t??vols??gtart?? tempomat", "274877906944" => "sperr differenci??lm??"
			],
			"eextra_kenyelmi" => [
				"1" => "??ll??that?? h??ts?? ??l??sek", "2" => "b??r bels??", "16" => "d??nthet?? utas??l??sek", "128" => "faberak??s", "256" => "full extra", "512" => "f??thet?? ??l??s", "4096" => "mem??ri??s vezet????l??s", "16384" => "pl??ss k??rpit", "65536" => "tolat??radar", "131072" => "??l??smagass??g ??ll??t??s", "4194304" => "??ll??f??t??s", "16777216" => "f??thet?? korm??ny", "33554432" => "k??z??ps?? kart??masz", "67108864" => "ajt??szerv??", "134217728" => "p??tker??k", "268435456" => "tolat??kamera", "536870912" => "??l??sh??t??s/szell??ztet??s", "1073741824" => "t??vols??gi f??nysz??r?? asszisztens", "4294967296" => "??ll?? helyzeti kl??ma", "8589934592" => "automatikusan s??t??ted?? bels?? t??k??r", "17179869184" => "automatikusan s??t??ted?? k??ls?? t??k??r", "34359738368" => "automatikus csomagt??r-ajt??", "68719476736" => "massz??roz??s ??l??s", "137438953472" => "h??thet?? kart??masz", "274877906944" => "h??thet?? keszty??tart??", "549755813888" => "f??thet?? sz??lv??d??", "1099511627776" => "elektromosan behajthat?? k??ls?? t??kr??k", "2199023255552" => "multifunkci??s korm??nyker??k", "4398046511104" => "gar??zsajt?? t??vir??ny??t??", "8796093022208" => "elektronikus fut??m?? hangol??s", "17592186044416" => "elektromosan ??ll??that?? fejt??ml??k", "35184372088832" => "vel??r k??rpit", "70368744177664" => "m??b??r-k??rpit", "140737488355328" => "f??thet?? ablakmos?? f??v??k??k", "281474976710656" => "??ll??that?? combt??masz", "562949953421312" => "der??kt??masz", "1125899906842620" => "elektromos ??l??s??ll??t??s vezet??oldal", "2251799813685240" => "elektromos ??l??s??ll??t??s utasoldal", "4503599627370490" => "b??r-sz??vet huzat"
			],
			"eextra_biztonsagi" => [
				"1" => "ABS (blokkol??sg??tl??)", "2" => "ASR (kip??rg??sg??tl??)", "4" => "buk??cs??", "8" => "csomag r??gz??t??", "16" => "f??gg??nyl??gzs??k", "32" => "h??ts?? oldal l??gzs??k", "64" => "ISOFIX rendszer", "128" => "k??dl??mpa", "256" => "kikapcsolhat?? l??gzs??k", "512" => "oldall??gzs??k", "1024" => "utasoldali l??gzs??k", "2048" => "vezet??oldali l??gzs??k", "4096" => "xenon f??nysz??r??", "8192" => "ESP (menetstabiliz??tor)", "524288" => "kanyark??vet?? f??nysz??r??", "2097152" => "sebess??gv??lt?? z??r", "16777216" => "ADS (adapt??v leng??scsillap??t??)", "33554432" => "EBD/EBV (elektronikus f??ker??-eloszt??)", "67108864" => "EDS (elektronikus differenci??lz??r)", "134217728" => "bi-xenon f??nysz??r??", "268435456" => "es??szenzor", "536870912" => "APS (parkol??radar)", "1073741824" => "t??rdl??gzs??k", "2147483648" => "s??vtart?? rendszer", "4294967296" => "ARD (automatikus t??vols??gtart??)", "8589934592" => "t??bla-felismer?? funkci??", "17179869184" => "??jjell??t?? asszisztens", "34359738368" => "defektt??r?? abroncsok", "68719476736" => "holtt??r-figyel?? rendszer", "137438953472" => "guminyom??s-ellen??rz?? rendszer", "274877906944" => "buk??l??mpa", "549755813888" => "LED f??nysz??r??", "1099511627776" => "h??ts?? fejt??ml??k", "2199023255552" => "rabl??sg??tl??", "4398046511104" => "ind??t??sg??tl?? (immobiliser)", "8796093022208" => "kieg??sz??t?? f??nysz??r??", "17592186044416" => "f??nysz??r?? magass??g??ll??t??s", "35184372088832" => "f??nysz??r??mos??", "70368744177664" => "s??vv??lt?? asszisztens", "140737488355328" => "visszagurul??s-g??tl??", "281474976710656" => "lejtmenet asszisztens", "562949953421312" => "be??p??tett gyerek??l??s", "1125899906842620" => "f??kasszisztens", "2251799813685240" => "MSR (motorf??knyomat??k szab??lyz??s)", "4503599627370490" => "GPS nyomk??vet??", "9007199254740990" => "gyalogos l??gzs??k"
			],
			"eextra_egyeb" => [
				"1" => "aut??besz??m??t??s lehets??ges", "2" => "els?? tulajdonost??l", "4" => "gar??zsban tartott", "8" => "h??lgy tulajdonost??l", "16" => "keveset futott", "32" => "m??sodik tulajdonost??l", "64" => "nem doh??nyz??", "128" => "rendszeresen karbantartott", "256" => "szervizk??nyv", "512" => "taxi", "1024" => "t??rzsk??nyv", "2048" => "garanci??lis", "8192" => "rendelhet??", "16384" => "azonnal elvihet??", "32768" => "amerikai modell", "65536" => "jobbkorm??nyos", "131072" => "bemutat?? j??rm??", "16777216" => "mozg??ss??r??lt", "33554432" => "frissen szervizelt", "67108864" => "Magyarorsz??gon ??jonnan ??zembe helyezett", "134217728" => "motorbesz??m??t??s lehets??ges", "268435456" => "tekert kilom??ter??ra"
			],
			"eextra_audio" => [
				"1" => "r??di??", "2" => "r??di??s magn??", "4" => "CD-s aut??r??di??", "8" => "CD t??r", "16" => "DVD", "32" => "mem??riak??rtya-olvas??", "64" => "merevlemez", "128" => "FM transzmitter", "256" => "GPS (navig??ci??)", "512" => "kihangos??t??", "1024" => "bluetooth-os kihangos??t??", "2048" => "iPhone/iPod csatlakoz??", "4096" => "USB csatlakoz??", "8192" => "AUX csatlakoz??", "16384" => "er??s??t?? kimenet", "32768" => "HDMI bemenet", "65536" => "tolat??kamera bemenet", "131072" => "mikrofon bemenet", "262144" => "DVB tuner", "524288" => "DVB-T tuner", "1048576" => "anal??g TV tuner", "2097152" => "MP3 lej??tsz??s", "4194304" => "MP4 lej??tsz??s", "8388608" => "WMA lej??tsz??s", "16777216" => "t??vir??ny??t??", "33554432" => "korm??nyra szerelhet?? t??vir??ny??t??", "67108864" => "??rint??kijelz??", "536870912" => "er??s??t??", "1073741824" => "gy??ri er??s??t??", "2147483648" => "fejt??mlamonitor", "4294967296" => "tet??monitor", "8589934592" => "1 DIN", "17179869184" => "2 DIN", "34359738368" => "2 hangsz??r??", "68719476736" => "4 hangsz??r??", "137438953472" => "5 hangsz??r??", "274877906944" => "6 hangsz??r??", "549755813888" => "7 hangsz??r??", "1099511627776" => "8 hangsz??r??", "2199023255552" => "9 hangsz??r??", "4398046511104" => "10 hangsz??r??", "8796093022208" => "11 hangsz??r??", "17592186044416" => "12 hangsz??r??", "35184372088832" => "m??lynyom??", "70368744177664" => "aut??telefon", "140737488355328" => "TV", "281474976710656" => "HIFI"
			],
			"futasido" => [
				"3" => "el??rendelt", "2" => "tesztj??rm??", "1" => "??jj??rm??"
			],
		];
		
		if(!empty($key) AND !empty($val)) { return $return[$key][$val]; }
		elseif(!empty($key)) { return $return[$key]; }
		else { return $return; }
	}
}
?>