<?php namespace Core\Controllers;
use Core\Models\Integrante as Integrante;
use Core\Models\Asistencia as Asistencia;
use Views\template as Template;


class AsistenciaController{

	private $integrante;
	private $asistencia;
	public function __construct(){
		$this->integrante = new Integrante();
		$this->asistencia = new Asistencia();
	}

	public function index(){
		if ($_POST) {
			$datos=$this->integrante->listar();
			while($row = mysqli_fetch_array($datos)){
				$id=$row['DOCUMENTO'];
				$this->asistencia->__set("fecha", $_POST['fechaAsistencia']);
				$this->asistencia->__set("integrante",  $_POST['documento_'.$id]);
				$this->asistencia->__set("asistencia", $_POST['asistencia_'.$id] );
				$this->asistencia->add(); 
			}
			header("Location:" . URL . "asistencia");
		}else {
			#listar Asistencia
			$this->template = new Template();
			$this->template->dataTable();
			$datos=$this->integrante->listar();
			return $datos;
		}
	}





}

$Asistencia= new AsistenciaController();


?>