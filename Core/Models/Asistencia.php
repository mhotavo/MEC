<?php namespace Core\Models;

class Asistencia   {
	private $id;
	private $fecha;
	private $integrante;
	private $asistencia;
	private $comentario;
	private $db;

	public function __construct(){
		$this->db = new Conexion();
		$this->integrante = new Integrante();
	}

	public function __set($var, $valor) {  
		if (property_exists(__CLASS__, $var)) {  
			$this->$var = $valor;  
		} else {  
			echo "No existe el atributo $var.";  
		}  
	}  

	public function __get($var) {  
		if (property_exists(__CLASS__, $var)) {  
			return $this->$var;  
		}  
		return NULL;  
	}  

	public function add(){
		$sql="INSERT INTO asistencia 
		(
		ID_INTEGRANTE,
		FECHA,
		ASISTENCIA,
		COMENTARIO
		) 
		VALUES 
		(
		'{$this->integrante}', 
		'{$this->fecha}', 
		'{$this->asistencia}',
		'{$this->comentario}'
		)
		ON DUPLICATE KEY UPDATE ASISTENCIA='{$this->asistencia}', COMENTARIO='{$this->comentario}' ;
		";  
		$this->db->consultaSimple($sql);

	}

	public function inasistentes(){
		
		$integrantes=$this->integrante->listar();
		$datos=array();
		while($inte = mysqli_fetch_array($integrantes)){
			$sql="SELECT * FROM asistencia WHERE ID_INTEGRANTE = '".$inte['DOCUMENTO']."'  ORDER BY FECHA DESC LIMIT 4 ";
			$asistencias=$this->db->consultaRetorno($sql);
			$totalAsistencias=$this->db->total_rows($asistencias);
			$fallas=0;
			if ($totalAsistencias>0) {
				while($row = mysqli_fetch_array($asistencias)){
					if ($row['ASISTENCIA']=='0') {
						$fallas=$fallas+1;
					}
				}
				if ($fallas==$totalAsistencias) {
					//$datos[$inte['DOCUMENTO']] = $fallas;
					$datos[]=array(
					'Documento'=>$inte['DOCUMENTO'],
					'Nombre'=>$inte['NOMBRES'] . " " . $inte['PRIMER_APELLIDO'] ,
					'Estado'=>'Suspendido'
					);
					$sql="UPDATE integrante SET ESTADO ='INASISTENTE'  WHERE DOCUMENTO = '".$inte['DOCUMENTO']."'  ";
					$asistencias=$this->db->consultaSimple($sql);
				} else {
					$sql="UPDATE integrante SET ESTADO ='ASISTENTE'  WHERE DOCUMENTO = '".$inte['DOCUMENTO']."'  ";
					$asistencias=$this->db->consultaSimple($sql);
				}

			}
		}
		//print_r($datos);
		return $datos;
	}


	public function verJSON(){
		$sql="SELECT ID_INTEGRANTE, ASISTENCIA, COMENTARIO  FROM asistencia WHERE FECHA = '{$this->fecha}'  ORDER BY ID_INTEGRANTE ASC ";
		$data = $this->db->consultaRetorno($sql);
		$total= $this->db->total_rows($data);
		$datos=array();
		if ($total>0) {
			while ($row = mysqli_fetch_assoc($data)) {
				$datos[]=$row;
			}
		}  
		return $datos;
	}	

	public function fechasJSON(){
		$sql="SELECT FECHA, COMENTARIO FROM asistencia GROUP BY FECHA ORDER BY FECHA DESC LIMIT 3";
		$data = $this->db->consultaRetorno($sql);
		$total= $this->db->total_rows($data);
		$datos=array();
		if ($total>0) {
			while ($row = mysqli_fetch_assoc($data)) {
				$datos[]=$row;
			}
		}  
		return $datos;
	}




} 


?>