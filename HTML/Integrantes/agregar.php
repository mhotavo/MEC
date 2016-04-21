

<div class="container">
<h2 align="center">Nuevo Integrante</h2>
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
		      <label for="inputFechaNacimiento" class="col-lg-2 control-label">Fecha Nacimiento</label>
		      <div class="col-lg-10">
		        <input type="date" class="form-control" name="inputFechaNacimiento" required>
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
		      <label for="inputEmail" class="col-lg-2 control-label">Correo</label>
		      <div class="col-lg-10">
		        <input type="text" class="form-control" name="inputEmail" placeholder="Email" required>
		      </div>
		    </div>
		    <div class="form-group">
		      <label for="inputImagen" class="col-lg-2 control-label">Imagen</label>
		      <div class="col-lg-10">
		        <input type="file" class="form-control" name="inputImagen" >
		      </div>
		    </div>

		    <div class="form-group">
		      <label class="col-lg-2 control-label">Acolito</label>
		      <div class="col-lg-10">
		        <div class="radio">
		          <label>
		            <input type="radio" name="Acolito" id="optionsRadios1" value="1" >
		            Si
		          </label>
 
		          <label>
		            <input type="radio" name="Acolito" id="optionsRadios2" value="0" checked="">
		            No
		          </label>
		        </div>
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="col-lg-2 control-label">Coordinador</label>
		      <div class="col-lg-10">
		        <div class="radio">
		          <label>
		            <input type="radio" name="Coordinador" id="optionsRadios1" value="1" >
		            Si
		          </label>
	
		          <label>
		            <input type="radio" name="Coordinador" id="optionsRadios2" value="0" checked="">
		            No
		          </label>
		        </div>
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
