<?php namespace Core\Models;


class GoLogin
{
	private $user;
	private $pass;
	private $db;
	
	function __construct()
	{
		 $this->user= (!empty($_POST['user'])) ? $_POST['user']: null;
		 $this->pass= (!empty($_POST['pass'])) ? $_POST['pass']: null;
		 $this->db = new Conexion();
	}

	public function encrypt ($string){
		  $long = strlen($string);
		  $str = '';
		  for($x = 0; $x < $long; $x++) {
		    $str .= ($x % 2) != 0 ? md5($string[$x]) : $x;
		  }
		  return md5($str);
	}


	public function validar(){
			#$pass = Encrypt($_POST['pass']);
		if ( !empty($this->user) and !empty( $this->pass)) {


			$sql="SELECT ID,ROL, CONCAT(NOMBRES, ' ', P_APELLIDO) AS NOMBRE FROM usuarios WHERE (USER='{$this->user}' OR EMAIL='{$this->user}') AND PASS='{$this->encrypt($this->pass)}' LIMIT 1;";
			$datos=  $this->db->consultaRetorno($sql);
		    $row =   $this->db->row($datos);
		    $total = $this->db->total_rows($datos);

			if ($total>0) {
				    if($_POST['sesion']) { ini_set('session.cookie_lifetime', time() + (60)); }
				    $_SESSION['app_id'] = $row['ID'];
				    $_SESSION['rol'] = $row['ROL'];
				    $_SESSION['nombre'] = $row['NOMBRE'];
				    $_SESSION['time_online'] = time() - (60);
				    echo 1;
	  		} else {
	  			    echo '
					  <div class="alert alert-dismissible alert-danger">
					    <button type="button" class="close" data-dismiss="alert">x</button>
					    <strong>ERROR:</strong> Las usuario o clave incorrectos.
					  </div>';
	  		}
 
	 	} else {
			  echo '
			<div class="alert alert-dismissible alert-danger">
			  <button type="button" class="close" data-dismiss="alert">x</button>
			  <strong>ERROR:</strong> Todos los datos deben estar llenos.
			</div>';
			}

	}

}

?>