  <html>
  <head>
  	<?php include(HTML_DIR.'/overall/header.php') ?>
  </head>
  <body>
  	<?php include(HTML_DIR.'/overall/nav.php') ?>
  	<div id="container">
     <h2 align="center">Inasistentes</h2>
     <div class="">
       <div class="col-md-2"></div>
       <div class="col-md-8">

        <table class="table table-striped table-hover" id="integrantesTabla" >
         <thead>
          <tr><br>
           <div id="alert"  class="col-md-4"></div>
         </tr>
         <tr>
          <th>Nro</th>
          <th>Nombre</th>
          <th colspan="2">Estado</th>
        </tr>
      </thead>
      <tbody> 
        <?php foreach ($datos as $key => $value) {  ?>
          <tr>
            <td class=""><?php  echo $key+1; ?></td>
            <td class=""> <a href="<?php echo URL; ?>Integrantes/ver/<?php echo $value['Documento']; ?>"><?php  echo $value['Nombre']; ?> </a></td>
            <td style="color:red;font-weight: bold;"><?php  echo $value['Estado']; ?></td>
            <td>
              <a  class="btn btn-danger" onclick="DeleteItem('¿Está seguro de eliminar este Integrante?','<?php echo URL; ?>Integrantes/eliminar/<?php echo $value['Documento']; ?>')" >Borrar</a> 
            </td>
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
</body>
</html>   