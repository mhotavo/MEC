  <html>
  <head>
    <?php include(HTML_DIR.'/overall/header.php') ?>
    <link rel="stylesheet" type="text/css" href="Views/DataTables/media/css/dataTables.bootstrap.css">
  </head>
  <body>
    <?php include(HTML_DIR.'/overall/nav.php') ?>
    <div id="container">
      <h2 align="center">Registro visitas</h2>
      <div class="">
        <div class="col-md-2"></div>
        <div class="col-md-8">

          <table class="table table-striped table-hover dataTable" id="">
            <thead>
              <tr>
                <th>Nro.</th>
                <th>Usuario</th>
                <th>IP</th>
                <th>FECHA</th>
              </tr>
            </thead>
            <tbody> 
              <?php while($row = mysqli_fetch_assoc($datos)){ ?>
                <tr>           
                  <td><?php  echo $row['ID']; ?></td>
                  <td><?php  echo $row['USER']; ?></td>
                  <td><?php  echo $row['IP']; ?></td>
                  <td><?php  echo $row['FECHA']; ?></td>

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
          "order": [[ 3, 'desc' ]]
        });
      } );
    </script>
  </body>
  </html>   