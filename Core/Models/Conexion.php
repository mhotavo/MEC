<?php namespace Core\Models;

	class Conexion{

		private $datos= array (
				"host"=>"localhost",
				"user"=> "root",
				"pass"=>"",
				"db"=>"mec"
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
		}

		public function consultaSimple($sql)
		{
			$this->db->query($sql);
		}

		public function consultaRetorno($sql){
			$datos = $this->db->query($sql);
			return $datos;
		}

	}


 ?>