<?php namespace Core\Controllers;
use Core\Models\Integrante as Integrante;

class BirthdayController{

	private $integrante;
	public function __construct(){
		$this->integrante = new Integrante();
	}

	public function index(){
		if (empty($_SESSION['app_id'])) {
			header("Location:" . URL . "Integrantes");
		}
	}
}
$Asistencia= new BirthdayController();


?>