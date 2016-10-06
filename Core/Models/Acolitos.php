<?php namespace Core\Models;

class Acolitos  {
	private $id;
	private $fecha;
	private $horario;
	private $integrante;
	private $dia;
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
		$sql="INSERT INTO horarios 
		(
		ID_INTEGRANTE,
		FECHA,
		HORARIO,
		DIA
		) 
		VALUES 
		(
		'{$this->integrante}', 
		'{$this->fecha}', 
		'{$this->horario}',
		'{$this->dia}'
		)
		ON DUPLICATE KEY UPDATE HORARIO='{$this->horario}',  DIA='{$this->dia}'  ;
		";  
		$this->db->consultaSimple($sql);

	}


	public function borrarFecha(){
		$sql="DELETE FROM horarios WHERE FECHA='{$this->fecha}' ";
		$this->db->consultaSimple($sql);
	}


	public function borrarRangoFechas(){
		$sql="DELETE FROM horarios WHERE FECHA>='{$this->fecha}' ";
		$this->db->consultaSimple($sql);
	}



	public function generarHorarioJSON(){
		$sql="SELECT h.*, CONCAT(i.NOMBRES, ' ', i.PRIMER_APELLIDO) as NOMBRE  
		FROM integrante i LEFT JOIN horarios h ON (i.DOCUMENTO=h.ID_INTEGRANTE)  
		WHERE i.ACOLITO='1' ";
		if (!empty($this->fecha)) {
			$sql.="AND h.FECHA = '{$this->fecha}'";
		} else{
			$sql.=" AND h.FECHA = (SELECT FECHA FROM horarios WHERE (DIA='{$this->dia}' OR DIA='NoAcolita') AND FECHA!='0000-00-00' AND FECHA<CURDATE() ORDER BY FECHA DESC LIMIT 1)";
		}
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