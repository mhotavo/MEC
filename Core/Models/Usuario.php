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
	private $imagen;
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
		if ($this->password!="") {
			$pass=$this->GoLogin->encrypt($this->password);
			$sql="UPDATE usuarios SET 
			PASS ='{$pass}'
			WHERE ID='{$this->id}';";  
			$this->db->consultaSimple($sql);
		} 
		
		$sql="UPDATE usuarios SET 
		DOC='{$this->documento}',
		USER ='{$this->user}',
		EMAIL ='{$this->email}',
		NOMBRES ='{$this->nombres}',
		P_APELLIDO ='{$this->primerApellido}',
		S_APELLIDO ='{$this->segundoApellido}',
		GENERO ='{$this->genero}',
		IMAGEN ='{$this->imagen}'
		WHERE ID='{$this->id}';";  
		$this->db->consultaSimple($sql); 
	}

	public function view(){
		$sql="SELECT * FROM usuarios WHERE ID='{$this->id}'";
		$datos = $this->db->consultaRetorno($sql);
		$row = mysqli_fetch_assoc($datos);
		return $row;
	}

	public function logs(){
		$sql="SELECT l.*, u.USER FROM logs l INNER JOIN usuarios u ON (u.ID=l.USER) WHERE (l.IP!='::1' OR l.IP!='186.87.108.230' OR l.IP!='186.114.253.46') ORDER BY FECHA DESC";
		$datos=$this->db->consultaRetorno($sql);
		return $datos;
	}

} 


?>