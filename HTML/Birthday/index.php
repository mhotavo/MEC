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
      $(document).ready(


        function birthday() {
          $("#alert").empty();
          var fecha = $("#fechaAsistencia").val();
          $.getJSON('Integrantes/birthdayJSON', {
            fecha: fecha
          }, function(resp) {
            var esteMes = true;
            var hoyCumple = true;
            var proximos = true;
            for (var i in resp) {
              var date = resp[i].FECHA_NACIMIENTO.split("-");
              var day = date[2];
              var month = date[1];
              var hoy = new Date();
              var dd = hoy.getDate();
              var mm = hoy.getMonth() + 1;
            mm = ("0" + mm).slice(-2); // devolverá “01” si h=1; “12” si h=12
            if (mm == month && dd == day) {
              if (hoyCumple == true) {
                $("#birthdays > tbody").append("<tr  class='danger'><td colspan='4' align='center' style='font-weight:bold;color:#B21800'> HOY <i class='fa fa-phone' aria-hidden='true'></i></td></tr>");
                hoyCumple = false;
              }
              $("#birthdays > tbody").append("<tr id='" + resp[i].DOCUMENTO + "'><td><a href='Integrantes/ver/" + resp[i].DOCUMENTO + "'>" + resp[i].NOMBRES + " " + resp[i].PRIMER_APELLIDO + "</a></td><td>" + resp[i].FECHA_NACIMIENTO + " </td><td style='color:#ad3232; font-weight:bold;font-size:14px;'> " + (resp[i].EDAD - 1) + " AÑOS  <i class='fa fa-birthday-cake' aria-hidden='true'></i></td></tr>");
            } else if (mm == month) {
              if (esteMes == true) {
                $("#birthdays > tbody").append("<tr class='warning'><td colspan='4' align='center' style='font-weight:bold;color:#897604'> ESTE MES <i class='fa fa-clock-o' aria-hidden='true'></td></tr>");
                esteMes = false;
              }
              var falta = dd - day;
              $("#birthdays > tbody").append("<tr id='" + resp[i].DOCUMENTO + "'><td><a href='Integrantes/ver/" + resp[i].DOCUMENTO + "'>" + resp[i].NOMBRES + " " + resp[i].PRIMER_APELLIDO + "</a></td><td>" + resp[i].FECHA_NACIMIENTO + " <span style='color:#48A8CC; font-size:14px;font-weight:bold;'> - Faltan " + Math.abs(falta) + " día(s) </span></td><td style='color:#ad3232; font-weight:bold;'>  " + resp[i].EDAD + " AÑOS <i class='fa fa-birthday-cake' aria-hidden='true'></i></td></tr>");
            } else {
              if (proximos == true) {
                $("#birthdays > tbody").append("<tr  class='info'><td colspan='4' align='center' style='font-weight:bold;color:#3B246A'> PROXIMOS <i class='fa fa-calendar' aria-hidden='true'></i></td></tr>");
                proximos = false;
              }
              $("#birthdays > tbody").append("<tr id='" + resp[i].DOCUMENTO + "'><td><a href='Integrantes/ver/" + resp[i].DOCUMENTO + "'>" + resp[i].NOMBRES + " " + resp[i].PRIMER_APELLIDO + "</a></td><td>" + resp[i].FECHA_NACIMIENTO + "</td><td style='color:#ad3232; font-weight:bold;'>" + resp[i].EDAD + " AÑOS <i class='fa fa-birthday-cake' aria-hidden='true'></i></td></tr>");
            }
          }
          $("#birthdays > tbody").append("<tr'><td colspan='4' align='left' style='font-weight:bold;color:#818181;font-size:13px;'> " + resp.length + " <i class='fa fa-birthday-cake' aria-hidden='true'></i> Pendientes.</td></tr>");
          console.log();
        }).error(function(e) {
          console.log(e);
        })
      }
      );

    </script>

  </body>

  </html>   