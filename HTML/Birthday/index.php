  <html>
  <head>
    <?php include(HTML_DIR.'/overall/header.php') ?>
    <link rel="stylesheet" type="text/css" href="Views/DataTables/media/css/dataTables.bootstrap.css">
  </head>
  <body>
    <?php include(HTML_DIR.'/overall/nav.php') ?>
    <div id="container">
      <h2 align="center">Cumpleaños</h2>
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

          <table class="table table-striped table-hover" id="birthdays" >
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Fecha Nacimiento</th>
                <th>Edad</th>
              </tr>
            </thead>
            <tbody> 

            </tbody>
          </table>

        </div>
        <div class="col-md-3"></div>
      </div>  
    </div>
    <?php include(HTML_DIR.'/overall/footer.php') ?> 
    <script type="text/javascript" src="Views/DataTables/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="Views/DataTables/media/js/dataTables.bootstrap.js"></script>
    <script type="text/javascript">
      $(document).ready(birthday);
    </script>
  </body>
  </html>   