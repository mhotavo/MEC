<html>
  <head>
    <?php include(HTML_DIR.'/overall/header.php') ?>
  </head>
  <body>
    <?php include(HTML_DIR.'/overall/nav.php') ?>
    <div id="container">
      <h2 align="center">Horario Dominical</h2>
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
                 <div class="form-group col-md-5" >
                   <br>
                   <button id="borrar" type="button" class="btn btn-danger">Borrar</button>
                   <button id="generar" type="button" class="btn btn-success">Generar</button>
                   <button id="buscar" type="button" class="btn btn-info">Buscar</button>
                   
                 </div>                
                 <div class="form-group col-md-4" >
                   <div id="alert"></div>
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
                <th>Horario</th>
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
                    <select  id="misa_<?php echo $row['DOCUMENTO'] ?>" name="misa_<?php echo $row['DOCUMENTO'] ?>" class="form-control" required>
                      <option>[...]</option>
                      <option value="08:00AM">08:00 AM</option>
                      <option value="11:00AM">11:00 AM</option>
                      <option value="05:00PM">05:00 PM</option>
                      <option value="06:00PM">06:00 PM</option>
                      <option value="00:00">No Acolita</option>
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
    $("#borrar").click(function(){
      var fecha =$("#fecha").val();
      if (confirm('Estás Seguro?')) {
        $("#alert").empty();
        $.get('borrarFecha', {fecha:fecha}, function(data){
          $("#alert").append('<div class="alert alert-success"> \
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> \
            <strong>Horario Eliminado!</strong>.\
          </div>');
        }).error(function(e){
          console.log(e);
          $("#alert").append('<div class="alert alert-success"> \
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> \
            <strong>Error!</strong>.\
          </div>');
        })
      }

    });

    $("#generar").click(function(){
      $.getJSON('generarHorarioJSON',{dia:'Domingo'}, function(resp){

        jQuery.each( resp, function( key, value ) {
          var horario="";
          switch(value.HORARIO) {
            case "08:00AM":
            horario="11:00AM";
            break;
            case "11:00AM":
            horario="05:00PM";
            break;            
            case "05:00PM":
            horario="06:00PM";
            break;           
            case "06:00PM":
            horario="08:00AM"
            break;
            default:
            horario="08:00AM"
            break;
          }
          //console.log(horario);
          $("#misa_"+value.ID_INTEGRANTE).val(horario);
        });
      }).error(function(e){
        console.log(e);
      })
    });

    $("#buscar").click(function(){
      var fecha= $("#fecha").val();
      $.getJSON('generarHorarioJSON',{dia:'Domingo', fecha:fecha}, function(resp){
        jQuery.each( resp, function( key, value ) {
          //console.log(value.HORARIO);
          $("#misa_"+value.ID_INTEGRANTE).val(value.HORARIO);
        });
      }).error(function(e){
        console.log(e);
      })
    });


  </script>
</body>
</html>