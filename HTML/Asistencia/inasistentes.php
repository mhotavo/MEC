  <html>
  <head>
  	<?php include(HTML_DIR.'/overall/header.php') ?>
  </head>
  <body>
  	<?php include(HTML_DIR.'/overall/nav.php') ?>
  	<div id="container">
  	<h2 align="center">Inasistentes</h2>
  		<div class="">
  			<div class="col-md-2"></div>
  			<div class="col-md-8">

  				<table class="table table-striped table-hover" id="integrantesTabla" >
  					<thead>
  						<tr><br>
  							<div id="alert"  class="col-md-4"></div>
  						</tr>
  						<tr>
  							<th>Nombre</th>
  							<th>Estado</th>
  						</tr>
  					</thead>
  					<tbody> 
  						<?php foreach ($datos as $key => $value) {  ?>
  						<tr>
  							<td class=""><?php  echo $value['Nombre']; ?></td>
  							<td style="color:red;font-weight: bold;"><?php  echo $value['Estado']; ?></td>
  						<?php 
  					}
  					?>

  				</tbody>
  			</table>

  		</div>
  		<div class="col-md-2"></div>
  	</div>  
  </div>
  <?php include(HTML_DIR.'/overall/footer.php') ?> 
</body>
</html>   