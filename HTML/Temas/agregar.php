

<div class="container">
	<h2 align="center">Nuevo Tema</h2>
	<br>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<form class="form-horizontal" enctype="multipart/form-data" method="POST">
				<fieldset>
					<div class="form-group">
						<label for="inputNombres" class="col-lg-2 control-label">Tema</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="inputTema" placeholder="Tema" required>
						</div>
					</div>		
					<div class="form-group">
						<label for="inputPrimerApellido" class="col-lg-2 control-label">Descripcion</label>
						<div class="col-lg-10">
							<textarea  type="text" class="form-control" name="inputDescripcion"  rows="10" required></textarea>
						</div>
					</div>		
					<div class="form-group">
						<label for="inputSegundoApellido" class="col-lg-2 control-label">Fecha</label>
						<div class="col-lg-10">
							<input type="date" class="form-control" name="inputFecha">
						</div>
					</div>			    	        


					<div class="form-group">
						<div class="col-lg-10 col-lg-offset-2">
							<button type="reset" class="btn btn-default">Cancelar</button>
							<button type="submit" class="btn btn-success">Guardar</button>
						</div>
					</div>
				</fieldset>
			</form>


		</div>
		<div class="col-md-2"></div>
	</div>  
</div>
