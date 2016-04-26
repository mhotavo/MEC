<?php namespace Views;
	#$template=new Template();

	class Template 
	{
		
		function __construct()
		{?>
			<!DOCTYPE html>
			<html>
			<head>
				<title>MEC</title>
			 <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Views/bootstrap/css/bootstrap.min.css">
			 <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Views/css/general.css">
  		     <link rel="stylesheet" href="<?php echo URL; ?>Views/fontawesome/css/font-awesome.min.css">
			 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			 <!-- DataTables-->
			<script src="<?php echo URL; ?>Views/js/jquery.min.js"></script>
		  	<link rel="stylesheet" type="text/css" href="Views/DataTables/media/css/dataTables.bootstrap.css">
		  	<script type="text/javascript" src="Views/DataTables/media/js/jquery.dataTables.js"></script>
		  	<script type="text/javascript" src="Views/DataTables/media/js/dataTables.bootstrap.js"></script>

			<script type="text/javascript">

					$(document).ready(function() {
					$('#dataTable').DataTable({
						 "iDisplayLength": -1,
				//		 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
						 "autoWidth": false,
				/*		  "columns": [                // there must be an entry for every column
				            {"width": "30%", "orderable": true},     
				            null,
				            null,
				            null,
				            {"width": "10%", "orderable": true},
				            {"width": "19%", "orderable": true},
				            null
				          ],
				 */
				          "order": [[ 1, "desc" ]],
				          "sPaginationType": "full_numbers",
				/*           'bPaginate': false*/

					});
				} );

			</script>

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
			      <a class="navbar-brand" href="<?php echo URL; ?>Integrantes">Misioneros en Camino</a>
			    </div>

			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
			     <ul class="nav navbar-nav">
 
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Agregar <span class="caret"></span></a>
			          <ul class="dropdown-menu" role="menu">
			            <li><a href="<?php echo URL; ?>Integrantes/agregar">Integrante</a></li>
			            <li class="divider"></li>
			            <li><a href="<?php echo URL; ?>Familiares/agregar">Familiar</a></li>

			          </ul>
			        </li>
			      </ul>
 
			      <form class="navbar-form navbar-left" role="search">
			        <div class="form-group">
			          <input type="text" class="form-control" placeholder="">
			        </div>
			        <button type="submit" class="btn btn-default">Buscar</button>
			      </form>
			      <ul class="nav navbar-nav navbar-right">
			        <li><a href="<?php echo URL; ?>Logout"> Salir  <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
			      </ul>
			    </div>
			  </div>
			</nav>

  <?php }

		function __destruct()
		{ ?>

			
			<script src="<?php echo URL; ?>Views/bootstrap/js/bootstrap.min.js"></script> 	
			<script src="<?php echo URL; ?>Views/js/generales.js"></script> 	
			</body>
			</html>			
<?php }		
	}



   ?>