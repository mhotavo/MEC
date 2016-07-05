<?php namespace Core\Models;
use Core\Models\GoLogin as GoLogin;
class Usuario extends GoLogin {
	private $id;
	private $documento;
	private $user;
	private $password;
	private $email;
	private $genero;
	private $nombres;
	private $primerApellido;
	private $segundoApellido;
	private $ultimaConexion;
	private $db;
	private $GoLogin;

	public function __construct(){
		$this->db = new Conexion();
		$this->GoLogin = new GoLogin();
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

	public function edit() {
		
		$pass=$this->GoLogin->encrypt($this->password);
		$sql="UPDATE usuarios SET 
		DOC='{$this->documento}',
		USER ='{$this->user}',
		PASS ='{$pass}',
		EMAIL ='{$this->email}',
		NOMBRES ='{$this->nombres}',
		P_APELLIDO ='{$this->primerApellido}',
		S_APELLIDO ='{$this->segundoApellido}',
		GENERO ='{$this->genero}'
		WHERE ID='{$this->id}';";  
		$this->db->consultaSimple($sql);
	}

	public function view(){
		$sql="SELECT * FROM usuarios WHERE ID='{$this->id}'";
		$datos = $this->db->consultaRetorno($sql);
		$row = mysqli_fetch_assoc($datos);
		return $row;
	}

} 


?>