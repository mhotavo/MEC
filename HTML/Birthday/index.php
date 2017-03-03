  <html>
  <head>
    <?php include(HTML_DIR.'/overall/header.php') ?>
    <link rel="stylesheet" type="text/css" href="Views/DataTables/media/css/dataTables.bootstrap.css">
  </head>
  <body>
    <?php include(HTML_DIR.'/overall/nav.php') ?>
    <div id="container">
      <h2 align="center">Cumpleaños</h2>
      <div class="">
        <div class="col-md-3"></div>
        <div class="col-md-6">

          <table class="table table-striped table-hover" id="birthdays" >
            <thead>
              <tr  class='hidden' id="01">
                <td colspan='4' align='center'>
                  Enero <i class='fa fa-phone' aria-hidden='true'></i>
                </td>
              </tr>
              <tr  class='hidden' id="02">
                <td colspan='4' align='center'>
                  Febrero <i class='fa fa-phone' aria-hidden='true'></i>
                </td>
              </tr>
              <tr  class='hidden' id="03">
                <td colspan='4' align='center'>
                  Marzo <i class='fa fa-phone' aria-hidden='true'></i>
                </td>
              </tr>
              <tr  class='hidden' id="04">
                <td colspan='4' align='center'>
                  Abril <i class='fa fa-phone' aria-hidden='true'></i>
                </td>
              </tr>
              <tr  class='hidden' id="05">
                <td colspan='4' align='center'>
                  Mayo <i class='fa fa-phone' aria-hidden='true'></i>
                </td>
              </tr>
              <tr  class='hidden' id="06">
                <td colspan='4' align='center'>
                  Junio <i class='fa fa-phone' aria-hidden='true'></i>
                </td>
              </tr>
              <tr  class='hidden' id="07">
                <td colspan='4' align='center'>
                  Julio <i class='fa fa-phone' aria-hidden='true'></i>
                </td>
              </tr>
              <tr  class='hidden' id="08">
                <td colspan='4' align='center'>
                  Agosto <i class='fa fa-phone' aria-hidden='true'></i>
                </td>
              </tr>
              <tr  class='hidden' id="09">
                <td colspan='4' align='center'>
                  Septiembre <i class='fa fa-phone' aria-hidden='true'></i>
                </td>
              </tr>
              <tr  class='hidden' id="10">
                <td colspan='4' align='center'>
                  Octubre <i class='fa fa-phone' aria-hidden='true'></i>
                </td>
              </tr>
              <tr  class='hidden' id="11">
                <td colspan='4' align='center'>
                  Noviembre <i class='fa fa-phone' aria-hidden='true'></i>
                </td>
              </tr>
              <tr  class='hidden' id="12">
                <td colspan='4' align='center'>
                  Diciembre <i class='fa fa-phone' aria-hidden='true'></i>
                </td>
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
      $(document).ready(


        function birthday() {
          $("#alert").empty();
          var fecha = $("#fechaAsistencia").val();
          $.getJSON('Integrantes/birthdayJSON', {
            fecha: fecha
          }, function(resp) {
           for (var i in resp) {


            $("#birthdays > tbody").append("<tr id='" + resp[i].DOCUMENTO + "'>\
              <td>\
                <a href='Integrantes/editar/" + resp[i].DOCUMENTO + "'>" + resp[i].NOMBRE+ "</a>\
              </td>\
              <td>" 
                + resp[i].BIRTHDAY + " \
                <span style='color:#48A8CC; font-size:14px;font-weight:bold;'> - Faltan " + resp[i].FALTAN + " día(s) </span>\
              </td>\
              <td style='color:#ad3232; font-weight:bold;font-size:14px;'> " 
                + (resp[i].EDAD) + 
                " AÑOS  <i class='fa fa-birthday-cake' aria-hidden='true'></i>\
              </td>\
            </tr>");

          }

        }).error(function(e) {
          console.log(e);
        })
      }
      );

    </script>

  </body>

  </html>   