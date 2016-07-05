<?php namespace Core\Controllers;
use Core\Models\Usuario as Usuario;


class MiperfilController{

	private $Usuario;
	public function __construct(){
		$this->Usuario = new Usuario();
	}

	public function index(){
		if ($_POST) {
			$this->Usuario->__set("id", $_POST['id']);
			$this->Usuario->__set("documento", $_POST['inputDocumento'] );
			$this->Usuario->__set("user", $_POST['inputUser'] );
			$this->Usuario->__set("password", $_POST['nueva'] );
			$this->Usuario->__set("email", $_POST['inputEmail'] );
			$this->Usuario->__set("genero", $_POST['selectGenero']);
			$this->Usuario->__set("nombres", $_POST['inputNombres']);
			$this->Usuario->__set("primerApellido", $_POST['inputPrimerApellido']);
			$this->Usuario->__set("segundoApellido", $_POST['inputSegundoApellido']);
			$this->Usuario->edit();
			header("Location:" . URL . "miperfil");

			exit();
		}else{
			$this->Usuario->__set("id", $_SESSION['app_id']);
			$datos=$this->Usuario->view();  
			return $datos;
		}
	}


}

$Usuarios= new MiperfilController();


?>