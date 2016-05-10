

<div id="container">
<h2 align="center">Familiares</h2>
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">

      <table class="table table-striped table-hover dataTable" id="">
        <thead>
          <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Parentesco</th>
            <th>Integrante</th>
            <th>Celular</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody> 
      <?php while($row = mysqli_fetch_array($datos)){ ?>
            <tr>
            <td> <a href="<?php echo URL; ?>Familiares/ver/<?php echo $row['DOCUMENTO']; ?>"><img class="avatar" src="<?php  echo URL; ?>HTML/Integrantes/avatars/<?php echo  !empty($row['IMAGEN']) ? $row['IMAGEN'] : 'no-image.png'    ; ?>"> </a></td>
            <td><?php  echo $row['NOMBRES'] . " " . $row['PRIMER_APELLIDO']; ?></td>
            <td><?php  echo $row['PARENTESCO']  ?></td>
            <td><?php  echo $row['INTEGRANTE']; ?></td>
            <td><?php  echo $row['CELULAR']; ?></td>
            <td><a  class="btn btn-warning" href="<?php echo URL; ?>Familiares/editar/<?php echo $row['DOCUMENTO']; ?>">Editar</a> 
                <a  class="btn btn-danger" onclick="DeleteItem('¿Está seguro de eliminar este familiar?','<?php echo URL; ?>Familiares/eliminar/<?php echo $row['DOCUMENTO']; ?>')" >Eliminar</a> </td>
          </tr>
      <?php 
          }
          ?>

        </tbody>
      </table>

    </div>
    <div class="col-md-1"></div>
  </div>  
</div>
