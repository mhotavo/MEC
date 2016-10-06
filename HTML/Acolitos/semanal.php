  <html>
  <head>
    <?php include(HTML_DIR.'/overall/header.php') ?>
  </head>
  <body>
    <?php include(HTML_DIR.'/overall/nav.php') ?>
    <div id="container">
      <h2 align="center">Horario Semanal</h2>
      <div class="">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <form class="form-horizontal" enctype="multipart/form-data" method="POST" id="formAsistencia" name="formAsistencia">
            <table class="table table-striped table-hover" id="integrantesTabla" >
              <thead>
                <tr>
                 <div class="form-group col-md-3"  >
                   <label for="fecha">A partir de: <i class="fa fa-calendar" aria-hidden="true"></i></label>
                   <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo date('Y-m-d'); ?>" >
                 </div>
                 <div class="form-group col-md-3" >
                   <br>
                   <button id="borrar" type="button" class="btn btn-danger">Borrar horarios</button>
                 </div>                
                 <div class="form-group col-md-3" >
                   <div id="alert"></div>
                 </div>
               </tr>
               <tr>
                <th class="hidden-xs">Nro.</th>
                <th >Nombres</th>
                <th class="hidden-xs">Primer Apellido</th>
                <th>Asistencia</th>
                <th>Fecha</th>
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
                  <td class="visible-xs"><?php  echo $row['NOMBRES']; ?></td>
                  <td>  
                    <select  onchange="llamarFecha(this.value, <?php echo $row['DOCUMENTO'] ?>);"  name="misa_<?php echo $row['DOCUMENTO'] ?>" name="id_<?php echo $row['DOCUMENTO'] ?>" class="form-control" required="">
                      <option>[...]</option>
                      <option value="Lunes">Lunes</option>
                      <option value="Martes">Martes</option>
                      <option value="Miercoles">Miercoles</option>
                      <option value="Jueves">Jueves</option>
                      <option value="Viernes">Viernes</option>
                      <option value="Sabado">Sábado</option>
                      <option value="NoAcolita">No Acolita</option>
                    </select>
                  </td>
                  <td class="col-md-1">
                    <input type="date"  name="fecha_<?php echo $row['DOCUMENTO'] ?>" id="fecha_<?php echo $row['DOCUMENTO'] ?>" class="form-control" value="<?php echo date('Y-m-d'); ?>" >
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
      <div class="col-md-1"></div>
    </div>  
  </div>
  <?php include(HTML_DIR.'/overall/footer.php') ?> 
  <script>

    $("#borrar").click(function(){
      var fecha =$("#fecha").val();
      if (confirm('Estás Seguro?')) {
        $("#alert").empty();
        $.get('borrarRangoFechas', {fecha:fecha}, function(data){
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


    function llamarFecha (day, id) {
      var fullDate = new Date();

      switch(day) {
        case "Lunes" : 
        console.log("Lunes" );

        switch(fullDate.getDay()) {
          case 0 : // Domingo 
          console.log(mostrarFecha(1));
          $("#fecha_"+id).val(mostrarFecha(1));
          break;         
          case 1 : // lunes 
          console.log(mostrarFecha(7));
          $("#fecha_"+id).val(mostrarFecha(7));
          break;
          case 2 : // Martes
          console.log(fullDate.getDay(6));
          $("#fecha_"+id).val(mostrarFecha(6));
          break;
          case 3 : // Miercoles
          console.log(fullDate.getDay(5));
          $("#fecha_"+id).val(mostrarFecha(5));
          break;
          case 4 :  // Jueves
          console.log(fullDate.getDay(4));
          $("#fecha_"+id).val(mostrarFecha(4));
          break;
          case 5 : // Viernes
          console.log(fullDate.getDay(3));
          $("#fecha_"+id).val(mostrarFecha(3));
          break;
          case 6 : //sabado
          console.log(fullDate.getDay(2));
          $("#fecha_"+id).val(mostrarFecha(2));
          break;
          default : 
          console.log("No Acolita");
          break;

        }

        break;
        case "Martes" : 
        console.log("Martes" );
        switch(fullDate.getDay()) {
          case 0 : // Domingo 
          console.log(mostrarFecha(2));
          $("#fecha_"+id).val(mostrarFecha(2));
          break;         
          case 1 : // lunes 
          console.log(mostrarFecha(1));
          $("#fecha_"+id).val(mostrarFecha(1));
          break;
          case 2 : // Martes
          console.log(fullDate.getDay(7));
          $("#fecha_"+id).val(mostrarFecha(7));
          break;
          case 3 : // Miercoles
          console.log(fullDate.getDay(6));
          $("#fecha_"+id).val(mostrarFecha(6));
          break;
          case 4 :  // Jueves
          console.log(fullDate.getDay(5));
          $("#fecha_"+id).val(mostrarFecha(5));
          break;
          case 5 : // Viernes
          console.log(fullDate.getDay(4));
          $("#fecha_"+id).val(mostrarFecha(4));
          break;
          case 6 : //sabado
          console.log(fullDate.getDay(3));
          $("#fecha_"+id).val(mostrarFecha(3));
          break;
          default : 
          console.log("No Acolita");
          break;

        }
        break;
        case "Miercoles" : 
        console.log("Miercoles" );
        switch(fullDate.getDay()) {
          case 0 : // Domingo 
          console.log(mostrarFecha(3));
          $("#fecha_"+id).val(mostrarFecha(3));
          break;         
          case 1 : // lunes 
          console.log(mostrarFecha(2));
          $("#fecha_"+id).val(mostrarFecha(2));
          break;
          case 2 : // Martes
          console.log(fullDate.getDay(1));
          $("#fecha_"+id).val(mostrarFecha(1));
          break;
          case 3 : // Miercoles
          console.log(fullDate.getDay(7));
          $("#fecha_"+id).val(mostrarFecha(7));
          break;
          case 4 :  // Jueves
          console.log(fullDate.getDay(6));
          $("#fecha_"+id).val(mostrarFecha(6));
          break;
          case 5 : // Viernes
          console.log(fullDate.getDay(5));
          $("#fecha_"+id).val(mostrarFecha(5));
          break;
          case 6 : //sabado
          console.log(fullDate.getDay(4));
          $("#fecha_"+id).val(mostrarFecha(4));
          break;
          default : 
          console.log("No Acolita");
          break;
        }
        break;
        case "Jueves" : 
        console.log("Jueves" );
        switch(fullDate.getDay()) {
          case 0 : // Domingo 
          console.log(mostrarFecha(4));
          $("#fecha_"+id).val(mostrarFecha(4));
          break;         
          case 1 : // lunes 
          console.log(mostrarFecha(3));
          $("#fecha_"+id).val(mostrarFecha(3));
          break;
          case 2 : // Martes
          console.log(fullDate.getDay(2));
          $("#fecha_"+id).val(mostrarFecha(2));
          break;
          case 3 : // Miercoles
          console.log(fullDate.getDay(1));
          $("#fecha_"+id).val(mostrarFecha(1));
          break;
          case 4 :  // Jueves
          console.log(fullDate.getDay(7));
          $("#fecha_"+id).val(mostrarFecha(7));
          break;
          case 5 : // Viernes
          console.log(fullDate.getDay(6));
          $("#fecha_"+id).val(mostrarFecha(6));
          break;
          case 6 : //sabado
          console.log(fullDate.getDay(5));
          $("#fecha_"+id).val(mostrarFecha(5));
          break;
          default : 
          console.log("No Acolita");
          break;
        }
        break;
        case "Viernes" : 
        console.log("Viernes" );
        switch(fullDate.getDay()) {
          case 0 : // Domingo 
          console.log(mostrarFecha(5));
          $("#fecha_"+id).val(mostrarFecha(5));
          break;         
          case 1 : // lunes 
          console.log(mostrarFecha(4));
          $("#fecha_"+id).val(mostrarFecha(4));
          break;
          case 2 : // Martes
          console.log(fullDate.getDay(3));
          $("#fecha_"+id).val(mostrarFecha(3));
          break;
          case 3 : // Miercoles
          console.log(fullDate.getDay(2));
          $("#fecha_"+id).val(mostrarFecha(1));
          break;
          case 4 :  // Jueves
          console.log(fullDate.getDay(1));
          $("#fecha_"+id).val(mostrarFecha(1));
          break;
          case 5 : // Viernes
          console.log(fullDate.getDay(7));
          $("#fecha_"+id).val(mostrarFecha(7));
          break;
          case 6 : //sabado
          console.log(fullDate.getDay(6));
          $("#fecha_"+id).val(mostrarFecha(6));
          break;
          default : 
          console.log("No Acolita");
          break;
        }
        break;
        case "Sabado" : 
        console.log("Sabado" );
        switch(fullDate.getDay()) {
          case 0 : // Domingo 
          console.log(mostrarFecha(6));
          $("#fecha_"+id).val(mostrarFecha(6));
          break;         
          case 1 : // lunes 
          console.log(mostrarFecha(5));
          $("#fecha_"+id).val(mostrarFecha(5));
          break;
          case 2 : // Martes
          console.log(fullDate.getDay(4));
          $("#fecha_"+id).val(mostrarFecha(4));
          break;
          case 3 : // Miercoles
          console.log(fullDate.getDay(3));
          $("#fecha_"+id).val(mostrarFecha(3));
          break;
          case 4 :  // Jueves
          console.log(fullDate.getDay(2));
          $("#fecha_"+id).val(mostrarFecha(2));
          break;
          case 5 : // Viernes
          console.log(fullDate.getDay(1));
          $("#fecha_"+id).val(mostrarFecha(1));
          break;
          case 6 : //sabado
          console.log(fullDate.getDay(7));
          $("#fecha_"+id).val(mostrarFecha(7));
          break;
          default : 
          console.log("No Acolita");
          break;
        }
        break;
        default :
        console.log("No Acolita" );
        $("#fecha_"+id).val(null);
        break;

      }




    }


  </script>
</body>
</html>   