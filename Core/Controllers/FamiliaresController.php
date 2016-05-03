<?php namespace Core\Controllers;
	use Core\Models\Familiar as Familiar;
	use Core\Models\Integrante as Integrante;


	class FamiliaresController{

		private $Familiar;

		public function __construct(){
			$this->Familiar = new Familiar();
			$this->Integrante = new Integrante();
			
		}

		public function index(){
			#listar Familiares
			$datos=$this->Familiar->listar();
			return $datos;

		}

		public function agregar(){
			if ($_POST) {
					$this->Familiar->__set("documentoIntegrante", $_POST['integrante']);
					$this->Familiar->__set("nombres", ucwords(strtolower($_POST['inputNombres'])) );
				 	$this->Familiar->__set("primerApellido", ucwords(strtolower($_POST['inputPrimerApellido'])) )  ;
				 	$this->Familiar->__set("segundoApellido", ucwords(strtolower($_POST['inputSegundoApellido'])) );
				 	$this->Familiar->__set("direccion", $_POST['inputDireccion']);
				 	$this->Familiar->__set("celular", $_POST['inputCelular']);
				 	$this->Familiar->__set("correo", $_POST['inputEmail']);
				 	$this->Familiar->__set("parentesco", $_POST['parentesco']);
				 	$this->Familiar->add();
				 	header("Location:" . URL . "Familiares");
			} else{
			$datos = $this->Integrante->listar(); 
 			return $datos;
			}
 			

		}

		public function editar($id){
			if (!$_POST) {
				$this->Familiar->__set("documento", $id);
				$datos=$this->Familiar->view();
				return $datos;
			} else {
				$this->Familiar->__set("documento", ucwords(strtolower($_POST['Documento'])) );
				$this->Familiar->__set("nombres", ucwords(strtolower($_POST['inputNombres'])) );
			 	$this->Familiar->__set("primerApellido", ucwords(strtolower($_POST['inputPrimerApellido'])) );
			 	$this->Familiar->__set("segundoApellido", $_POST['inputSegundoApellido']);
			 	$this->Familiar->__set("fechaNacimiento", $_POST['inputFechaNacimiento']);
			 	$this->Familiar->__set("direccion", $_POST['inputDireccion']);
			 	$this->Familiar->__set("celular", $_POST['inputCelular']);
			 	$this->Familiar->__set("correo", $_POST['inputEmail']);
			 	$this->Familiar->__set("acolito", $_POST['Acolito']);
			 	$this->Familiar->__set("coordinador", $_POST['Coordinador']);
			 	

		 		$permitidos=array("image/jpeg", "image/png", "image/jpg");
				$limite = 700;
				if (in_array($_FILES['inputImagen']['type'], $permitidos) and $limite>0 and $_FILES['inputImagen']['size']<= $limite*1024 ) {
				 	$nombre = date("is") . $_FILES['inputImagen']['name'];
				 	$ruta= "HTML/Familiares/avatars/" . $nombre;
				 	move_uploaded_file($_FILES['inputImagen']['tmp_name'], $ruta);
				 	$this->Familiar->__set("imagen", $nombre);	
				 } else{
					 $this->Familiar->__set("imagen", $_POST['nombreImagen']);	
				 }


				$this->Familiar->edit();
				header("Location:" . URL . "Familiares");

			}
		}

		public function ver($id){
				$this->Familiar->__set("documento", $id);
				$datos=$this->Familiar->view();
				return $datos;
		}

		public function eliminar($id){
				$this->Familiar->__set("documento", $id);
				$datos=$this->Familiar->view();
				$ruta= "HTML/Familiares/avatars/" . $datos['IMAGEN'];
				if (file_exists($ruta) and $datos['IMAGEN']!='') {
					unlink($ruta);
				}
				$this->Familiar->delete(); 
				header("Location:" . URL . "Familiares");
		}					


	}

	$Familiares= new FamiliaresController();
	
 
?>