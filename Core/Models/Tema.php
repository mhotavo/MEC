<?php namespace Core\Models;

	class Tema {
		private $idTema;
		private $tema;
		private $descripcion;
		private $fecha;
		private $usuario;
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
			$sql="SELECT * from tema order by FECHA desc";
			$datos=$this->db->consultaRetorno($sql);
			return $datos;
		}

		public function add(){
	 	$sql="INSERT INTO tema 
					(ID_TEMA,
					 TEMA,
					 DESCRIPCION,
					 FECHA, 
					 USUARIOLOG) 
				VALUES 
					(NULL, 
					'{$this->tema}', 
					'{$this->descripcion}', 
					'{$this->fecha}', 
					'{$this->usuario}'); ";
			$this->db->consultaSimple($sql);

		}

		public function delete(){
			$sql="DELETE FROM tema WHERE ID_TEMA='{$this->idTema}'";
			$this->db->consultaSimple($sql);

		}

		 public function edit() {
		        $sql="UPDATE tema SET 
		            TEMA='{$this->tema}',
		            DESCRIPCION='{$this->descripcion}',
		            FECHA ='{$this->fecha}'	  
		            WHERE ID_TEMA='{$this->idTema}';";
		       $this->db->consultaSimple($sql);
		  }

		 public function view(){
			$sql="SELECT t.*, u.* FROM tema t  INNER JOIN usuarios u ON t.USUARIOLOG=u.ID  WHERE ID_TEMA='{$this->idTema}'";
			$datos = $this->db->consultaRetorno($sql);
			$row = mysqli_fetch_assoc($datos);
			return $row;

		}



	} 


 ?>