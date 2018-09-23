<?php
class Perseos extends BaseClass
{
	private $controller;
	private $action;
	private $params;
	private $url;
	private $config;
	
	public function __construct()
	{
		$env = $_SERVER['SERVER_NAME'] == 'perseos.ja' ? 'devel' : 'production';
		$this->config = parse_ini_file(BASE_DIR.'/config/config.ini', 1);

		DB::$host = $this->config["db.$env"]['host'];
		DB::$dbName = $this->config["db.$env"]['name'];
		DB::$user = $this->config["db.$env"]['user'];
		DB::$pass = $this->config["db.$env"]['pass'];

		$url = isset($_GET['url']) ? trim($_GET['url'], '/') : 'perseos/info';
		$parts = explode('/', $url);
		
		$controller = array_shift($parts);
		$action = array_shift($parts);
		
		$this->controller = $this->capitalize($controller).'Controller';
		$this->action = $action;
		$this->params = $parts;
	}
	
	public function run()
	{
		$controllerClassName = $this->controller;
		/** @var \BaseClass $controller */
		$controller = $controllerClassName::getInstance();
		
		call_user_func_array([$controller, $this->action], $this->params);
		
		$this->out = $controller->toString();
	}
	
	private function capitalize($string)
	{
		$string = mb_strtolower($string);
		return preg_replace_callback('/^(.)/', function($matches) { return mb_strtoupper($matches[0]);}, $string);
	}
}
