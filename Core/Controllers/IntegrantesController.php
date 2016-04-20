<?php namespace Core\Controllers;
	use Core\Models\Integrante as Integrante;


	class IntegrantesController{

		private $integrante;

		public function __construct(){
			$this->integrante = new Integrante();
		}

		public function index(){
			#listar integrantes
			$datos=$this->integrante->listar();
			return $datos;

		}

		public function agregar(){
 

		}
	}
	$integrantes= new IntegrantesController();
	
 
?>