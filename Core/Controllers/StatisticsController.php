<?php namespace Core\Controllers;
use Core\Models\Integrante as Integrante;
use Core\Models\Asistencia as Asistencia;

class StatisticsController{

	private $integrante;
	public function __construct(){
		$this->integrante = new Integrante();
		$this->asistencia = new Asistencia();
	}

	public function index(){


		if (empty($_SESSION['app_id'])) {
			header("Location:" . URL . "Integrantes");
		}else {
			$edad=$this->integrante->PromedioEdad();
			$hombres=$this->integrante->PromedioHombres();
			$mujeres=$this->integrante->PromedioMujeres();
			$asistencias=$this->asistencia->PromedioAsistencias();

			$datos = array(
				"edad" => $edad,
				"hombres" => $hombres,
				"mujeres" => $mujeres,
				"asistencias" => $asistencias,
				);
			return $datos;
		}
	}
}
$Asistencia= new StatisticsController();


?>