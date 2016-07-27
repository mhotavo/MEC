<?php namespace Core\Controllers;
use Core\Models\Integrante as Integrante;


class IntegrantesController{

	private $integrante;

	public function __construct(){
		$this->integrante = new Integrante();
	}

	public function index(){
		if (!empty($_SESSION['app_id'])) {
			#listar integrantes
			//echo $_SERVER['REMOTE_ADDR'];
			$datos=$this->integrante->listar();
			return $datos;
		}  else {
			header("Location:" . URL . "Integrantes");
		}


	}

	public function agregar(){
		if ($_POST) {
			$permitidos=array("image/jpeg", "image/png", "image/jpg");
			$limite = 700;
			if (in_array($_FILES['inputImagen']['type'], $permitidos) and $_FILES['inputImagen']['size']<= $limite*1024 ) 
			{
				$nombre = date("is") . $_FILES['inputImagen']['name'];
				$ruta= "HTML/Integrantes/avatars/" . $nombre;
				move_uploaded_file($_FILES['inputImagen']['tmp_name'], $ruta);					 
			} 
			else {
				$nombre = null;
			}
			$this->integrante->__set("nombres", ucwords(strtolower($_POST['inputNombres'])) );
			$this->integrante->__set("primerApellido", ucwords(strtolower($_POST['inputPrimerApellido'])) );
			$this->integrante->__set("segundoApellido", ucwords(strtolower($_POST['inputSegundoApellido'])) );
			$this->integrante->__set("fechaNacimiento", $_POST['inputFechaNacimiento']);
			$this->integrante->__set("direccion", $_POST['inputDireccion']);
			$this->integrante->__set("celular", $_POST['inputCelular']);
			$this->integrante->__set("correo", $_POST['inputEmail']);
			$this->integrante->__set("acolito", $_POST['Acolito']);
			$this->integrante->__set("coordinador", $_POST['Coordinador']);
			$this->integrante->__set("genero", $_POST['selectGenero']);
			$this->integrante->__set("fechaIngreso", $_POST['fechaIngreso']);
			$this->integrante->__set("imagen", $nombre);
			$this->integrante->add(); 
			header("Location:" . URL . "Integrantes");
		}
		

	}

	public function editar($id){
		if (!$_POST) {
			$this->integrante->__set("documento", $id);
			$data=$this->integrante->view();
			$datos = mysqli_fetch_assoc($data);
			return $datos;
		} else {
			$this->integrante->__set("documento", $_POST['Documento']);
			$this->integrante->__set("nombres", ucwords(strtolower($_POST['inputNombres'])) );
			$this->integrante->__set("primerApellido", ucwords(strtolower($_POST['inputPrimerApellido'])) );
			$this->integrante->__set("segundoApellido", ucwords(strtolower($_POST['inputSegundoApellido'])) );
			$this->integrante->__set("fechaNacimiento", $_POST['inputFechaNacimiento']);
			$this->integrante->__set("direccion", $_POST['inputDireccion']);
			$this->integrante->__set("celular", $_POST['inputCelular']);
			$this->integrante->__set("correo", $_POST['inputEmail']);
			$this->integrante->__set("acolito", $_POST['Acolito']);
			$this->integrante->__set("coordinador", $_POST['Coordinador']);
			$this->integrante->__set("genero", $_POST['selectGenero']);
			$this->integrante->__set("fechaIngreso", $_POST['fechaIngreso']);
			

			$permitidos=array("image/jpeg", "image/png", "image/jpg");
			$limite = 700;
			if (in_array($_FILES['inputImagen']['type'], $permitidos) and $limite>0 and $_FILES['inputImagen']['size']<= $limite*1024 ) {
				$nombre = date("is") . $_FILES['inputImagen']['name'];
				$ruta= "HTML/Integrantes/avatars/" . $nombre;
				move_uploaded_file($_FILES['inputImagen']['tmp_name'], $ruta);
				$this->integrante->__set("imagen", $nombre);	
			} else{
				$this->integrante->__set("imagen", $_POST['nombreImagen']);	
			}


			$this->integrante->edit();
			header("Location:" . URL . "Integrantes");

		}
	}

	public function ver($id){
		if (isset($id)) {
			$this->integrante->__set("documento", $id);
			$data=$this->integrante->view();
			$datos = mysqli_fetch_assoc($data);
			return $datos;
		}
		
	}

	public function eliminar($id){
		$this->integrante->__set("documento", $id);
		$data=$this->integrante->view();
		$datos = mysqli_fetch_assoc($data);
		$ruta= "HTML/Integrantes/avatars/" . $datos['IMAGEN'];
		if (file_exists($ruta) and $datos['IMAGEN']!='') {
			unlink($ruta);
		}
		$this->integrante->delete(); 
		header("Location:" . URL . "Integrantes");
	}

	public function listarJSON(){
		$datos=$this->integrante->listarJSON();
		echo json_encode( $datos, JSON_UNESCAPED_UNICODE );
	}

	public function listarAllJSON(){
		$this->integrante->__set("inasistentes", "si");
		$datos=$this->integrante->listarJSON();
		echo json_encode( $datos, JSON_UNESCAPED_UNICODE );
	}

	public function birthdayJSON(){
		$datos=$this->integrante->birthdayJSON();
		echo json_encode( $datos, JSON_UNESCAPED_UNICODE );
	}

}

$integrantes= new IntegrantesController();


?>