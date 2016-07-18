<?php namespace Core\Config;

class Enrutador
{
	public static function run(Request $request){
		$controlador = ucwords($request->getControlador()) . "Controller";
		$ruta = ROOT . "Core". DS . "Controllers" . DS . $controlador .".php";
		$metodo = $request->getMetodo();
		$argumento = $request->getArgumento();
		if(is_readable($ruta)){
			require_once $ruta;
			$mostrar = "Core\Controllers\\" . $controlador;
			$controlador = new $mostrar;
			#Validamos que el metodo exista en la clase controlador
			if(!isset($argumento) and method_exists($controlador,$metodo) ){
				$datos = call_user_func(array($controlador, $metodo));
			}elseif(method_exists($controlador,$metodo)){
				$datos = call_user_func_array(array($controlador, $metodo), $argumento);
			}
		}
		//Cargar vista
		$ruta = ROOT . "HTML" . DS . ucwords($request->getControlador()) . DS . $request->getMetodo() . ".php";
		if(is_readable($ruta)){
			if (!empty($_SESSION['app_id'])) {
				require_once $ruta;
			} else {
				header("Location:" . URL);
			}

		}else{
			if ($request->getMetodo()!='listarasistencia') {
				#No se encontro la vista
				#$ruta = ROOT . "HTML" . DS . "fail.html";  
				#require_once $ruta;
			} 
		}	
	}
}



?>