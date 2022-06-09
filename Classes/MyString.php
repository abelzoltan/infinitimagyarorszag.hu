<?php 
class MyString
{
	#String max length
	public static function strMax($text, $maxLength = 100, $after = "[...]", $anyWhere = 1)
	{
		$length = strlen($text);
		$afterLength = strlen($after);
		$maxOutLength = $maxLength - $afterLength;
		
		if($length <= $maxOutLength) { $string = $text; }
		else
		{
			if($anyWhere == 1) { $string = mb_substr($text, 0, $maxOutLength, "utf-8")." ".$after; }
			else {  }
		}
		return $string;
	}
	
	#Hungarian number format
	public static function number($number, $decimals = 2, $after = "")
	{
		$intCheck = round($number);
		if($number == $intCheck) { $x = number_format($number, 0, ",", " "); }
		else { $x = number_format($number, $decimals, ",", " "); }
		return $x.$after;
	}
	
	#Generate URL	
	public static function generateURL($string, $after = NULL, $replace = array(), $delimiter = "-")
	{	
		if(!empty($replace)) { $string = str_replace((array)$replace, " ", $string); }
		
		$return = iconv("utf-8", "ASCII//TRANSLIT", $string);
		if(empty($return)) { $return = $string; }
		$return = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", "", $return);
		$return = strtolower(trim($return, "-"));
		$return = preg_replace("/[\/_|+ -]+/", $delimiter, $return);
		
		if(!empty($after)) { $return .= $delimiter.$after; }

		return $return;
	}
	
	public static function generateURL2($string, $foreignKey = 0, $divider = "-")
	{
		#Special letters
		$from = array("ö", "ü", "ó", "ő", "ú", "é", "á", "ű", "í", "Ö", "Ü", "Ó", "Ő", "Ú", "É", "Á", "Ű", "Í");
		$to = array("o", "u", "o", "o", "u", "e", "a", "u", "i", "o", "u", "o", "o", "u", "e", "a", "u", "i");
		$out = str_replace($from, $to, $string);
		#Divider, Special characters
		$out = str_replace(" ", "-", $out);
		$out = preg_replace("/[^A-Za-z0-9\-]/", "", $out);
		if($divider != "-") { $out = str_replace("-", $divider, $out); }
		#Lowercase, max. length
		$out = strtolower($out);
		$out = mb_substr($out, 0, 100, "utf-8");
		#ID
		if($foreignKey != 0) { $out .= $divider.$foreignKey; }
		#Return
		return $out;
	}
	
	#Normalize HTML (close un-ended tags, etc.)
	public static function htmlNormalize($text)
	{
		$dom = new DOMDocument;
		$dom->loadHTML(mb_convert_encoding($text, "HTML-ENTITIES", "UTF-8"));
		$xpath = new DOMXPath($dom);
		$body = $xpath->query("/html/body");
		return $dom->saveHTML($body->item(0));
	}
	
	#Generate random string or token
	public static function random($length = 10, $extraAllowToUse = array(), $basicAllowToUse = array("numbers", "smallLetters", "capitalLetters")) 
	{
		#Arrays
		$numbers = range(0, 9);
		$smallLetters = range("a", "z");
		$capitalLetters = range("A", "Z");
		
		#Generate array with chars to be used
		$chars = array();
		foreach($extraAllowToUse AS $item)
		{
			$chars = array_merge($chars, $item);
		}
		foreach($basicAllowToUse AS $item)
		{
			$chars = array_merge($chars, $$item);
		}
		
		#Generate and return
		$return = "";
		for($i = 0; $i < $length; $i++) { $return .= $chars[mt_rand(0, count($chars) - 1)]; }
		return $return;
	}
	
	public static function generateToken($length = 10, $extraAllowToUse = array(), $basicAllowToUse = array("numbers", "smallLetters", "capitalLetters"), $hash = "sha1")
	{
		$string = self::random($length, $extraAllowToUse, $basicAllowToUse);
		$string = $hash($string);
		return $string;
	}
	
	#Generate random string or token V2
	public static function random2($length = 10, $capitals = 1, $lowercase = 1, $numbers = 1, $spec = 0)
	{
		#Set chars which to use
		$capitalLetters = array("A", "B", "C", "d", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
		$smallLetters = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
		$numbersArray = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
		$specialChars = array("(", ")", "!", "?", "%", "/", "\\", "=", "'", "~", "*", "-", "_", ".", ",", "@", "{", "}", "[", "]");
		
		$myArray = array();
		if($capitals) { $myArray = array_merge($myArray, $capitalLetters); }
		if($lowercase) { $myArray = array_merge($myArray, $smallLetters); }
		if($numbers) { $myArray = array_merge($myArray, $numbersArray); }
		if($spec) { $myArray = array_merge($myArray, $specialChars); }
		#Generate the string
		$string = "";
		for($i = 1; $i <= $length; $i++)
		{
			$char = array_rand($myArray);
			$string .= $myArray[$char];
		}
		#Hash-ing the string
		return $string;
	}

	public static function generateToken2($length = 10, $capitals = 1, $lowercase = 1, $numbers = 1, $spec = 0, $hash = "sha1")
	{
		$string = self::random2($length, $capitals, $lowercase, $numbers, $spec);
		$string = $hash($string);
		return $string;
	}
}
?>