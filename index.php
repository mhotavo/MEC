<?php  

	//session_start();

	define('DS', DIRECTORY_SEPARATOR);
	define('ROOT', realpath(dirname(__FILE__)) . DS);
	define('URL', "http://localhost/MEC/");
/*
	require_once "Views/template.php";
	new Views\Template();
*/
	require_once "Core/Config/Autoload.php";
	Core\Config\Autoload::run();
	require_once "Views/template.php";
	Core\Config\Enrutador::run(new Core\Config\Request());
	require_once "vendor/autoload.php";




?>