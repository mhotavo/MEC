<?php namespace Core\Config;

	class Enrutador
	{

		public static function run(Request $request){
				$controlador = ucwords($request->getControlador()) . "Controller";
			    $ruta = ROOT . "Core". DS . "Controllers" . DS . $controlador .".php";
				$metodo = $request->getMetodo();
			#Ejecuta enrutador solo cuando se inicia sesion y para el Login	
			if ( isset($_SESSION['app_id']) or  ucwords($request->getControlador())=="Login" or $request->getControlador()=="gologin" ) 
			{
				if($metodo == "index.php"){
					$metodo = "index";
				}

				$argumento = $request->getArgumento();
				if(is_readable($ruta)){
					require_once $ruta;
					$mostrar = "Core\Controllers\\" . $controlador;
					$controlador = new $mostrar;
					#Validamos que el metodo exista en la clase controlador
					#echo $exist=var_dump(method_exists($controlador,$metodo));

					if(!isset($argumento) and method_exists($controlador,$metodo) ){
						$datos = call_user_func(array($controlador, $metodo));
					}elseif(method_exists($controlador,$metodo)){
						$datos = call_user_func_array(array($controlador, $metodo), $argumento);
					}
				}

		 

				#Para todas las vistas, excepto login
				if (ucwords($request->getControlador())!="Login" and $request->getControlador()!="gologin") 
				{
					//Cargar vista
					$ruta = ROOT . "HTML" . DS . ucwords($request->getControlador()) . DS . $request->getMetodo() . ".php";
					if(is_readable($ruta)){
						require_once $ruta;
					}else{
						print "No se encontro la vista";
					}	
				}

			} else {
				header("Location:" . URL . "Login");
			}


		}
	}
	


?>
 