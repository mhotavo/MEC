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

	}

 ?>