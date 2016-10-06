<?php namespace Core\Models;

class Conexion{

	private $datos= array (
		"host"=>DB_HOST,
		"user"=>DB_USER,
		"pass"=>DB_PASS,
		"db"=>DB_NAME
		);
	private $db;

	public function __construct()
	{
		$this->db = new \mysqli(
			$this->datos['host'],
			$this->datos['user'],
			$this->datos['pass'],
			$this->datos['db']
			);
		$this->db-> set_charset("utf8");

	}

	public function consultaSimple($sql)
	{
		$this->db->query($sql);
	}

	public function consultaRetorno($sql){
		$datos = $this->db->query($sql);
		return $datos;
	}

	public function row($sql){
		$datos =  mysqli_fetch_array($sql);
		return $datos;
	}


	public function total_rows($sql){
		return mysqli_num_rows($sql);
	}

	

}


?>