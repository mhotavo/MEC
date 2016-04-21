<?php namespace Core\Bin\Ajax;
 

	class Familiar {
		private $documento;
		private $documentoIntegrante;
		private $nombres;
		private $primerApellido;
		private $segundoApellido;
		private $parentesco;
		private $celular;
		private $direccion;	
		private $db;

		public function __construct(){
			$this->db = new Conexion();
		}
}

$db= new Familiar();
		?>
 