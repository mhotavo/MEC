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

	



} 


?>