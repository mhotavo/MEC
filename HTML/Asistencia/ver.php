  <html>
  <head>
    <?php include(HTML_DIR.'/overall/header.php') ?>
  </head>
  <body>
    <?php include(HTML_DIR.'/overall/nav.php') ?>
    <div id="container">
      <h2 align="center">Registro de Asistencia</h2>
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <table class="table table-striped" id="tablaAsistencia" >
            <thead>
              <tr>
                <th>Nombre</th>
              </tr>
            </thead>
            <tbody> 
             
            </tbody>
          </table>
        </div>
        <div class="col-md-2"></div>
      </div>  
    </div>
    <?php include(HTML_DIR.'/overall/footer.php') ?> 
    <script>
      $(document).ready(asistencia);
    </script>
  </body>
  </html>   