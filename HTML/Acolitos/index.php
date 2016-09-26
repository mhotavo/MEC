  <html>
  <head>
    <?php include(HTML_DIR.'/overall/header.php') ?>
  </head>
  <body>
    <?php include(HTML_DIR.'/overall/nav.php') ?>
    <div id="container">
      <h2 align="center">Asistencia Dominical</h2>
      <div class="">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <form class="form-horizontal" enctype="multipart/form-data" method="POST" id="formAsistencia" name="formAsistencia">
            <table class="table table-striped table-hover" id="integrantesTabla" >
              <thead>
                <tr>
                 <div class="form-group col-md-3"  >
                   <label for="fecha">Fecha: <i class="fa fa-calendar" aria-hidden="true"></i></label>
                   <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo date('Y-m-d'); ?>" >
                 </div>
               </tr>
               <tr><br>
                <div id="alert"  class="col-md-4"></div>
              </tr>
              <tr>
                <th class="hidden-xs">Nro.</th>
                <th class="hidden-xs">Nombres</th>
                <th class="hidden-xs">Primer Apellido</th>
                <th  class="visible-xs">Nombre</th>
                <th>Asistencia</th>
              </tr>
            </thead>
            <tbody> 
              <?php 
              $i=1;
              while($row = mysqli_fetch_array($datos)){ ?>
              <tr id="<?php echo $row['DOCUMENTO'] ?>">
                <td class="hidden-xs"><?php  echo $i; ?></td>
                <td class="hidden-xs"><?php  echo $row['NOMBRES']; ?></td>
                <td class="hidden-xs"><?php  echo $row['PRIMER_APELLIDO']; ?></td>
                <td class="visible-xs"><?php  echo $row['NOMBRES']." ".$row['PRIMER_APELLIDO']; ?></td>
                <td>  
                <select  name="misa_<?php echo $row['DOCUMENTO'] ?>" name="id_<?php echo $row['DOCUMENTO'] ?>" class="form-control" required="">
                    <option>[...]</option>
                    <option value="08:00">08:00 AM</option>
                    <option value="11:00">11:00 AM</option>
                    <option value="05:00">05:00 PM</option>
                    <option value="06:00">06:00 PM</option>
                  </select>
                </td>
              </tr>
              <?php 
              $i++;
            }
            ?>

          </tbody>
        </table>
        <div class="form-group" align="center" style="padding-top: 4%;">
          <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div>
    <div class="col-md-2"></div>
  </div>  
</div>
<?php include(HTML_DIR.'/overall/footer.php') ?> 
<script>
  $("#fecha").blur(function(){
    cargarAsistencia( $("#fecha").val() );
  });
</script>
</body>
</html>   