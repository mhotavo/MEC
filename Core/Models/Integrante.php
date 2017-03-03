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

	/*public function listar(){
		$sql="SELECT * FROM integrante WHERE ESTADO!='NO-MEC' ORDER BY NOMBRES ASC, PRIMER_APELLIDO ASC ";
		$datos=$this->db->consultaRetorno($sql);
		return $datos;
	}*/

	public function listar(){
		$sql="SELECT *, 
		YEAR(CURDATE())-YEAR(FECHA_NACIMIENTO) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(FECHA_NACIMIENTO,'%m-%d'), 0, -1) AS EDAD_ACTUAL
		FROM integrante   ORDER BY ESTADO ASC, NOMBRES ASC ";
		$datos=$this->db->consultaRetorno($sql);
		return $datos;
	}


	public function listarOnlyMEC(){
		$sql="SELECT * FROM integrante WHERE ESTADO='ASISTENTE' ORDER BY NOMBRES ASC, PRIMER_APELLIDO ASC ";
		$datos=$this->db->consultaRetorno($sql);
		return $datos;
	}

	public function birthdayJSON(){
		$sql='SELECT DOCUMENTO, CONCAT(NOMBRES, " ", PRIMER_APELLIDO) AS NOMBRE, 
		(TIMESTAMPDIFF(YEAR, FECHA_NACIMIENTO, CURDATE()))+1 AS EDAD , 
		DATE_FORMAT(FECHA_NACIMIENTO, "'.date('Y').'-%m-%d") AS BIRTHDAY, 
		ESTADO,
		DATE_FORMAT(FECHA_NACIMIENTO,"%m") AS MES,
		TIMESTAMPDIFF(DAY,  CURDATE(), DATE_FORMAT(FECHA_NACIMIENTO, "'.date('Y').'-%m-%d")) AS FALTAN
		FROM integrante 
		HAVING BIRTHDAY >= CURDATE() 
		AND ESTADO!="NO-MEC" 
		ORDER BY MONTH(FECHA_NACIMIENTO),DAY(FECHA_NACIMIENTO)';
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



	# =====================================  STATISTICS =======================================================
	public function LongevoJSON(){
		$sql='SELECT DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(FECHA_NACIMIENTO)), "%Y")+0 AS EDAD, CONCAT(NOMBRES, " " ,PRIMER_APELLIDO)AS NOMBRES FROM integrante  WHERE ESTADO ="ASISTENTE" AND COORDINADOR=0
		ORDER BY EDAD  DESC LIMIT 3';
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

	public function JovenJSON(){
		$sql='SELECT DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(FECHA_NACIMIENTO)), "%Y")+0 AS EDAD, CONCAT(NOMBRES, " " ,PRIMER_APELLIDO) AS NOMBRES FROM integrante  WHERE ESTADO ="ASISTENTE" AND COORDINADOR=0 ORDER BY EDAD  ASC LIMIT 3';		
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


	public function MasParticipativoJSON(){
		$datos=array();
		$max=0;
		#Creamos Array 
		foreach ( $this->listarOnlyMEC() as $key => $value) {
			$sql='SELECT COUNT(*) AS TOTAL, ID_INTEGRANTE, CONCAT(i.NOMBRES, " " ,i.PRIMER_APELLIDO) AS NOMBRES   FROM asistencia INNER JOIN integrante i ON (ID_INTEGRANTE=i.DOCUMENTO)  WHERE ID_INTEGRANTE = "'.$value['DOCUMENTO'].'" AND FECHA>"2017-01-01" AND ASISTENCIA=1 '; 
			$data = $this->db->consultaRetorno($sql);
			$total= $this->db->total_rows($data);
			if ($total>0  ) {
				while ($row = mysqli_fetch_assoc($data)) {
					#Maximo de asistencia
					if ($max==0 OR $max<$row['TOTAL']) {
						$max=$row['TOTAL'];
					}  
					#Agregamos al Array
					if ($row['ID_INTEGRANTE']!="") {
						$datos[]=$row;
					} 
				}
			}
		}  
		#Eliminamos del array los de menor asistencia
		foreach ($datos as $key => $value) {
			if ($value['TOTAL']!=$max) {
				unset($datos[$key]);
			}
		}

		return $datos;
	}

	public function MenosParticipativoJSON(){
		$datos=array();
		$menor=0;
		#Creamos Array 
		foreach ( $this->listarOnlyMEC() as $key => $value) {
			$sql='SELECT COUNT(*) AS TOTAL, ID_INTEGRANTE, CONCAT(i.NOMBRES, " " ,i.PRIMER_APELLIDO) AS NOMBRES   FROM asistencia INNER JOIN integrante i ON (ID_INTEGRANTE=i.DOCUMENTO)  WHERE ID_INTEGRANTE = "'.$value['DOCUMENTO'].'" AND FECHA>"2017-01-01" AND ASISTENCIA=0 '; 
			$data = $this->db->consultaRetorno($sql);
			$total= $this->db->total_rows($data);
			if ($total>0  ) {
				while ($row = mysqli_fetch_assoc($data)) {

					#menor de asistencia
					if ($menor==0 OR $menor<$row['TOTAL']) {
						$menor=$row['TOTAL']-1;
					}  
					#Agregamos al Array
					if ($row['ID_INTEGRANTE']!="") {
						$datos[]=$row;
					} 
				}
			}
		}  
		#Eliminamos del array los de menor asistencia
		
		foreach ($datos as $key => $value) {
			if ($value['TOTAL']<$menor) {
				unset($datos[$key]);
			}
		}

		return $datos;
	}



	public function PromedioEdad(){
		$sql="SELECT 
		AVG(YEAR(CURDATE())-YEAR(FECHA_NACIMIENTO) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(FECHA_NACIMIENTO,'%m-%d'), 0, -1)) AS PROMEDIO_EDAD 
		FROM integrante WHERE ESTADO != 'NO-MEC' ";		
		$data=  $this->db->consultaRetorno($sql);
		$row = mysqli_fetch_assoc($data);
		$datos = $row['PROMEDIO_EDAD'];
		return $datos;
	}

	public function PromedioMujeres(){
		$sql="SELECT  COUNT(*) AS MUJERES
		FROM integrante WHERE ESTADO != 'NO-MEC' AND GENERO='F' ";		
		$data=  $this->db->consultaRetorno($sql);
		$row = mysqli_fetch_assoc($data);
		$datos = $row['MUJERES'];
		return $datos;
	}

	public function PromedioHombres(){
		$sql="SELECT  COUNT(*) AS HOMBRES
		FROM integrante WHERE ESTADO != 'NO-MEC' AND GENERO='M' ";		
		$data=  $this->db->consultaRetorno($sql);
		$row = mysqli_fetch_assoc($data);
		$datos = $row['HOMBRES'];
		return $datos;
	}


	


} 


?>