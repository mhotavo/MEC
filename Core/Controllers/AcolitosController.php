<?php namespace Core\Controllers;
use Core\Models\Acolitos as Acolitos;
use Core\Models\Integrante as Integrante;


class AcolitosController{

	private $Acolitos;

	public function __construct(){
		$this->Acolitos = new Acolitos();
		$this->Integrante = new Integrante();

	}
	public function index(){
		if (!empty($_SESSION['app_id'])) {
			if ($_POST) {
				$datos=$this->Integrante->acolitos();
				while($row = mysqli_fetch_array($datos)){
					$id=$row['DOCUMENTO'];
					$this->Acolitos->__set("fecha", $_POST['fecha']);
					$this->Acolitos->__set("horario",  $_POST['misa_'.$id]);
					$this->Acolitos->__set("integrante", $id);
					$this->Acolitos->add(); 
				}
				header("Location:" . URL . "Acolitos");
			}else {
			#listar Acolitos
				$datos=$this->Integrante->acolitos();
				return $datos;
			}
		}else {
			header("Location:" . URL . "Integrantes");
		}
		
	}


	public function dominical(){
		if ($_POST) {
			$this->Acolitos->__set("documentoIntegrante", $_POST['integrante']);
			$this->Acolitos->__set("nombres", ucwords(strtolower($_POST['inputNombres'])) );
			$this->Acolitos->__set("primerApellido", ucwords(strtolower($_POST['inputPrimerApellido'])) )  ;
			$this->Acolitos->__set("segundoApellido", ucwords(strtolower($_POST['inputSegundoApellido'])) );
			$this->Acolitos->__set("direccion", $_POST['inputDireccion']);
			$this->Acolitos->__set("celular", $_POST['inputCelular']);
			$this->Acolitos->__set("parentesco", $_POST['parentesco']);
			$this->Acolitos->add();
			header("Location:" . URL . "Acolitoses");
		} else{
			$datos = $this->Integrante->listar(); 
			return $datos;
		}


	}
	public function listarIntegrante(){
		$datos = $this->Integrante->listar(); 
		return $datos;
	}

	public function editar($id){
		if (!$_POST) {
			$this->Acolitos->__set("documento", $id);
			$datos=$this->Acolitos->view();
			return $datos;
		} else {
			$this->Acolitos->__set("documentoIntegrante", $_POST['integrante']);
			$this->Acolitos->__set("nombres", ucwords(strtolower($_POST['inputNombres'])) );
			$this->Acolitos->__set("primerApellido", ucwords(strtolower($_POST['inputPrimerApellido'])) )  ;
			$this->Acolitos->__set("segundoApellido", ucwords(strtolower($_POST['inputSegundoApellido'])) );
			$this->Acolitos->__set("direccion", $_POST['inputDireccion']);
			$this->Acolitos->__set("celular", $_POST['inputCelular']);
				 #	$this->Acolitos->__set("correo", $_POST['inputEmail']);
			$this->Acolitos->__set("parentesco", $_POST['parentesco']);
			$this->Acolitos->__set("documento", $_POST['Documento']);
			$this->Acolitos->edit();   
			header("Location:" . URL . "Acolitoses");

		}
	}

	public function ver($id){
		$this->Acolitos->__set("documento", $id);
		$datos=$this->Acolitos->view();
		return $datos;
	}

	public function eliminar($id){
		$this->Acolitos->__set("documento", $id);
		$this->Acolitos->delete(); 
		header("Location:" . URL . "Acolitoses");
	}					


}

$Acolitoses= new AcolitosController();


?>