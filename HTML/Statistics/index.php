  <html>
  <head>
    <?php include(HTML_DIR.'/overall/header.php') ?>
    <link rel="stylesheet" type="text/css" href="Views/DataTables/media/css/dataTables.bootstrap.css">
  </head>
  <body>
    <?php include(HTML_DIR.'/overall/nav.php') ?>
    <div id="container">
      <h2 align="center">Estadísticas</h2>
      <div class="">
        <div class="col-md-3"></div>
        <div class="col-md-6">

          <table class="table table-striped table-hover" id="birthdays" >
            <tbody> 
              <tr>
                <td  class="text-info"><b>Los más Longevos</b></td>
                <td >
                  <ul id="longevos">
                  </ul>
                </td>
              </tr>
              <tr>
                <td class="text-info"><b>Los más Jovenes</b></td>
                <td >
                  <ul id="jovenes">
                  </ul>
                </td>
              </tr>
              <tr>
                <td class="text-info"><b>Los más Consantes</b></td>
                <td >
                  <ul id="jovenes">
                  </ul>
                </td>
              </tr>
              <tr>
                <td class="text-info"><b>Los más Inconstantes</b></td>
                <td >
                  <ul id="jovenes">
                  </ul>
                </td>
              </tr>
              <tr>
                <td>Promedio de Edad</td>
                <td></td>
              </tr>
              <tr>
                <td>Número de Mujeres</td>
                <td></td>
              </tr>
              <tr>
                <td>Número de Hombres</td>
                <td></td>
              </tr>
              <tr>
                <td>Promedio asistencias</td>
                <td></td>
              </tr>
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
      jovenes();
      longevos();
    </script>

  </body>

  </html>   