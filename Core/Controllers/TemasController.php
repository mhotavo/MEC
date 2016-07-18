<?php namespace Core\Controllers;
use Core\Models\Tema as Tema;


class TemasController{

	private $Tema;

	public function __construct(){
		$this->Tema = new Tema();
	}

	public function index(){
		if (!empty($_SESSION['app_id'])) {
			$datos=$this->Tema->listar();
			return $datos;
		}  else {
			header("Location:" . URL . "Integrantes");
		}
	}

	public function agregar(){
		if ($_POST) {
			$this->Tema->__set("tema", $_POST['inputTema']);
			$this->Tema->__set("descripcion", $_POST['inputDescripcion']);
			$this->Tema->__set("fecha", $_POST['inputFecha']);
			$this->Tema->__set("usuario", $_SESSION['app_id']);
			$this->Tema->add(); 
			header("Location:" . URL . "Temas");
		} 

	}

	public function editar($id){
		if (!$_POST) {
			$this->Tema->__set("idTema", $id);
			$datos=$this->Tema->view();
			return $datos;
		} else {
			$this->Tema->__set("idTema", $_POST['inputId']);
			$this->Tema->__set("tema", $_POST['inputTema']);
			$this->Tema->__set("descripcion", $_POST['inputDescripcion']);
			$this->Tema->__set("fecha", $_POST['inputFecha']);
			$this->Tema->__set("usuario", $_SESSION['app_id']);
			$this->Tema->edit();   
			header("Location:" . URL . "Temas");

		}
	}

	public function ver($id){
		$this->Tema->__set("idTema", $id);
		$datos=$this->Tema->view();
		return $datos;
	}

	public function eliminar($id){
		$this->Tema->__set("idTema", $id);
		$this->Tema->delete(); 
		header("Location:" . URL . "Temas");
	}					


}

$Temas= new TemasController();


?>