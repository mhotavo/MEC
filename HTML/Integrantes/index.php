

<div id="container">
<h2 align="center">Misioneros en Camino</h2>
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">

      <table class="table table-striped table-hover ">
        <thead>
          <tr>
            <th>Imagen</th>
            <th>Nombres</th>
            <th>Primer Apellido</th>
            <th>Segundo Apellido</th>
            <th>Celular</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody> 
      <?php while($row = mysqli_fetch_array($datos)){ ?>
            <tr>
            <td><img class="avatar" src="<?php  echo URL; ?>HTML/Integrantes/avatars/<?php echo  $row['IMAGEN']; ?>"> </td>
            <td><?php  echo $row['NOMBRES']; ?></td>
            <td><?php  echo $row['PRIMER_APELLIDO']; ?></td>
            <td><?php  echo $row['SEGUNDO_APELLIDO']; ?></td>
            <td><?php  echo $row['CELULAR']; ?></td>
            <td><a  class="btn btn-warning" href="<?php echo URL; ?>Integrantes/editar/<?php echo $row['DOCUMENTO']; ?>">Editar</a> 
                <a  class="btn btn-danger" href="<?php echo URL; ?>Integrantes/eliminar/<?php echo $row['DOCUMENTO']; ?>">Eliminar</a> </td>
          </tr>
      <?php 
          }
          ?>
        <!--  
          <tr class="info">
            <td>3</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
          </tr>
          <tr class="success">
            <td>4</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
          </tr>
          <tr class="danger">
            <td>5</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
          </tr>
          <tr class="warning">
            <td>6</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
          </tr>
          <tr class="active">
            <td>7</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
          </tr>-->
        </tbody>
      </table>

    </div>
    <div class="col-md-1"></div>
  </div>  
</div>
