<div  class="container box-principal">
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
				    <img class="img-responsive" src="<?php echo URL;?>HTML/Familiares/avatars/<?php echo  !empty($row['IMAGEN']) ? $row['IMAGEN'] : 'no-image.png'    ; ?>" required>
				  </div>
				</div>
	  		</div>
	    <div class="col-md-8">
			<div class="form-horizontal" >
			  <fieldset>
			    <div class="form-group">
			      <label for="inputNombres" class="col-lg-2 control-label">Nombres</label>
			      <div class="ver col-lg-10">
			       	<?php echo $datos['NOMBRES']; ?>
			      </div>
			    </div>		
			    <div class="form-group">
			      <label for="inputPrimerApellido" class="col-lg-2 control-label">Primer Apellido</label>
			      <div class="ver col-lg-10">
			        <?php echo $datos['PRIMER_APELLIDO']; ?>
			      </div>
			    </div>		
			    <div class="form-group">
			      <label for="inputSegundoApellido" class="col-lg-2 control-label">Segundo Apellido</label>
			      <div class="ver col-lg-10">
			      	<?php echo $datos['SEGUNDO_APELLIDO']; ?>
			      </div>
			    </div>			    	        
	 
			    <div class="form-group">
			      <label for="inputDireccion" class="col-lg-2 control-label">Dirección</label>
			      <div class="ver col-lg-10">
			       	<?php echo $datos['DIRECCION']; ?>
			      </div>
			    </div>
			    <div class="form-group">
			      <label for="inputCelular" class="col-lg-2 control-label">Celular</label>
			      <div class="ver col-lg-10">
			        <?php echo $datos['CELULAR']; ?>
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
