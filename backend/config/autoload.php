<?php

function __autoload($class)
{	
	$paths = [
		BASE_DIR.'/controller/',
		BASE_DIR.'/lib/',
		BASE_DIR.'/adapter/'
	];
	
	foreach($paths as $path) {
		if(is_file("$path$class.php")) {
			include_once "$path$class.php";
		}
	}
}
