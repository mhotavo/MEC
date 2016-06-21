<nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo URL; ?>Integrantes">Misioneros en Camino</a>
          </div>

          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Agregar <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="<?php echo URL; ?>Integrantes/agregar">Integrante</a></li>
                  <li class="divider"></li>
                  <li><a href="<?php echo URL; ?>Familiares/agregar">Familiar</a></li>
                  <li class="divider"></li>
                  <li><a href="<?php echo URL; ?>Temas/agregar">Tema</a></li>

                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav">

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> Listar <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="<?php echo URL; ?>Integrantes">Integrantes</a></li>
                  <li class="divider"></li>
                  <li><a href="<?php echo URL; ?>Familiares">Familiares</a></li>
                  <li class="divider"></li>
                  <li><a href="<?php echo URL; ?>Temas">Temas</a></li>

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
                </ul>
              </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
              <li><a href="<?php echo URL; ?>Logout"> Salir  <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
            </ul>
          </div>
        </div>
      </nav>