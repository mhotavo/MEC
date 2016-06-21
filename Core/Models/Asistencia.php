<?php namespace Core\Models;

class Asistencia {
	private $id;
	private $fecha;
	private $integrante;
	private $asistencia;
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
		(ID,
		FECHA,
		ID_INTEGRANTE,
		ASISTENCIA 
		) 
		VALUES 
		(NULL, 
		'{$this->fecha}', 
		'{$this->integrante}', 
		'{$this->asistencia}'); ";
		$this->db->consultaSimple($sql);

	}

	public function ver(){
		$sql="SELECT ID_INTEGRANTE, ASISTENCIA  FROM asistencia WHERE FECHA = '{$this->fecha}'  ORDER BY ID_INTEGRANTE ASC ";
		$data = $this->db->consultaRetorno($sql);
		$total= $this->db->total_rows($data);
		$datos=array();
		if ($total>0) {
			while ($row = mysqli_fetch_assoc($data)) {
				$datos[]=$row;
			}
		} else {
			$this->integrante = new Integrante();
			$lista=$this->integrante->listar();
			while ($row = mysqli_fetch_assoc($lista)) {
				$datos[]=$row['DOCUMENTO'];
			}

		}
		return $datos;
	}



} 


?>