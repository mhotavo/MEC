<?php namespace Core\Models;

	class Familiar {
		private $documento;
		private $documentoIntegrante;
		private $nombres;
		private $primerApellido;
		private $segundoApellido;
		private $parentesco;
		private $celular;
		private $direccion;	
		private $correo;	
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
			$sql="SELECT * FROM familiar";
			$datos=$this->db->consultaRetorno($sql);
			return $datos;
		}

		public function add(){
			echo $sql="INSERT INTO familiar 
					(DOCUMENTO,
					 IDENTIFICACION_INTEGRANTE,
					 NOMBRES,
					 PRIMER_APELLIDO, 
					 SEGUNDO_APELLIDO, 
					 PARENTESCO, 
					 CELULAR, 
					 DIRECCION) 
				VALUES 
					(NULL, 
					'{$this->documentoIntegrante}', 
					'{$this->nombres}', 
					'{$this->primerApellido}', 
					'{$this->segundoApellido}', 
					'{$this->parentesco}', 
					'{$this->celular}', 
					'{$this->direccion}'); ";
			$this->db->consultaSimple($sql);

		}

		public function delete(){
			$sql="DELETE FROM familiar WHERE DOCUMENTO='{$this->documento}'";
			$this->db->consultaSimple($sql);

		}

		 public function edit() {
		      $sql="UPDATE familiar SET 
		            IDENTIFICACION_INTEGRANTE='{$this->documentoIntegrante}',
		            NOMBRES='{$this->nombres}',
		            PRIMER_APELLIDO ='{$this->primerApellido}',
		            SEGUNDO_APELLIDO ='{$this->segundoApellido}',
		            PARENTESCO ='{$this->parentesco}',
		            CELULAR ='{$this->celular}',
		            DIRECCION ='{$this->direccion}'
		            WHERE DOCUMENTO='{$this->documento}';";
		       $this->db->consultaSimple($sql);
		  }

		 public function view(){
			$sql="SELECT * FROM familiar WHERE DOCUMENTO='{$this->documento}'";
			$datos = $this->db->consultaRetorno($sql);
			$row = mysqli_fetch_assoc($datos);
			return $row;

		}



	} 


 ?>