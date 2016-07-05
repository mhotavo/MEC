  <html>
  <head>
    <?php include(HTML_DIR.'/overall/header.php') ?>
  </head>
  <body>
    <?php include(HTML_DIR.'/overall/nav.php') ?>
    <div id="container">
      <h3 align="center">Registro de Asistencia</h3>
      <div class="">
        <div class="col-md-1"></div>
        <div class="col-md-10">
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
        <div class="col-md-1"></div>
      </div>  
    </div>
    <?php include(HTML_DIR.'/overall/footer.php') ?> 
    <script>
      $(document).ready(asistencia);
    </script>
  </body>
  </html>   