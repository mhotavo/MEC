<?php namespace Core\Controllers;

use Core\Models\GoLogin as GoLogin;

class GoLoginController{

	private $GoLogin;

	public function __construct(){
		$this->GoLogin = new GoLogin();
	}
	public function index(){
		if ($_POST) {
			$this->GoLogin->validar();

		} else {
			header("Location:" . URL . "index");
		}
	}

	public function validarPassword(){
		if (!empty($_GET['id']) && !empty($_GET['actual']) ) {
			$this->GoLogin->__set("id", $_GET['id']);
			$this->GoLogin->__set("pass", $_GET['actual']);
			echo $datos=$this->GoLogin->validarPass();
		

		}

	}


}

?>