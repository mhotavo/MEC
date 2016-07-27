<?php namespace Core\Models;

class Asistencia  {
	private $id;
	private $fecha;
	private $asistencia;
	private $comentario;
	private $integrante;
	private $db;

	public function __construct(){
		$this->db = new Conexion();
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

	public function inasistentes($integrantes){
		//$integrantes=$this->integrante->listar();
		$datos=array();
		while($inte = mysqli_fetch_array($integrantes)){
			$sql="SELECT * FROM asistencia WHERE ID_INTEGRANTE = '".$inte['DOCUMENTO']."'  ORDER BY FECHA DESC LIMIT 3 ";
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


	private function listarFechas(){
		$datos=array();
		$sql="SELECT FECHA, COMENTARIO FROM asistencia ";
		if (!empty($this->fecha)) {
			$sql.="WHERE FECHA = '{$this->fecha}'  ";
		}
		$sql.=" GROUP BY FECHA ORDER BY FECHA ASC";
		$datos=$this->db->consultaRetorno($sql);
		return $datos;
	}


	public function verJSON($integrantes){
		
		$datos=array();
		while($inte = mysqli_fetch_assoc($integrantes)){
			foreach ($this->listarFechas() as $key => $value) {
				$sql="SELECT ID_INTEGRANTE, ASISTENCIA, COMENTARIO, FECHA  FROM asistencia WHERE FECHA = '".$value['FECHA']."' AND ID_INTEGRANTE='".$inte['DOCUMENTO']."' ";
				//echo "<br>";
				$data = $this->db->consultaRetorno($sql);
				$total= $this->db->total_rows($data);
				if ($total>0) {
					$row = mysqli_fetch_assoc($data);
					$datos[] = array('ID_INTEGRANTE' =>  $row['ID_INTEGRANTE'], 'ASISTENCIA' =>  $row['ASISTENCIA'], 'COMENTARIO' =>  $row['COMENTARIO'],'FECHA' =>  $row['FECHA']  );
				} else {
					$datos[] = array('ID_INTEGRANTE' =>  $inte['DOCUMENTO'], 'ASISTENCIA' =>  "", 'COMENTARIO' =>  "",'FECHA' =>  $value['FECHA']  );
				}
			}
		}
		return $datos;
	}	



	public function fechasJSON(){
		$sql="SELECT FECHA, COMENTARIO, SUM(asistencia) AS ASISTENCIAS, (COUNT(*)- SUM(asistencia)) as FALLAS, COUNT(*) AS TOTAL FROM asistencia GROUP BY FECHA ORDER BY FECHA DESC ";
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