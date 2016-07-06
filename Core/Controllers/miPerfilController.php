<?php namespace Core\Controllers;
use Core\Models\Usuario as Usuario;


class MiperfilController{

  private $Usuario;
  public function __construct(){
    $this->Usuario = new Usuario();
  }

  public function index(){
    if ($_POST) {
      $this->Usuario->__set("id", $_POST['id']);
      $this->Usuario->__set("documento", $_POST['inputDocumento'] );
      $this->Usuario->__set("user", $_POST['inputUser'] );
      $this->Usuario->__set("password", $_POST['nueva'] );
      $this->Usuario->__set("email", $_POST['inputEmail'] );
      $this->Usuario->__set("genero", $_POST['selectGenero']);
      $this->Usuario->__set("nombres", $_POST['inputNombres']);
      $this->Usuario->__set("primerApellido", $_POST['inputPrimerApellido']);
      $this->Usuario->__set("segundoApellido", $_POST['inputSegundoApellido']);

      $permitidos=array("image/jpeg", "image/png", "image/jpg");
      $limite = 700;
      if (in_array($_FILES['inputImagen']['type'], $permitidos) and $limite>0 and $_FILES['inputImagen']['size']<= $limite*1024 ) {
        if (is_readable("HTML/Miperfil/avatars/". $_POST['nombreImagen'])) {
         unlink("HTML/Miperfil/avatars/". $_POST['nombreImagen']);
       }
       
       $nombre = date("is") . $_FILES['inputImagen']['name'];
       $ruta= "HTML/Miperfil/avatars/" . $nombre;
       move_uploaded_file($_FILES['inputImagen']['tmp_name'], $ruta);
       $this->Usuario->__set("imagen", $nombre); 
     } else{
 
      $this->Usuario->__set("imagen", $_POST['nombreImagen']);  
    }   
 
    $this->Usuario->edit();   
    header("Location:" . URL . "miperfil");

  }else{
    $this->Usuario->__set("id", $_SESSION['app_id']);
    $datos=$this->Usuario->view();  
    return $datos;
  }
}


}

$MiPerfil= new MiperfilController();


?>