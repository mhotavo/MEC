<?php namespace Core\Config;

	class Autoload{

		public static function run(){
			spl_autoload_register(function($class){
				$ruta = str_replace("\\", "/", $class) . ".php";
				if (file_exists($ruta)) {
					include_once $ruta;
				}
				
			});
		}
	}

  ?>