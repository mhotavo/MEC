<?php  

	define('DS', DIRECTORY_SEPARATOR);
	define('ROOT', realpath(dirname(__FILE__)) . DS);
	define('URL', "http://localhost/MEC/");


	require_once "Core/Config/Autoload.php";
	Core\Config\Autoload::run();
	Core\Config\Enrutador::run(new Core\Config\Request());
	



?>