<?php  

	define('DS', DIRECTORY_SEPARATOR);
	define('ROOT', realpath(dirname(__FILE__)) . DS);
	define('URL', "http://localhost/MEC/");


	require_once "Core/Config/Autoload.php";
	Core\Config\Autoload::run();
	new Core\Config\Request();

	/*$integrante = new Core\Models\Integrante();
	$integrante->__set("documento", 1);
	$datos=$integrante->view();
     print $datos['NOMBRES'];*/
 


?>