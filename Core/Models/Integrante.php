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
	private $fechaIngreso;
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


	public function listar(){
		$sql="SELECT * FROM integrante ORDER BY NOMBRES ASC, PRIMER_APELLIDO ASC ";
		$datos=$this->db->consultaRetorno($sql);
		return $datos;
	}

	public function birthdayJSON(){
		// $sql="SELECT * FROM integrante WHERE MONTH(FECHA_NACIMIENTO) = MONTH(DATE_ADD(CURDATE(),INTERVAL 1 MONTH)) OR MONTH(FECHA_NACIMIENTO) = MONTH(CURDATE()) AND DAY( FECHA_NACIMIENTO ) > DAY(CURDATE())  ";
		$sql="SELECT *, (TIMESTAMPDIFF(YEAR, FECHA_NACIMIENTO, CURDATE()))+1 AS EDAD FROM integrante WHERE MONTH(FECHA_NACIMIENTO) >= MONTH(CURDATE()) AND DAY(FECHA_NACIMIENTO) >= DAY(CURDATE()) ORDER BY MONTH(FECHA_NACIMIENTO),DAY(FECHA_NACIMIENTO)";
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
		FECHA_INGRESO) 
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
		'{$this->fechaIngreso}'

		); ";
		$this->db->consultaSimple($sql);

	}

	public function delete(){
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
		FECHA_INGRESO ='{$this->fechaIngreso}'
		WHERE DOCUMENTO='{$this->documento}';";
		$this->db->consultaSimple($sql);
	}

	public function view(){
		$sql="SELECT i.*, YEAR(CURDATE())-YEAR(i.FECHA_NACIMIENTO) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(i.FECHA_NACIMIENTO,'%m-%d'), 0, -1) AS EDAD_ACTUAL FROM integrante i WHERE DOCUMENTO='{$this->documento}'";
		$datos = $this->db->consultaRetorno($sql);
		$row = mysqli_fetch_assoc($datos);
		return $row;
	}

	public function listarJSON(){
		$sql="SELECT DOCUMENTO, CONCAT(NOMBRES, ' ', PRIMER_APELLIDO) as NOMBRE FROM integrante WHERE ESTADO !='INASISTENTE' ORDER BY NOMBRE ASC ";
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