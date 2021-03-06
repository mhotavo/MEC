  <html>
  <head>
    <?php include(HTML_DIR.'/overall/header.php') ?>
    <link rel="stylesheet" type="text/css" href="Views/DataTables/media/css/dataTables.bootstrap.css">
  </head>
  <body>
    <?php include(HTML_DIR.'/overall/nav.php') ?>
    <div id="container">
      <h2 align="center">Temas</h2>
      <div class="">
        <div class="col-md-2"></div>
        <div class="col-md-8">

          <table class="table table-striped table-hover dataTable" id="">
            <thead>
              <tr>
                <th>Tema</th>
                <th>Fecha</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody> 
              <?php while($row = mysqli_fetch_array($datos)){ ?>
                <tr>           
                  <td><a style="text-decoration: none;" href="<?php echo URL; ?>Temas/ver/<?php echo $row['ID_TEMA']; ?>"> <?php  echo $row['TEMA']  ?> </a></td>
                  <td><?php  echo $row['FECHA']; ?></td>
                  <td><a  class="btn btn-warning" href="<?php echo URL; ?>Temas/editar/<?php echo $row['ID_TEMA']; ?>">Editar&nbsp;</a> 
                    <a  class="btn btn-danger" onclick="DeleteItem('¿Está seguro de eliminar este familiar?','<?php echo URL; ?>Temas/eliminar/<?php echo $row['ID_TEMA']; ?>')" >Borrar</a> 
                  </td>
                </tr>
                <?php 
              }
              ?>

            </tbody>
          </table>

        </div>
        <div class="col-md-2"></div>
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
          "order": [[ 1, 'desc' ]]
        });
      } );
    </script>
  </body>
  </html>   