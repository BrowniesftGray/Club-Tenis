<style>
  .cerrarSesion{
    margin-left: 10%;
    width: 80%;
  }

</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" >
  <div class="container">
    <a class="navbar-brand" href="../index.php">Tenis Oromana</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="../index.php">Inicio
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../eventos.php">Eventos Deportivos</a>
        </li>
        <!-- Solo para admins, se abren en una pestaña nueva lista para imprimir o guardar en pdf-->
        <?php
          if ($_SESSION['tipo'] == "Administrador") {
        ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Listados
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" id="listadoSocios" href="../listados.php?Socios=1">Listado de socios</a></li>
              <li><a class="dropdown-item" id="listadoEventos" href="../listados.php?Eventos=1">Listado de eventos</a></li>
              <li><a class="dropdown-item" id="listadosInscritos" href="../listados.php?Inscritos=1">Listado de inscritos a un evento</a></li>
              <li><a class="dropdown-item" id="listadoResultados" href="../listados.php?Evento=1">Listado de resultados de un evento</a></li>
            </ul>
        </li>
        <?php
        }
      ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Panel de control de usuario
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <?php
              if ($_SESSION['tipo'] == "") {
                # code...
                ?>
              <!-- Quitar si se conecta alguien only-->
              <li><a class="dropdown-item" href="login.php">Conectarse</a></li>
              <li><a class="dropdown-item" href="#" id="Registro">Registrarse</a></li>

              <?php
            }
              if ($_SESSION['tipo'] == "Administrador") {
                ?>

                <!-- Admins only-->
              <li><a class="dropdown-item" id="modificacionUsuario" href="editarUsuario.php">Modificación de Usuario</a></li>
                <?php
              }

              if ($_SESSION['tipo'] != "") {
              ?>
              <hr>
               <!-- Colocar si se conecta alguien-->
               <form action="index.php" method="post">
                 <li>
                   <button type="submit" name="destruirSesion" class="btn btn-danger cerrarSesion">Cerrar Sesión</button>
                 </li>
               </form>
               <?php
             }

               ?>
            </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
