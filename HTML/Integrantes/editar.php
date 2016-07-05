  <html>
  <head>
  	<?php include(HTML_DIR.'/overall/header.php') ?>
  </head>
  <body>
  	<?php include(HTML_DIR.'/overall/nav.php') ?>
  	<div  class="container"> <!-- box-principal -->
  		<h3  align="center"><?php echo $datos['NOMBRES'] ." ". $datos['PRIMER_APELLIDO']." ". $datos['SEGUNDO_APELLIDO'] ; ?></h3>
  		<br>
  		<div class="panel panel-success">
  			<div class="panel-heading">
  				<h3 class="panel-title" align="center"> <?php echo  $datos['EDAD_ACTUAL'] . " " . "Años";    ?></h3>
  			</div>
  			<div class="panel-body">
  				<div class="row">
  					<div class="col-md-4">
  						<div class="panel panel-default">
  							<div class="panel-body">
  								<img class="img-responsive" src="<?php echo URL;?>HTML/Integrantes/avatars/<?php echo  !empty($datos['IMAGEN']) ? $datos['IMAGEN'] : 'no-image.png'    ; ?>" required>
  							</div>
  						</div>
  					</div>
  					<div class="col-md-8">
  						<form class="form-horizontal" enctype="multipart/form-data" method="POST">
  							<fieldset>
  								<div class="form-group">
  									<label for="inputNombres" class="col-lg-2 control-label">Nombres</label>
  									<div class="col-lg-10">
  										<input type="text" class="form-control" name="inputNombres" value="<?php echo $datos['NOMBRES']; ?>" required>
  									</div>
  								</div>		
  								<div class="form-group">
  									<label for="inputPrimerApellido" class="col-lg-2 control-label">Primer Apellido</label>
  									<div class="col-lg-10">
  										<input type="text" class="form-control" name="inputPrimerApellido" value="<?php echo $datos['PRIMER_APELLIDO']; ?>" required>
  									</div>
  								</div>		
  								<div class="form-group">
  									<label for="inputSegundoApellido" class="col-lg-2 control-label">Segundo Apellido</label>
  									<div class="col-lg-10">
  										<input type="text" class="form-control" name="inputSegundoApellido" value="<?php echo $datos['SEGUNDO_APELLIDO']; ?>" >
  									</div>
  								</div>	
                  <div class="form-group">
                    <label for="inputFechaNacimiento" class="col-lg-2 control-label">Género</label>
                    <div class="col-lg-10">
                      <select class="form-control" name="selectGenero">
                       <option value="">[...]</option>
                       <option value="F" <?php echo ($datos['GENERO']=='F') ? "selected" : NULL ?> >Femenino</option>
                       <option value="M"  <?php echo ($datos['GENERO']=='M') ? "selected" : NULL ?>>Masculino</option>
                     </select>
                   </div>
                 </div>		    	        
                 <div class="form-group">
                   <label for="inputFechaNacimiento" class="col-lg-2 control-label">Fecha Nacimiento</label>
                   <div class="col-lg-10">
                    <input type="date" class="form-control" name="inputFechaNacimiento" value="<?php echo $datos['FECHA_NACIMIENTO']; ?>" required>
                  </div>
                </div>
                <div class="form-group">
                 <label for="inputDireccion" class="col-lg-2 control-label">Dirección</label>
                 <div class="col-lg-10">
                  <input type="text" class="form-control" name="inputDireccion" value="<?php echo $datos['DIRECCION']; ?>" >
                </div>
              </div>
              <div class="form-group">
               <label for="inputCelular" class="col-lg-2 control-label">Celular</label>
               <div class="col-lg-10">
                <input type="text" class="form-control" name="inputCelular" value="<?php echo $datos['CELULAR']; ?>" >
              </div>
            </div>
            <div class="form-group">
             <label for="inputEmail" class="col-lg-2 control-label">Correo ó Facebook</label>
             <div class="col-lg-10">
              <input type="text" class="form-control" name="inputEmail" value="<?php echo $datos['CORREO']; ?>" >
            </div>
          </div>
          <div class="form-group">
           <label for="inputImagen" class="col-lg-2 control-label">Imagen</label>
           <div class="col-lg-10">
            <input type="file" class="form-control" name="inputImagen" >
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail" class="col-lg-2 control-label">Fecha de ingreso</label>
          <div class="col-lg-10">
            <input type="date" class="form-control" name="fechaIngreso" value="<?php echo $datos['FECHA_INGRESO']; ?>" >
          </div>
        </div>
        <div class="form-group">
         <label class="col-lg-2 control-label">Acolito</label>
         <div class="col-lg-10">
          <div class="radio">
           <label>
            <input type="radio" name="Acolito" id="optionsRadios1" value="1"  <?php echo ($datos['ACOLITO']=='1') ? "checked" : NULL ?> >
            Si
          </label>

          <label>
            <input type="radio" name="Acolito" id="optionsRadios2" value="0"  <?php echo ($datos['ACOLITO']=='0') ? "checked" : NULL ?> >
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
        <input type="radio" name="Coordinador" id="optionsRadios1" value="1" <?php echo ($datos['COORDINADOR']=='1') ? "checked" : NULL ?>>
        Si
      </label>

      <label>
        <input type="radio" name="Coordinador" id="optionsRadios2" value="0" <?php echo ($datos['COORDINADOR']=='0') ? "checked" : NULL ?>>
        No
      </label>
    </div>
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