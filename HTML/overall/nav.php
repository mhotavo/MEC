<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="font-size: 17px" href="<?php echo URL; ?>Integrantes"><b>Misioneros</b> en Camino</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Integrantes <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
           <li><a href="<?php echo URL; ?>Integrantes/index">Listar</a></li>
           <li class="divider"></li>
           <li><a href="<?php echo URL; ?>Integrantes/agregar">Agregar</a></li>
           <li class="divider"></li>
         <!--  <li><a href="<?php echo URL; ?>Integrantes/otros">Otros</a></li>
           <li class="divider"></li>
           <li><a href="<?php echo URL; ?>Integrantes/informe">Informe</a></li>-->


         </ul>
       </li>
     </ul>
     <ul class="nav navbar-nav">

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Temas <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
         <li><a href="<?php echo URL; ?>Temas">Temas</a></li>
         <li class="divider"></li>
         <li><a href="<?php echo URL; ?>Temas/agregar">Agregar</a></li>
       </ul>
     </li>
   </ul>
   <ul class="nav navbar-nav">

    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Familiares <span class="caret"></span></a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo URL; ?>Familiares">Familiares</a></li>
        <li class="divider"></li>
        <li><a href="<?php echo URL; ?>Familiares/agregar">Agregar</a></li>
      </ul>
    </li>
  </ul>
  <ul class="nav navbar-nav">
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Acolitos <span class="caret"></span></a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo URL; ?>acolitos/dominical">Registrar Dominical</a></li>
        <li class="divider"></li>
        <li><a href="<?php echo URL; ?>acolitos/semanal">Registrar Semanal</a></li>
        <li class="divider"></li>
        <li><a href="<?php echo URL; ?>acolitos">Ver Horarios</a></li>
      </ul>
    </li>
  </ul>
  <ul class="nav navbar-nav">
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Asistencia <span class="caret"></span></a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo URL; ?>asistencia">Registrar Asistencia</a></li>
        <li class="divider"></li>
        <li><a href="<?php echo URL; ?>asistencia/ver">Ver Asistencia</a></li>
        <li class="divider"></li>
        <li><a href="<?php echo URL; ?>asistencia/inasistentes">Inasistentes</a></li>
      </ul>
    </li>
  </ul>
  <ul class="nav navbar-nav">
   <li><a href="<?php echo URL; ?>birthday"> Cumpleaños  <i class="fa fa-birthday-cake" aria-hidden="true"></i></a></li> 
 </ul>
 <ul class="nav navbar-nav">
   <li><a href="<?php echo URL; ?>statistics"> Estadisticas <i class="fa fa-bar-chart" aria-hidden="true"></i></i></a></li> 
 </ul>
 <ul class="nav navbar-nav navbar-right">

  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <b><?php echo ucwords(strtolower($_SESSION['nombre'])); ?> </b>  <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu">
      <li><a href="<?php echo URL; ?>miperfil">Mi Perfil</a></li>
    </ul>
  </li>

  <li><a href="<?php echo URL; ?>Logout">  Salir  <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
</ul>
</div>
</div>
</nav>