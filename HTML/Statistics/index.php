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
        <div class="col-xs-12  col-sm-8 col-sm-offset-2 ">
          <div class="row">
          <div class="col-xs-12 col-sm-6 "><h5 class="text-primary">Promedio de Edad</h5></div>
            <div class="col-xs-12 col-sm-6  "><h5 class="text-success"><b><?php echo number_format($datos['edad'], 2); ?> Años</b></h5></div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-6"><h5  class="text-primary">Nro. de Mujeres</h5></div>
            <div class="col-xs-12 col-sm-6"><h5 class="text-success"><b><?php echo $datos['mujeres']; ?></b></h5></div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-6"><h5  class="text-primary">Nro. de Hombres</h5></div>
            <div class="col-xs-12 col-sm-6"><h5 class="text-success"><b><?php echo $datos['hombres']; ?></b></h5></div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-6"><h5  class="text-primary">Promedio de Asistencia</h5><small class="TextSmall text-primary">En dos (2) meses</small></div>
            <div class="col-xs-12 col-sm-6"><h5 class="text-success"><b><?php echo number_format($datos['asistencias'], 2); ?></b></h5></div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-6"><h5  class="text-primary">Los de Mayor Edad</h5></div>
            <div class="col-xs-12 col-sm-6">
             <ul id="longevos">
             </ul>
           </div>
         </div>
         <div class="row">
           <div class="col-xs-12 col-sm-6"><h5  class="text-primary">Los De Menor Edad</h5></div>
           <div class="col-xs-12 col-sm-6">
            <ul id="jovenes">
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-6"><h5  class="text-primary">Los que Más Asisten</h5></div>
          <div class="col-xs-12 col-sm-6">
            <ul id="participativos">
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-6"><h5  class="text-primary">Los que Menos Asisten</h5></div>
          <div class="col-xs-12 col-sm-6">
           <ul id="NoParticipativos">
           </ul>
         </div>
       </div>
     </div>
   </div>  
 </div>

 <?php include(HTML_DIR.'/overall/footer.php') ?> 
 <script type="text/javascript" src="Views/DataTables/media/js/jquery.dataTables.js"></script>
 <script type="text/javascript" src="Views/DataTables/media/js/dataTables.bootstrap.js"></script>
 <script type="text/javascript">
  jovenes();
  longevos();
  masParticipativos();
  menosParticipativos();
</script>

</body>

</html>   