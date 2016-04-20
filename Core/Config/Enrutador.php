<?php namespace Core\Config;

	class Enrutador
	{

		public static function run(Request $request){
			$controlador = $request->getControlador() . "Controller";
			$ruta = ROOT . "Core\Controllers" . DS . $controlador .".php";
			$metodo = $request->getMetodo();
			
			if($metodo == "index.php"){
				$metodo = "index";
			}

			$argumento = $request->getArgumento();
			if(is_readable($ruta)){
				require_once $ruta;
				$mostrar = "Core\Controllers\\" . $controlador;
				$controlador = new $mostrar;
				if(!isset($argumento)){

					$datos = call_user_func(array($controlador, $metodo));
				}else{
					$datos = call_user_func_array(array($controlador, $metodo), $argumento);
				}
			}
		

			//Cargar vista
			$ruta = ROOT . "HTML" . DS . ucwords($request->getControlador()) . DS . $request->getMetodo() . ".php";
			if(is_readable($ruta)){
				require_once $ruta;
			}else{
				print "No se encontro la vista";
			}

		}
	}
	


?>
 