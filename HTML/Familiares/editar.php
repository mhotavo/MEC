<?php 
$lista=$Familiares->listarIntegrante();
?>
<html>
<head>
	<?php include(HTML_DIR.'/overall/header.php') ?>
</head>
<body>
	<?php include(HTML_DIR.'/overall/nav.php') ?>
	<div  class="container">
		<h3  align="center"><?php echo $datos['NOMBRES'] ." ". $datos['PRIMER_APELLIDO']." ". $datos['SEGUNDO_APELLIDO'] ; ?></h3>
		<br>
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title" align="center"> <?php echo  $datos['PARENTESCO'] . " de  " . $datos['INTEGRANTE'] ;    ?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-body">
								<img class="img-responsive" src="<?php echo URL;?>HTML/Integrantes/avatars/<?php echo  !empty($row['IMAGEN']) ? $row['IMAGEN'] : 'no-image.png'    ; ?>" required>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<form class="form-horizontal" enctype="multipart/form-data" method="POST">
							<fieldset>
								<div class="form-group">
									<label for="inputNombres" class="col-lg-2 control-label"><b>Nombres</b></label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="inputNombres" value="<?php echo $datos['NOMBRES']; ?>" required>
									</div>
								</div>		
								<div class="form-group">
									<label for="inputPrimerApellido" class="col-lg-2 control-label"><b>Primer Apellido</b></label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="inputPrimerApellido" value="<?php echo $datos['PRIMER_APELLIDO']; ?>" required>
									</div>
								</div>		
								<div class="form-group">
									<label for="inputSegundoApellido" class="col-lg-2 control-label"><b>Segundo Apellido</b></label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="inputSegundoApellido" value="<?php echo $datos['SEGUNDO_APELLIDO']; ?>" >
									</div>
								</div>			    	        
								<div class="form-group">
									<label for="inputEmail" class="col-lg-2 control-label"><b>Familiar de:</b></label>
									<div class="col-lg-10">
										<select class="form-control" name="integrante">
											<option value="">[...]</option>
											<?php 
											while($row = mysqli_fetch_array($lista)){ ?>
												<option   <?php echo ($datos['IDENTIFICACION_INTEGRANTE']== $row['DOCUMENTO']) ? "selected" : null;  ?>  value="<?php  echo $row['DOCUMENTO']; ?>"><?php  echo $row['NOMBRES'] . " " . $row['PRIMER_APELLIDO']; ?></option>
												<?php } ?>
											</select>
										</div>
									</div> 
									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label"><b>Parentesco</b></label>
										<div class="col-lg-10">
											<select class="form-control" name="parentesco">
												<option value="">[...]</option>
												<option <?php  echo ($datos['PARENTESCO']=="Mama") ?  'selected': null; ?>  value="Mama">Mamá</option>
												<option <?php  echo ($datos['PARENTESCO']=="Papa") ?  "selected": null; ?> value="Papa">Papá</option>
												<option <?php  echo ($datos['PARENTESCO']=="Hermano(a)") ?  "selected": null; ?> value="Hermano(a)">Hermano(a)</option>
												<option <?php  echo ($datos['PARENTESCO']=="Abuelo(a)") ?  "selected": null; ?> value="Abuelo(a)">Abuelo(a)</option>
												<option <?php  echo ($datos['PARENTESCO']=="Tio(a)") ?  "selected": null; ?> value="Tio(a)">Tio(a)</option>
												<option <?php  echo ($datos['PARENTESCO']=="Otro") ?  "selected": null; ?> value="Otro">Otro</option>
											</select>
										</div>
									</div> 		    
									<div class="form-group">
										<label for="inputDireccion" class="col-lg-2 control-label">Dirección</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" name="inputDireccion" value="<?php echo $datos['DIRECCION']; ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label for="inputCelular" class="col-lg-2 control-label">Celular</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" name="inputCelular" value="<?php echo $datos['CELULAR']; ?>" required>
										</div>
									</div>


									<div class="form-group">
										<div class="col-lg-10 col-lg-offset-2">
											<input type="hidden" class="form-control" name="Documento"  required value="<?php echo $datos['DOCUMENTO']; ?>" >
											<input type="hidden" class="form-control" name="nombreImagen"  required value="<?php echo $datos['IMAGEN']; ?>" >
											<button type="reset" class="btn btn-default">Cancelar</button>
											<button type="submit" class="btn btn-success">Editar</button>
										</div>
									</div>
								</fieldset>
							</form>


						</div>
						<div class="col-md-2"></div>
					</div>
				</div>  
			</div>
		</div>
		<?php include(HTML_DIR.'/overall/footer.php') ?> 
	</body>
	</html>   