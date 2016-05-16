<div  class="container box-principal">
	<br>
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title" align="center"> <?php echo  $datos['TEMA'] ;    ?></h3>
		</div>
		<div class="panel-body">
			<div class="row">
	    	<!--<div class="col-md-4">
	  			<div class="panel panel-default">
				  <div class="panel-body">
				    <img class="img-responsive" src="<?php echo URL;?>HTML/Temas/avatars/<?php echo  !empty($row['']) ? $row[''] : 'no-image.png'    ; ?>" required>
				  </div>
				</div>
			</div>-->
			<div class="col-md-12">
				<div class="form-horizontal" >
					<fieldset>
						<div class="form-group">
							<label for="inputNombres" class="col-lg-2 control-label">Tema</label>
							<div class="ver col-lg-10">
								<?php echo $datos['TEMA']; ?>
							</div>
						</div>		
						<div class="form-group">
							<label for="inputPrimerApellido" class="col-lg-2 control-label">Descripción</label>
							<div class="ver col-lg-10">
								<?php echo str_replace("\n", "<br>", $datos['DESCRIPCION']) ; ?>
							</div>
						</div>		
						<div class="form-group">
							<label for="inputSegundoApellido" class="col-lg-2 control-label">Fecha</label>
							<div class="ver col-lg-10">
								<?php echo $datos['FECHA']; ?>
							</div>
						</div>			    	        

						<div class="form-group">
							<label for="inputDireccion" class="col-lg-2 control-label">Registrado por</label>
							<div class="ver col-lg-10">
							<?php echo ucwords(strtolower($datos['NOMBRES'] . " " . $datos['P_APELLIDO'])) ; ?>
							</div>
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
