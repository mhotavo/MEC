

<div id="container">
  <h2 align="center">Registro de Asistencia</h2>
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <form class="form-horizontal" enctype="multipart/form-data" method="POST">
        <table class="table table-striped table-hover dataTable" id="integrantesTabla" >
          <thead>
            <tr>
             <div class="form-group">
               <label for="fechaAsistencia">Fecha:</label>
               <input type="date" name="fechaAsistencia" value="<?php echo date('Y-m-d'); ?>">
             </div>
           </tr>
           <tr>
            <th>Nombres</th>
            <th>Primer Apellido</th>
            <th>Genero</th>
            <th>Asistio</th>
          </tr>
        </thead>
        <tbody> 
          <?php while($row = mysqli_fetch_array($datos)){ ?>
            <tr>
              <td><?php  echo $row['NOMBRES']; ?></td>
              <td><?php  echo $row['PRIMER_APELLIDO']; ?></td>
              <td><?php  echo $row['GENERO']; ?></td>
              <td>  
                <input type="hidden" value="<?php echo $row['DOCUMENTO'] ?>" name="documento_<?php echo $row['DOCUMENTO'] ?>">
                <input type="radio" checked name="asistencia_<?php echo $row['DOCUMENTO'] ?>" value="1"> <span style="color:green;font-weight: bold">Si</span>
                <input type="radio" name="asistencia_<?php echo $row['DOCUMENTO'] ?>" value="0"> <span style="color:red;font-weight: bold">No</span>

              </td>
            </tr>
            <?php 
          }
          ?>

        </tbody>
      </table>
      <div class="form-group" align="center" style="padding-top: 4%;">
        <button type="submit" class="btn btn-success">Guardar</button>
      </div>
    </form>
  </div>
  <div class="col-md-2"></div>
</div>  
</div>
