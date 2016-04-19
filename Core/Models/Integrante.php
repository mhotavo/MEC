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
			$sql="SELECT * FROM integrante";
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
		            IMAGEN ='{$this->imagen}'
		            WHERE DOCUMENTO='{$this->documento}';";
		       $this->db->consultaSimple($sql);
		  }

		 public function view(){
			$sql="SELECT * FROM integrante WHERE DOCUMENTO='{$this->documento}'";
			$row= $this->db->consultaRetorno($sql);			
			return $row;

		}



	} 


 ?>