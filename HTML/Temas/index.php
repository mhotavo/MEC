

<div id="container">
  <h2 align="center">Temas</h2>
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-8">

      <table class="table table-striped table-hover dataTable" id="">
        <thead>
          <tr>
            <th>Tema</th>
            <th>Fecha</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody> 
          <?php while($row = mysqli_fetch_array($datos)){ ?>
          <tr>           
          <td><?php  echo $row['TEMA']  ?></td>
            <td><?php  echo $row['FECHA']; ?></td>
            <td><a  class="btn btn-warning" href="<?php echo URL; ?>Temas/editar/<?php echo $row['ID_TEMA']; ?>">Editar</a> 
              <a  class="btn btn-danger" onclick="DeleteItem('¿Está seguro de eliminar este familiar?','<?php echo URL; ?>Temas/eliminar/<?php echo $row['ID_TEMA']; ?>')" >Eliminar</a> </td>
            </tr>
            <?php 
          }
          ?>

        </tbody>
      </table>

    </div>
    <div class="col-md-2"></div>
  </div>  
</div>
