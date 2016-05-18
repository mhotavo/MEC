<?php namespace Core\Controllers;

 
  class LostpassController  
  {
  	

	public function index(){
		 if (!isset($_SESSION['app_id'])){
		 	require_once ("HTML/Public/lostpass.html");
		 }else {
		 	header("Location:" . URL . "Integrantes");
		 }
		
	}

  }

?>