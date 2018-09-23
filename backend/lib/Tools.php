<?php
class Tools
{
	/**
	* Funkce pro konverzi typu proměnné
	* 
	* @param mixed $var vstupní proměnná
	* @param mixed $to typ výstupní proměnné [array,bool,float,int,string]
	* @param mixed $default výchozí hodnota, není-li proměnná $var definována
	* @param bool $array zpracuje proměnnou $var jako pole - na typ $to budou převedeny všechny hodnoty pole
	* @return mixed
	*/
	public function convertData(&$var, $to = 'string', $default = null, $array = false)
	{
		$var = isset($var) ? $var : $default;
		
		if(!$array)
			settype($var, $to);
		else
		{
			foreach($var as $k => $v)
				settype($v, $to);
		}
		return $var;	
	}
	
	/**
	 * Dump proměnné
	 *
	 * @param mixed $variable
	 * @param mixed $prefix
	 * @param bool $return
	 * @return string
	 */
	public function dump(&$variable, $prefix = '', $return = false)
	{
		$out = '<pre>'.$prefix.print_r($variable, 1).'</pre>';
		if(!$return)
			echo $out;

		return $out;
	}
	
	/**
	* Převede první písmeno na malé
	* 
	* @param string $str
	* @return string
	*/
	public function firstDown($str) { 
		return preg_replace_callback('/^(.)/u', function($m) { return mb_strtolower($m[1]); }, $str); 
	}

	/**
	* Převede první písmeno na velké
	* 
	* @param string $str
	* @return string
	*/
	public function firstUp($str) { 
		return preg_replace_callback('/^(.)/u', function($m) { return mb_strtoupper($m[1]); }, $str); 
	}
	
	/**
	* Konvertuje proměnnou na array
	* 
	* @param mixed $var vstupní proměnná
	* @param mixed $def výchozí hodnota
	* @param bool $array zpracuje proměnnou $var rekurzivně
	* @return array|array of array
	*/
	public function getArray(&$var, $def = null, $array = false) { 
		return $var = self::convertData($var, 'array', $def, $array); 
	}

	/**
	* Konvertuje proměnnou na true|false
	* 
	* @param mixed $var vstupní proměnná
	* @param mixed $def výchozí hodnota
	* @param bool $array zpracuje proměnnou $var rekurzivně
	* @return bool|array of bool
	*/
	public function getBool(&$var, $def = null, $array = false) { 
		return $var = self::convertData($var, 'boolean', $def, $array); 
	}

	/**
	* Konvertuje proměnnou na float
	* 
	* @param mixed $var vstupní proměnná
	* @param mixed $def výchozí hodnota
	* @param bool $array zpracuje proměnnou $var rekurzivně
	* @return float|array of float
	*/
	public function getFloat(&$var, $def = null, $array = false) { 
		return $var = self::convertData($var, 'float', $def, $array); 
	}

	/**
	* Konvertuje proměnnou na integer
	* 
	* @param mixed $var vstupní proměnná
	* @param mixed $def výchozí hodnota
	* @param bool $array zpracuje proměnnou $var rekurzivně
	* @return int|array of int
	*/
	public function getInt(&$var, $def = null, $array = false) { 
		return self::convertData($var, 'int', $def, $array); 
	}

	/**
	* Konvertuje proměnnou na string
	* 
	* @param mixed $var vstupní proměnná
	* @param mixed $def výchozí hodnota
	* @param bool $array zpracuje proměnnou $var rekurzivně
	* @return string|array of string
	*/
	public function getStr(&$var, $def = null, $array = false) { 
		return self::convertData($var, 'string', $def, $array); 
	}
	
	/**
	* Testuje, jestli je proměnná naplněná. Pokud je proměnná nebo všechny klíče v poli null nebo "", vrací false.
	* @param mixed $value
	* @return bool
	*/
	public function isFilled(&$value)
	{
		if(is_array($value)){
			$isFilled = false;
			foreach($value as $i){
				if(is_array($i)){
					$isFilled = $isFilled || self::isFilled($i);
				}
				elseif($i !== null && $i != "") {
					$isFilled = true;	
				}			
			}		
			return $isFilled;
		}
		else{
			return ($value !== null && $value != "");
		}	
	}
	
	public function joinFilled($qlue = '', $array = [])
	{
		$filled = [];
		if(count($array)) {
			foreach($array as $value) {
				if($this->isFilled($value)) {
					$filled = $value;
				}
			}
		}
		return join($qlue, $filled);
	}
	
	public function redirect($url, $code = '301')
	{
		$this->setHttpStatus($code);
		header("Location: $url");
		exit;
	}
	
	public function setHttpStatus($status)
	{
		$statusList = array
		(
			100 => 'Continue',								101 => 'Switching Protocols',					200 => 'OK', 							201 => 'Created',
			202 => 'Accepted',								203 => 'Non-Authoritative Information',	204 => 'No Content',					205 => 'Reset Content',
			206 => 'Partial Content',						300 => 'Multiple Choices',						301 => 'Moved Permanently',		302 => 'Found',
			303 => 'See Other',								304 => 'Not Modified',							305 => 'Use Proxy',					307 => 'Temporary Redirect',
			400 => 'Bad Request',							401 => 'Unauthorized',							402 => 'Payment Required',			403 => 'Forbidden',
			404 => 'Not Found',								405 => 'Method Not Allowed',					406 => 'Not Acceptable',			407 => 'Proxy Authentication Required',
			408 => 'Request Timeout',						409 => 'Conflict',								410 => 'Gone',							411 => 'Length Required',
			412 => 'Precondition Failed',					413 => 'Request Entity Too Large',			414 => 'Request-URI Too Long',	415 => 'Unsupported Media Type',
			416 => 'Requested Range Not Satisfiable',	417 => 'Expectation Failed',					500 => 'Internal Server Error',	501 => 'Not Implemented ',
			502 => 'Bad Gateway',							503 => 'Service Unavailable',					504 => 'Gateway Timeout',			505 => 'HTTP Version Not Supported',
		);
		
		header("HTTP/1.1 $status $statusList[$status]");
		header("Status-Code: $status");
	}
	
	public function strtohex($x) 
	{
		$s = '';
		foreach (str_split($x) as $c) { 
			$s .= sprintf("%02X",ord($c));
		}
		return $s;
	} 
}
