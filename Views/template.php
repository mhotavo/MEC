<?php namespace Views;
	//$template=new Template();

	class Template 
	{
		
		function __construct()
		{?>
			<!DOCTYPE html>
			<html>
			<head>
				<title>MEC</title>
			 <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Views/bootstrap/bootstrap.min.css">
			 <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Views/css/general.css">

			 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			</head>
			<body>
				<nav class="navbar navbar-inverse">
			  <div class="container-fluid">
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="<?php echo URL; ?>">Misioneros en Camino</a>
			    </div>

			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
			     <ul class="nav navbar-nav">
 
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Integrantes <span class="caret"></span></a>
			          <ul class="dropdown-menu" role="menu">
			            <li><a href="<?php echo URL; ?>Integrantes/agregar">Agregar</a></li>
			            <li class="divider"></li>
			          </ul>
			        </li>
			      </ul>
 
			      <form class="navbar-form navbar-left" role="search">
			        <div class="form-group">
			          <input type="text" class="form-control" placeholder="">
			        </div>
			        <button type="submit" class="btn btn-default">Buscar</button>
			      </form>
			     <!-- <ul class="nav navbar-nav navbar-right">
			        <li><a href="#">Link</a></li>
			      </ul>-->
			    </div>
			  </div>
			</nav>

  <?php }

		function __destruct()
		{ ?>

			<script src="<?php echo URL; ?>Views/js/jquery.min.js"></script>
			<script src="<?php echo URL; ?>Views/bootstrap/bootstrap.min.js"></script> 	
			<script src="<?php echo URL; ?>Views/js/generales.js"></script> 	
			</body>
			</html>			
<?php }		
	}



   ?>