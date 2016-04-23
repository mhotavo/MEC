<?php  

session_start();


#Constantes de la conexion FE5C3EE9
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'mec');

#Constantes app
	define('DS', DIRECTORY_SEPARATOR);
	define('ROOT', realpath(dirname(__FILE__)) . DS);
	define('URL', "http://localhost/MEC/");

	require_once "Views/template.php";
	
	#Solo se define luego de iniciar sesion 
		if (isset($_SESSION['app_id'])) {

			$template=new Views\Template();
		 	require_once "Core/Models/Conexion.php";
		 	require_once "vendor/autoload.php";
		}


	require_once "Core/Config/Autoload.php";
	Core\Config\Autoload::run();
	Core\Config\Enrutador::run(new Core\Config\Request());
	





?>