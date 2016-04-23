

<div class="container">
<h2 align="center">Nuevo Familiar</h2>
<br>
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
		<form class="form-horizontal" enctype="multipart/form-data" method="POST">
		  <fieldset>
		    <div class="form-group">
		      <label for="inputNombres" class="col-lg-2 control-label">Nombres</label>
		      <div class="col-lg-10">
		        <input type="text" class="form-control" name="inputNombres" placeholder="Nombres" required>
		      </div>
		    </div>		
		    <div class="form-group">
		      <label for="inputPrimerApellido" class="col-lg-2 control-label">Primer Apellido</label>
		      <div class="col-lg-10">
		        <input type="text" class="form-control" name="inputPrimerApellido" placeholder="Primer Apellido" required>
		      </div>
		    </div>		
		    <div class="form-group">
		      <label for="inputSegundoApellido" class="col-lg-2 control-label">Segundo Apellido</label>
		      <div class="col-lg-10">
		        <input type="text" class="form-control" name="inputSegundoApellido" placeholder="Segundo Apellido" required>
		      </div>
		    </div>			    	        

		    <div class="form-group">
		      <label for="inputEmail" class="col-lg-2 control-label">Familiar de:</label>
		      <div class="col-lg-10">
		        <select class="form-control" name="integrante">
		        	<option value="">[...]</option>
		        	<?php 
		        	while($row = mysqli_fetch_array($datos)){ ?>
		        	<option value="<?php  echo $row['DOCUMENTO']; ?>"><?php  echo $row['NOMBRES'] . " " . $row['PRIMER_APELLIDO']; ?></option>
		        	<?php } ?>
		        </select>
		      </div>
		    </div> 
		    <div class="form-group">
		      <label for="inputEmail" class="col-lg-2 control-label">Parentesco</label>
		      <div class="col-lg-10">
		        <select class="form-control" name="parentesco">
		        	<option value="">[...]</option>
		        	<option value="Mama">Mamá</option>
		        	<option value="Papa">Papá</option>
		        	<option value="Hermano(a)">Hermano(a)</option>
		        	<option value="Abuelo(a)">Abuelo(a)</option>
		        	<option value="Tio(a)">Tio(a)</option>
		        	<option value="Otro">Otro</option>
		        </select>
		      </div>
		    </div> 		    
		    <div class="form-group">
		      <label for="inputDireccion" class="col-lg-2 control-label">Dirección</label>
		      <div class="col-lg-10">
		        <input type="text" class="form-control" name="inputDireccion" placeholder="Direccion" required>
		      </div>
		    </div>
		    <div class="form-group">
		      <label for="inputCelular" class="col-lg-2 control-label">Celular</label>
		      <div class="col-lg-10">
		        <input type="text" class="form-control" name="inputCelular" placeholder="Celular" required>
		      </div>
		    </div>
		    <div class="form-group">
		      <label for="inputEmail" class="col-lg-2 control-label">Correo ó Facebook</label>
		      <div class="col-lg-10">
		        <input type="text" class="form-control" name="inputEmail" placeholder="Email" required>
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
