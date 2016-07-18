  <html>
  <head>
    <?php include(HTML_DIR.'/overall/header.php') ?>
    <link rel="stylesheet" type="text/css" href="Views/DataTables/media/css/dataTables.bootstrap.css">
  </head>
  <body>
    <?php include(HTML_DIR.'/overall/nav.php') ?>
    <div id="container">
      <h2 align="center">Familiares</h2>
      <div class="">
        <div class="col-md-1"></div>
        <div class="col-md-10">

          <table class="table table-striped table-hover dataTable" id="">
            <thead>
              <tr>
                <th class="hidden-xs">Imagen</th>
                <th>Nombre</th>
                <th>Parentesco</th>
                <th class="hidden-xs">Integrante</th>
                <th class="hidden-xs">Celular</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody> 
              <?php while($row = mysqli_fetch_array($datos)){ ?>
                <tr>
                  <td class="hidden-xs"> <a href="<?php echo URL; ?>Familiares/ver/<?php echo $row['DOCUMENTO']; ?>"><img class="avatar" src="<?php  echo URL; ?>HTML/Integrantes/avatars/<?php echo  !empty($row['IMAGEN']) ? $row['IMAGEN'] : 'no-image.png'    ; ?>"> </a></td>
                  <td><a href="<?php echo URL; ?>Familiares/ver/<?php echo $row['DOCUMENTO']; ?>"><?php  echo $row['NOMBRES'] . " " . $row['PRIMER_APELLIDO']; ?></a></td>
                  <td><?php  echo $row['PARENTESCO']  ?></td>
                  <td class="hidden-xs"><?php  echo $row['INTEGRANTE']; ?></td>
                  <td class="hidden-xs"><?php  echo $row['CELULAR']; ?></td>
                  <td><a  class="btn btn-warning" href="<?php echo URL; ?>Familiares/editar/<?php echo $row['DOCUMENTO']; ?>">Editar &nbsp;</a> 
                    <a  class="btn btn-danger" onclick="DeleteItem('¿Está seguro de eliminar este familiar?','<?php echo URL; ?>Familiares/eliminar/<?php echo $row['DOCUMENTO']; ?>')" >Borrar </a> 
                  </td>
                </tr>
                <?php 
              }
              ?>

            </tbody>
          </table>

        </div>
        <div class="col-md-1"></div>
      </div>  
    </div>
    <?php include(HTML_DIR.'/overall/footer.php') ?> 
    <script type="text/javascript" src="Views/DataTables/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="Views/DataTables/media/js/dataTables.bootstrap.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('.dataTable').DataTable({
          "iDisplayLength": 25,
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          "autoWidth": true,           
          "sPaginationType": "full_numbers",
          "order": [[ 0, 'asc' ], [ 1, 'asc' ]]
        });
      } );
    </script>
  </body>
  </html>   