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
			$sql="SELECT * FROM integrante ORDER BY DOCUMENTO ASC ";
			$datos=$this->db->consultaRetorno($sql);
			return $datos;
		}

		public function add(){
			$sql="INSERT INTO integrante 
					(DOCUMENTO,
					 NOMBRES,
					 PRIMER_APELLIDO, 
					 SEGUNDO_APELLIDO, 
					 FECHA_NACIMIENTO, 
					 DIRECCION, 
					 CELULAR, 
					 CORREO, 
					 ACOLITO,
					 COORDINADOR,
					 IMAGEN) 
				VALUES 
					(NULL, 
					'{$this->nombres}', 
					'{$this->primerApellido}', 
					'{$this->segundoApellido}', 
					'{$this->fechaNacimiento}', 
					'{$this->direccion}', 
					'{$this->celular}', 
					'{$this->correo}', 
					'{$this->acolito}',
					'{$this->coordinador}',
					'{$this->imagen}'); ";
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
		            FECHA_NACIMIENTO ='{$this->fechaNacimiento}',
		            DIRECCION ='{$this->direccion}',
		            CELULAR ='{$this->celular}',
		            CORREO ='{$this->correo}',
		            ACOLITO ='{$this->acolito}',
		            COORDINADOR ='{$this->coordinador}',
		            IMAGEN ='{$this->imagen}'
		            WHERE DOCUMENTO='{$this->documento}';";
		       $this->db->consultaSimple($sql);
		  }

		 public function view(){
			$sql="SELECT i.*, YEAR(CURDATE())-YEAR(i.FECHA_NACIMIENTO) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(i.FECHA_NACIMIENTO,'%m-%d'), 0, -1) AS EDAD_ACTUAL FROM integrante i WHERE DOCUMENTO='{$this->documento}'";
			$datos = $this->db->consultaRetorno($sql);
			$row = mysqli_fetch_assoc($datos);
			return $row;
		}



	} 


 ?>