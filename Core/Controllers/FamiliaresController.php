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
				 #	$this->Familiar->__set("correo", $_POST['inputEmail']);
				 	$this->Familiar->__set("parentesco", $_POST['parentesco']);
				 	$this->Familiar->add();
				 	header("Location:" . URL . "Familiares");
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
				$this->Familiar->__set("documento", $id);
				$datos=$this->Familiar->view();
				return $datos;
			} else {
					$this->Familiar->__set("documentoIntegrante", $_POST['integrante']);
					$this->Familiar->__set("nombres", ucwords(strtolower($_POST['inputNombres'])) );
				 	$this->Familiar->__set("primerApellido", ucwords(strtolower($_POST['inputPrimerApellido'])) )  ;
				 	$this->Familiar->__set("segundoApellido", ucwords(strtolower($_POST['inputSegundoApellido'])) );
				 	$this->Familiar->__set("direccion", $_POST['inputDireccion']);
				 	$this->Familiar->__set("celular", $_POST['inputCelular']);
				 #	$this->Familiar->__set("correo", $_POST['inputEmail']);
				 	$this->Familiar->__set("parentesco", $_POST['parentesco']);
				 	$this->Familiar->__set("documento", $_POST['Documento']);
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
				$this->Familiar->delete(); 
				header("Location:" . URL . "Familiares");
		}					


	}

	$Familiares= new FamiliaresController();
	
 
?>