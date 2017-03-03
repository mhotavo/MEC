<html>
<head>
  <?php include(HTML_DIR.'/overall/header.php') ?>
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Views/DataTables/media/css/dataTables.bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Views/DataTables/media/css/buttons.dataTables.min.css">
</head>
<body>
  <?php include(HTML_DIR.'/overall/nav.php') ?>
  <div id="container-fluid">
    <h2 align="center">Integrantes</h2>
    <div class="col-md-1"></div>
    <div class="col-md-10">

      <table class="table table-striped table-hover dataTable" id="integrantesTabla" >
        <thead>
          <tr>
            <th></th>
            <th>Nombres</th>
            <th>Primer Apellido</th>
            <th class="hidden-xs">Genero</th>
            <th class="hidden-xs">Fecha Nacimiento</th>
            <th class="hidden-xs">Edad</th>
            <th class="hidden">Dirección</th>
            <th class="hidden-xs">Celular</th>
            <th class="hidden-xs">Fecha Ingreso</th>
            <th>Estado</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody> 
          <?php while($row = mysqli_fetch_array($datos)){ ?>
          <tr>
            <td> <a href="<?php echo URL; ?>Integrantes/ver/<?php echo $row['DOCUMENTO']; ?>"><img class="avatar" src="<?php  echo URL; ?>HTML/Integrantes/avatars/<?php echo  !empty($row['IMAGEN']) ? $row['IMAGEN'] : 'no-image.png'    ; ?>"> </a></td>

            <td><?php  echo $row['NOMBRES']; ?></td>
            <td><?php  echo $row['PRIMER_APELLIDO']; ?></td>
            <td class="hidden-xs"><?php  echo $row['GENERO']; ?></td>
            <td class="hidden-xs"><?php  echo $row['FECHA_NACIMIENTO']; ?></td>
            <td class="hidden-xs"><?php  echo $row['EDAD_ACTUAL']; ?></td>
            <td class="hidden"><?php  echo $row['DIRECCION']; ?></td>
            <td class="hidden-xs"><?php  echo $row['CELULAR']; ?></td>
            <td class="hidden-xs"><?php  echo $row['FECHA_INGRESO']; ?></td>
            <td><?php  echo $row['ESTADO']; ?></td>
            <td>
              <a  class="btn btn-warning" href="<?php echo URL; ?>Integrantes/editar/<?php echo $row['DOCUMENTO']; ?>"><i class="fa fa-wrench" aria-hidden="true"></i></a> 
            </td>
            <td>
            <a  class="btn btn-danger" onclick="DeleteItem('¿Está seguro de eliminar este Integrante?','<?php echo URL; ?>Integrantes/eliminar/<?php echo $row['DOCUMENTO']; ?>')" ><i class="fa fa-times" aria-hidden="true"></i></a> 
            </td>
          </tr>
          <?php 
        }
        ?>
      </tbody>
    </table>

  </div>
  <div class="col-md-1"></div>
</div>  

<?php include(HTML_DIR.'/overall/footer.php') ?> 
<script type="text/javascript" src="<?php echo URL; ?>Views/DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>Views/DataTables/media/js/dataTables.bootstrap.js"></script>

<!-- EXPORT -->
<script type="text/javascript" src="<?php echo URL; ?>Views/DataTables/media/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>Views/DataTables/media/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>Views/DataTables/media/js/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>Views/DataTables/media/js/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>Views/DataTables/media/js/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>Views/DataTables/media/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>Views/DataTables/media/js/buttons.print.min.js"></script>


<script type="text/javascript">
  $(document).ready(function() {
    $('.dataTable').DataTable({
      "iDisplayLength": 25,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "autoWidth": true,           
      "sPaginationType": "full_numbers",
      "order": [[ 9, 'asc' ], [ 1, 'asc' ]],
      dom: 'Bfrtip',
      buttons: [
      {
        extend: 'excelHtml5',
        title: 'InformeMec',
        exportOptions: {
          columns: [ 1,2,3,4,5,6,7,8,9 ]
        }
      },
      {
        extend: 'pdfHtml5',
        title: 'InformeMec',
        exportOptions: {
          columns: [ 1,2,3,4,5,6,7,8,9 ]
        },
        download: 'open'
      }
      ]
    });
  } );
</script>
</body>
</html>