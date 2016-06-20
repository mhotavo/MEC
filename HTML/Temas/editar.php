<html>
<head>
	<?php include(HTML_DIR.'/overall/header.php') ?>
</head>
<body>
	<?php include(HTML_DIR.'/overall/nav.php') ?>
	<div class="container">
		<h2 align="center">Tema - <?php echo ucwords(strtolower($datos['TEMA'])); ?></h2>
		<br>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<form class="form-horizontal" enctype="multipart/form-data" method="POST">
					<fieldset>
						<div class="form-group">
							<label for="inputNombres" class="col-lg-2 control-label">Tema</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" name="inputTema" placeholder="Tema" required value="<?php echo $datos['TEMA'] ?>">
							</div>
						</div>		
						<div class="form-group">
							<label for="inputPrimerApellido" class="col-lg-2 control-label">Descripcion</label>
							<div class="col-lg-10">
								<textarea  type="text" class="form-control" name="inputDescripcion" rows="10" required><?php echo $datos['DESCRIPCION'] ?></textarea>
							</div>
						</div>		
						<div class="form-group">
							<label for="inputSegundoApellido" class="col-lg-2 control-label" >Fecha</label>
							<div class="col-lg-10">
								<input type="date" class="form-control" name="inputFecha" value="<?php echo $datos['FECHA'] ?>">
							</div>
						</div>			    	        


						<div class="form-group">
							<div class="col-lg-10 col-lg-offset-2">
								<input type="hidden" class="form-control" name="inputId" value="<?php echo $datos['ID_TEMA'] ?>">
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
	<?php include(HTML_DIR.'/overall/footer.php') ?> 
</body>
</html>   