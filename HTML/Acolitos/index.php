  <html>
  <head>
    <?php include(HTML_DIR.'/overall/header.php') ?>
  </head>
  <body>
    <?php include(HTML_DIR.'/overall/nav.php') ?>
    <div id="container">

     <h3 align="center">Horario Domingo</h3>
     <div class="col-md-2 col-xs-2"></div>
     <div class="col-md-8">
      <table class="table table-striped table-hover ">
        <thead >
          <tr >
            <th>Día</th>
            <th >Hora</th>
            <th>Acolitos</th>
          </tr>
        </thead>
        <tbody>
          <tr>

            <td class="col-md-3" id="fecha08">Domingo</td>
            <td class="col-md-3" id="08"><b>08:00 AM </b></td>
            <td class="col-md-6" id="acolitos08"></td>
          </tr>
          <tr>
            <td id="fecha11">Domingo</td>
            <td id="11"><b>11:00 AM</b></td>
            <td id="acolitos11"></td>
          </tr>
          <tr>
            <td id="fecha05">Domingo</td>
            <td id="06"><b>05:00 PM</b></td>
            <td id="acolitos05"></td>
          </tr>
          <tr>
            <td id="fecha06">Domingo</td>
            <td id="06"><b>06:00 PM</b></td>
            <td id="acolitos06"></td>
          </tr>
        </tbody>
      </table> 
    </div>
    <div class="col-md-2 col-xs-2"></div>
    <div class="col-md-12"></div>
    <h3 class="col-md-12" align="center">Horario Semana</h3>
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <table class="table table-striped table-hover ">
        <thead >
          <tr >
            <th>Día</th>
            <th class='hidden-xs'>Hora</th>
            <th>Acolitos</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="col-md-3" id="fechaLunes"><b>Lunes</b> <span style="font-size: 11px" class="hidden-xs"><br>(No hay misa)</span></td>
            <td class='hidden-xs' class="col-md-3" id="horarioLunes"></td>
            <td class="col-md-6" id="acolitosLunes" name="acolitosLunes"></td>
          </tr>
          <tr>
            <td id="fechaMartes"><b>Martes</b> <span style="font-size: 11px" class="hidden-xs"><br>(No hay misa)</span></td>
            <td class='hidden-xs' id="horarioMartes"></td>
            <td id="acolitosMartes"></td>
          </tr>
          <tr>
            <td id="fechaMiercoles"><b>Miercoles</b> <span style="font-size: 11px" class="hidden-xs"><br>(No hay misa)</span></td>
            <td class='hidden-xs' id="horarioMiercoles"></td>
            <td id="acolitosMiercoles"></td>
          </tr>
          <tr>
            <td id="fechaJueves"><b>Jueves</b> <span style="font-size: 11px" class="hidden-xs"><br>(No hay misa)</span></td>
            <td class='hidden-xs' id="horarioJueves"></td>
            <td id="acolitosJueves"></td>
          </tr>
          <tr>
            <td id="fechaViernes"><b>Viernes</b> <span style="font-size: 11px" class="hidden-xs"><br>(No hay misa)</span></td>
            <td class='hidden-xs' id="horarioViernes"></td>
            <td id="acolitosViernes"></td>
          </tr>
          <tr>
            <td id="fechaSabado"><b>Sabado</b> <span style="font-size: 11px" class="hidden-xs"><br>(No hay misa)</span></td>
            <td class='hidden-xs' id="horarioSabado"></td>
            <td id="acolitosSabado"></td>
          </tr>
        </tbody>
      </table> 
    </div>
    <div class="col-md-2"></div>

  </div>
  <?php include(HTML_DIR.'/overall/footer.php') ?> 
  <script>
/*=========================================================
=======================Cargar Horario Dominical============
==========================================================*/
$.getJSON('Integrantes/AcolitosJSON',{dia:'Domingo'}, function(resp){
  for (var i in resp) 
  {
    switch(resp[i].HORARIO) {
      case "08:00AM" : 
      $("#acolitos08").append("<i class='fa fa-hand-o-right' aria-hidden='true'></i> "+resp[i].NOMBRE+"<br>");
      $("#fecha08").empty();
      $("#fecha08").append("<b>Domingo</b> <span class='hidden-xs' style='font-size:11px;'>("+resp[i].FECHA.slice(8,10)+"-"+mesLetras(resp[i].FECHA.slice(5,7))+")</span>" );

      break;         
      case "11:00AM" : 
      $("#acolitos11").append("<i class='fa fa-hand-o-right' aria-hidden='true'></i> "+resp[i].NOMBRE+"<br>");
      $("#fecha11").empty();
      $("#fecha11").append("<b>Domingo</b> <span class='hidden-xs' style='font-size:11px;'>("+resp[i].FECHA.slice(8,10)+"-"+mesLetras(resp[i].FECHA.slice(5,7))+")</span>" );

      break;
      case "05:00PM" : 
      $("#acolitos05").append("<i class='fa fa-hand-o-right' aria-hidden='true'></i> "+resp[i].NOMBRE+"<br>");
      $("#fecha05").empty();
      $("#fecha05").append("<b>Domingo</b> <span class='hidden-xs' style='font-size:11px;'>("+resp[i].FECHA.slice(8,10)+"-"+mesLetras(resp[i].FECHA.slice(5,7))+")</span>" );

      break;
      case "06:00PM" : 
      $("#acolitos06").append("<i class='fa fa-hand-o-right' aria-hidden='true'></i> "+resp[i].NOMBRE+"<br>");
      $("#fecha06").empty();
      $("#fecha06").append("<b>Domingo</b> <span class='hidden-xs' style='font-size:11px;'>("+resp[i].FECHA.slice(8,10)+"-"+mesLetras(resp[i].FECHA.slice(5,7))+")</span>" );

      break;       
    }
  }
}).error(function(e){
  console.log(e);
})

/*=========================================================
=========================Cargar Horario Semanal============
==========================================================*/
var dia = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"];
for (x = 0; x < dia.length; x++) {
  $.getJSON('Integrantes/AcolitosJSON',{dia:dia[x]}, function(resp){
    for (var i in resp) 
    {
      switch(resp[i].DIA) {
        case "Lunes" : 
        $("#acolitosLunes").append("<i class='fa fa-hand-o-right' aria-hidden='true'></i> "+resp[i].NOMBRE+"<br>");
        $("#horarioLunes").empty();
        $("#horarioLunes").append(resp[i].HORARIO);
        $("#fechaLunes").empty();
        $("#fechaLunes").append("<b>Lunes</b><br> <span  style='font-size:11px;'>("+resp[i].FECHA.slice(8,10)+"-"+mesLetras(resp[i].FECHA.slice(5,7))+")</span>" );
        break;         
        case "Martes" : 
        $("#acolitosMartes").append("<i class='fa fa-hand-o-right' aria-hidden='true'></i> "+resp[i].NOMBRE+"<br>");
        $("#horarioMartes").empty();
        $("#horarioMartes").append(resp[i].HORARIO);
        $("#fechaMartes").empty();
        $("#fechaMartes").append("<b>Martes</b><br> <span  style='font-size:11px;'>("+resp[i].FECHA.slice(8,10)+"-"+mesLetras(resp[i].FECHA.slice(5,7))+")</span>" );

        break;
        case "Miercoles" : 
        $("#acolitosMiercoles").append("<i class='fa fa-hand-o-right' aria-hidden='true'></i> "+resp[i].NOMBRE+"<br>");
        $("#horarioMiercoles").empty();
        $("#horarioMiercoles").append(resp[i].HORARIO);
        $("#fechaMiercoles").empty();
        $("#fechaMiercoles").append("<b>Miercoles</b><br> <span  style='font-size:11px;'>("+resp[i].FECHA.slice(8,10)+"-"+mesLetras(resp[i].FECHA.slice(5,7))+")</span>" );

        break;
        case "Jueves" : 
        $("#acolitosJueves").append("<i class='fa fa-hand-o-right' aria-hidden='true'></i> "+resp[i].NOMBRE+"<br>");
        $("#horarioJueves").empty();
        $("#horarioJueves").append(resp[i].HORARIO);
        $("#fechajueves").empty();
        $("#fechajueves").append("<b>Jueves</b><br> <span  style='font-size:11px;'>("+resp[i].FECHA.slice(8,10)+"-"+mesLetras(resp[i].FECHA.slice(5,7))+")</span>" );

        break;
        case "Viernes" :  
        $("#acolitosViernes").append("<i class='fa fa-hand-o-right' aria-hidden='true'></i> "+resp[i].NOMBRE+"<br>");
        $("#horarioViernes").empty();
        $("#horarioViernes").append(resp[i].HORARIO);
        $("#fechaViernes").empty();
        $("#fechaViernes").append("<b>Viernes</b> <br><span   style='font-size:11px;'>("+resp[i].FECHA.slice(8,10)+"-"+mesLetras(resp[i].FECHA.slice(5,7))+")</span>" );

        break;
        case "Sabado" : 
        $("#acolitosSabado").append("<i class='fa fa-hand-o-right' aria-hidden='true'></i> "+resp[i].NOMBRE+"<br>");
        $("#horarioSabado").empty();
        $("#horarioSabado").append(resp[i].HORARIO);
        $("#fechaSabado").empty();
        $("#fechaSabado").append("<b>Sabado</b><br> <span  style='font-size:11px;'>("+resp[i].FECHA.slice(8,10)+"-"+mesLetras(resp[i].FECHA.slice(5,7))+")</span>" );

        break;
      }
    }
  }).error(function(e){
    console.log(e);
  })
}
</script>
</body>
</html>   