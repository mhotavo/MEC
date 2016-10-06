<?php namespace Core\Controllers;
use Core\Models\Acolitos as Acolitos;
use Core\Models\Integrante as Integrante;


class AcolitosController{

	private $Acolitos;

	public function __construct(){
		$this->Acolitos = new Acolitos();
		$this->Integrante = new Integrante();

	}


	public function dominical(){
		if (!empty($_SESSION['app_id'])) {
			if ($_POST) {
				$datos=$this->Integrante->acolitos();
				while($row = mysqli_fetch_array($datos)){
					$id=$row['DOCUMENTO'];
					$this->Acolitos->__set("fecha", $_POST['fecha']);
					$this->Acolitos->__set("horario",  $_POST['misa_'.$id]);
					$this->Acolitos->__set("integrante", $id);
					$this->Acolitos->__set("dia", "Domingo");
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


	public function semanal(){
		if (!empty($_SESSION['app_id'])) {
			if ($_POST) {
				$datos=$this->Integrante->acolitos();
				while($row = mysqli_fetch_array($datos)){
					$id=$row['DOCUMENTO'];
					$this->Acolitos->__set("fecha", $_POST['fecha_'.$id]);
					$this->Acolitos->__set("horario", "06:30PM"  );
					$this->Acolitos->__set("integrante", $id);
					$this->Acolitos->__set("dia", $_POST['misa_'.$id] );
					$this->Acolitos->add(); 
				} 
				header("Location:" . URL . "Acolitos");
			}else {
			#listar Acolitos
				$datos=$this->Integrante->acolitos();
				return $datos;
			}
		}else {
			header("Location:" . URL . "acolitos");
		}
		
	}



	public function borrarFecha(){
		if (!empty($_SESSION['app_id'])) {
			if (isset($_GET['fecha']) and !empty($_GET['fecha']) ) {
				$this->Acolitos->__set("fecha", $_GET['fecha']);
				$datos=$this->Acolitos->borrarFecha();
			}else {
				header("Location:" . URL . "acolitos");
			}
		}else {
			header("Location:" . URL . "acolitos");
		}
		
	}


	public function borrarRangoFechas(){
		if (!empty($_SESSION['app_id'])) {
			if (isset($_GET['fecha']) and !empty($_GET['fecha']) ) {
				$this->Acolitos->__set("fecha", $_GET['fecha']);
				$datos=$this->Acolitos->borrarRangoFechas();
			}else {
				header("Location:" . URL . "acolitos");
			}
		}else {
			header("Location:" . URL . "acolitos");
		}
		
	}

	public function generarHorarioJSON(){
		if (!empty($_GET['dia'])) {
			$this->Acolitos->__set("dia", $_GET['dia']);
		}
		if (!empty($_GET['fecha'])) {
			$this->Acolitos->__set("fecha", $_GET['fecha']);
		}
		
		$datos=$this->Acolitos->generarHorarioJSON();
		echo json_encode( $datos, JSON_UNESCAPED_UNICODE );
	}
}

$Acolitoses= new AcolitosController();


?>