<?php namespace Core\Models;

class Integrante {
	private $documento;
	private $nombres;
	private $primerApellido;
	private $segundoApellido;
	private $fechaNacimiento;
	private $direccion;
	private $celular;
	private $correo;
	private $acolito;
	private $imagen;
	private $coordinador;
	private $genero;
	private $inasistentes;
	private $fechaIngreso;
	private $dia;
	private $estado;
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


	public function acolitos(){
		$sql="SELECT * FROM integrante WHERE ACOLITO='1' ORDER BY NOMBRES ASC, PRIMER_APELLIDO ASC ";
		$datos=$this->db->consultaRetorno($sql);
		return $datos;
	}

	public function listar(){
		$sql="SELECT * FROM integrante /*WHERE ESTADO!='NO-MEC'*/ ORDER BY NOMBRES ASC, PRIMER_APELLIDO ASC ";
		$datos=$this->db->consultaRetorno($sql);
		return $datos;
	}

	public function birthdayJSON(){
		$sql='SELECT *, (TIMESTAMPDIFF(YEAR, FECHA_NACIMIENTO, CURDATE()))+1 AS EDAD FROM integrante WHERE DATE_FORMAT(FECHA_NACIMIENTO, "%m-%d") >= DATE_FORMAT(CURDATE(), "%m-%d")     ORDER BY MONTH(FECHA_NACIMIENTO),DAY(FECHA_NACIMIENTO)';
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

	public function add(){
		$sql="INSERT INTO integrante 
		(DOCUMENTO,
		NOMBRES,
		PRIMER_APELLIDO, 
		SEGUNDO_APELLIDO, 
		GENERO, 
		FECHA_NACIMIENTO, 
		DIRECCION, 
		CELULAR, 
		CORREO, 
		ACOLITO,
		COORDINADOR,
		IMAGEN,
		FECHA_INGRESO,
		ESTADO) 
		VALUES 
		(NULL, 
		'{$this->nombres}', 
		'{$this->primerApellido}', 
		'{$this->segundoApellido}', 
		'{$this->genero}', 
		'{$this->fechaNacimiento}', 
		'{$this->direccion}', 
		'{$this->celular}', 
		'{$this->correo}', 
		'{$this->acolito}',
		'{$this->coordinador}',
		'{$this->imagen}',
		'{$this->fechaIngreso}',
		'{$this->estado}'

		); ";
		$this->db->consultaSimple($sql);

	}

	public function delete(){
		$sql="DELETE FROM asistencia WHERE ID_INTEGRANTE='{$this->documento}'";
		$this->db->consultaSimple($sql);
		$sql="DELETE FROM integrante WHERE DOCUMENTO='{$this->documento}'";
		$this->db->consultaSimple($sql);

	}

	public function edit() {
		$sql="UPDATE integrante SET 
		NOMBRES='{$this->nombres}',
		PRIMER_APELLIDO ='{$this->primerApellido}',
		SEGUNDO_APELLIDO ='{$this->segundoApellido}',
		GENERO ='{$this->genero}',
		FECHA_NACIMIENTO ='{$this->fechaNacimiento}',
		DIRECCION ='{$this->direccion}',
		CELULAR ='{$this->celular}',
		CORREO ='{$this->correo}',
		ACOLITO ='{$this->acolito}',
		COORDINADOR ='{$this->coordinador}',
		IMAGEN ='{$this->imagen}',
		FECHA_INGRESO ='{$this->fechaIngreso}',
		ESTADO ='{$this->estado}'
		WHERE DOCUMENTO='{$this->documento}';";
		$this->db->consultaSimple($sql);  
	}

	public function view(){
		$sql="SELECT i.*, YEAR(CURDATE())-YEAR(i.FECHA_NACIMIENTO) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(i.FECHA_NACIMIENTO,'%m-%d'), 0, -1) AS EDAD_ACTUAL FROM integrante i WHERE DOCUMENTO='{$this->documento}'";
		$datos = $this->db->consultaRetorno($sql);
		//$row = mysqli_fetch_assoc($datos);
		return $datos;
	}

	public function listarJSON(){
		$sql="SELECT DOCUMENTO, CONCAT(NOMBRES, ' ', PRIMER_APELLIDO) as NOMBRE FROM integrante";
		if ($this->inasistentes!='si') {
			$sql.=" WHERE ESTADO ='ASISTENTE' ";
		}
		$sql.=" ORDER BY NOMBRE ASC ";
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

	public function AcolitosJSON(){
		$sql="SELECT h.*, CONCAT(i.NOMBRES, ' ', i.PRIMER_APELLIDO) as NOMBRE  FROM integrante i LEFT JOIN horarios h ON (i.DOCUMENTO=h.ID_INTEGRANTE)  WHERE i.ACOLITO='1' AND h.FECHA>=CURDATE() AND h.DIA='{$this->dia}' ";
		$sql.=" ORDER BY NOMBRE ASC ";
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