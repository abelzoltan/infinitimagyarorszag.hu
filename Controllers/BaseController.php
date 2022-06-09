<?php 
class BaseController
{
	public $model;
	public $modelName;
	
	public function __construct($connectionData = [])
	{
		$this->getModel($connectionData);
	}
	
	#Include model
	public function getModel($connectionData = [])
	{
		if(empty($this->modelName)) { $this->modelName = str_replace("Controller", "", get_called_class()); }
		$file = DIR_MODELS.$this->modelName.".php";
		if(file_exists($file))
		{
			include_once($file);
			$className = $this->modelName;
			$this->model = new $className($connectionData);
		}
	}
	
	#HTML variable change
	public function changeHtmlVariable($text, $params, $startSign = "{", $endSign = "}")
	{
		$from = [];
		$to = [];
		foreach($params AS $key => $value)
		{
			$from[] = $startSign.$key.$endSign;
			$to[] = $value;
		}
		
		return str_replace($from, $to, $text);
	}
	
	#Unique field set (f.e: token, key, ...)
	public function setUniqueURL($table, $key, $value, $after = "", $params = [], $id = 0, $primaryKey = "id")
	{
		$count = 1;
		while(true)
		{
			$url = self::generateUrl($value, $after, [], "-");
			$rows = $this->model->checkUniqueField($table, $key, $url, $params, $id, $primaryKey);
			
			if(count($rows) > 0)
			{
				$count++;
				$after = $count;
			}
			else { break; }
		}
		
		return $url;
	}
	
	#Unique field set (f.e: token, key, ...)
	public function setUniqueToken($length, $allowToUse = ["numbers", "smallLetters", "capitalLetters"], $table, $key, $params = [], $id = 0, $primaryKey = "id")
	{
		while(true)
		{
			$token = self::random($length, [], $allowToUse);
			
			$rows = $this->model->checkUniqueField($table, $key, $token, $params, $id, $primaryKey);
			if(count($rows) == 0) { break; }
		}
		
		return $token;
	}
	
	#Generate URL	
	public static function generateURL($string, $after = NULL, $replace = [], $delimiter = "-")
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
	
	#Generate random string or token
	public static function random($length = 10, $extraAllowToUse = [], $basicAllowToUse = ["numbers", "smallLetters", "capitalLetters"]) 
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
	
	#String max length
	public function strMax($text, $maxLength = 100, $after = "[...]", $anyWhere = 1)
	{
		$length = strlen($text);
		$afterLength = strlen($after);
		$maxOutLength = $maxLength - $afterLength;
		
		if($length <= $maxOutLength) { $string = $text; }
		else
		{
			if($anyWhere == 1) { $string = mb_substr($text, 0, $maxOutLength, "utf-8")." ".$after; }
			else { /* ONLY on spaces */ }
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
	
	#JSON encode and decode
	public function json($array)
	{
		return $this->model->json($array);
	}
	
	public function jsonDecode($json)
	{
		return $this->model->jsonDecode($json);
	}
}
?>