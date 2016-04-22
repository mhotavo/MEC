<?php namespace Core\Controllers;

 
  class LoginController  
  {
  	

	public function index(){
		 if (!isset($_SESSION['app_id'])){
		 	require_once ("HTML/Public/login.html");
		 }else {
		 	header("Location:" . URL . "Integrantes");
		 }
		
	}

  }

?>