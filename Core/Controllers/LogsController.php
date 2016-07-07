<?php namespace Core\Controllers;
use Core\Models\Usuario as Usuario;


class LogsController{
 // private $Usuario;
  public function __construct(){
    $this->Usuario = new Usuario();
  }

  public function index(){
    if (!empty($_SESSION['app_id'])) {
      $datos=$this->Usuario->logs();
      //print_r($datos);
      return $datos;  

    }  else {
      header("Location:" . URL . "Integrantes");
    }
  }


}

$Logs= new LogsController();


?>