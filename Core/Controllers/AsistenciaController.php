<?php namespace Core\Controllers;
use Core\Models\Integrante as Integrante;
use Core\Models\Asistencia as Asistencia;


class AsistenciaController{

	private $integrante;
	private $asistencia;
	public function __construct(){
		$this->integrante = new Integrante();
		$this->asistencia = new Asistencia();
	}

	public function index(){
		if (!empty($_SESSION['app_id'])) {
			if ($_POST) {
				$datos=$this->integrante->listar();
				while($row = mysqli_fetch_array($datos)){
					$id=$row['DOCUMENTO'];
					$this->asistencia->__set("fecha", $_POST['fechaAsistencia']);
					$this->asistencia->__set("integrante",  $_POST['documento_'.$id]);
					$this->asistencia->__set("asistencia", $_POST['asistencia_'.$id] );
					$this->asistencia->__set("comentario", $_POST['comentario'] );
					$this->asistencia->add(); 
				}
				
				header("Location:" . URL . "asistencia");
			}else {
			#listar Integrantes
				$datos=$this->integrante->listar();
				return $datos;
			}
		}else {
			header("Location:" . URL . "Integrantes");
		}
		
	}

	public function inasistentes(){
		if (!empty($_SESSION['app_id'])) {
			#listar integrantes
			//echo $_SERVER['REMOTE_ADDR'];
			$datos=$this->asistencia->inasistentes();
			return $datos;
		}  else {
			header("Location:" . URL . "Integrantes");
		}


	}
	public function verJSON(){
		if (!empty($_GET['fecha'])) {
			$this->asistencia->__set("fecha", $_GET['fecha']);
			$datos=$this->asistencia->verJSON(); 
			echo json_encode( $datos, JSON_UNESCAPED_UNICODE );

		} 

	}	
	public function fechasJSON(){
		$datos=$this->asistencia->fechasJSON(); 
		echo json_encode( $datos, JSON_UNESCAPED_UNICODE );
	}	
}

$Asistencia= new AsistenciaController();


?>