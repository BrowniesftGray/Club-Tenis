<?php
session_name("aplicacion");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Club de Tenis</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/blog-home.css" rel="stylesheet">
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
    <script type="text/javascript" src="jquery-ui/jquery-ui.js"></script>
    <script src="script/index.js"></script>

    <style>
      .cerrarSesion{
        margin-left: 10%;
        width: 80%;
      }

    </style>

  </head>

  <body>
    <?php

      if (isset($_POST["destruirSesion"])) {
        session_destroy();
        header("location: index.php");
      }

      if (!isset($_SESSION['tipo'])) {
        $_SESSION['tipo'] = "";
      }

      //print_r($_SESSION);
    ?>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Tenis Oromana</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" >
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Inicio
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="eventos.php">Eventos Deportivos</a>
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
                  <li><a class="dropdown-item" id="listadoSocios" href="listados.php?Socios=1">Listado de socios</a></li>
                  <li><a class="dropdown-item" id="listadoEventos" href="listados.php?Eventos=1">Listado de eventos</a></li>
                  <li><a class="dropdown-item" id="listadosInscritos" href="listados.php?Inscritos=1">Listado de inscritos a un evento</a></li>
                  <li><a class="dropdown-item" id="listadoResultados" href="listados.php?Evento=1">Listado de resultados de un evento</a></li>
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
                  <li><a class="dropdown-item" href="procesos/login.php">Conectarse</a></li>
                  <li><a class="dropdown-item" href="#" id="Registro">Registrarse</a></li>

                  <?php
                }
                  if ($_SESSION['tipo'] == "Administrador") {
                    ?>

                    <!-- Admins only-->
                  <li><a class="dropdown-item" id="altaUsuario" href="#">Alta de Usuario</a></li>
                  <li><a class="dropdown-item" id="modificacionUsuario" href="procesos/editarUsuario.php">Modificación de Usuario</a></li>
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
<div id="formularios"></div>
<div id="divMensajes"><p id="pMensaje"></p></div>
    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

          <h1 class="my-4">Noticias
            <?php if ($_SESSION['tipo'] == "Administrador") {
            ?>
            <a href="procesos/nuevaNoticia.php" class="btn btn-success">Nueva Noticia</a>
            <?php
          }?>
          </h1>

          <?php

          $usuario = 'root';
$contraRoot = '';

try {
  $con = new PDO('mysql:host=localhost;dbname=u752794017_club;charset=UTF8', $usuario, $contraRoot);
  $mbd = null;
} catch (PDOException $e) {
  print "¡Error!: " . $e->getMessage() . "<br/>";
  die();
}



          //Realización de
          $sql = $con->prepare("SELECT * FROM noticias ORDER BY fechaPublicacion");
          $sql->execute();

          $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
          $total = count($rows);

          $Maximo = 5;
          $_SESSION['Totales'] = count($rows);
          $_SESSION['Paginas'] = ceil($_SESSION['Totales'] / $Maximo);

          if (!isset($_SESSION['Actual'])) {
            $_SESSION['Actual'] = 0;
            $_SESSION['PaginaActual'] = 1;
          }

          if ($_SESSION['Actual'] > $total) {
            $_SESSION['Actual'] = 0;
            $_SESSION['PaginaActual'] = 1;
          }

          if (isset($_POST['Siguiente'])) {
            $_SESSION['Actual'] = $_SESSION['Actual'] + $Maximo;
            $_SESSION['PaginaActual'] = $_SESSION['PaginaActual'] + 1;
            if ($_SESSION['PaginaActual'] > $_SESSION['Paginas']) {
              $_SESSION['PaginaActual'] = $_SESSION['PaginaActual'] - 1;
              $_SESSION['Actual'] = $_SESSION['Actual'] - $Maximo;

            }
          }

          if (isset($_POST['Anterior'])) {
            $_SESSION['Actual'] = $_SESSION['Actual'] - $Maximo;
            $_SESSION['PaginaActual'] = $_SESSION['PaginaActual'] - 1;
            if ($_SESSION['PaginaActual'] <= 0 ) {
              $_SESSION['Actual'] = $_SESSION['Actual'] + $Maximo;
              $_SESSION['PaginaActual'] = $_SESSION['PaginaActual'] + 1;
            }
          }

          $Actual = $_SESSION['Actual'];
          $Limite = $_SESSION['PaginaActual'] * 5;

            if (count($rows) < $Limite) {
              $Limite = count($rows);
            }

            for ($n=$_SESSION['Actual']; $n < $Limite; $n++){
                echo '<div class="card mb-4">';
                  echo '<img class="card-img-top" src="'.$rows[$n]['rutaImagen'].'">';
                  echo '<div class="card-body">';
                    echo '<h2 class="card-tittle">';
                    echo $rows[$n]['titulo'];
                    echo "</h2>";
                    echo '<p class="card-text">';
                    echo $rows[$n]['descripcion'];
                    echo '</p>';
                    if ($_SESSION['tipo'] == 'Administrador') {
                      echo '<a href="procesos/editarNoticia.php?idNoticia='.$rows[$n]['idNoticias'].'" id="editarNoticia'.$n.'" class="btn btn-primary">&uarr; Editar</a>'; //href="editarNoticia.php?idNoticia=$rows[$n]['idNoticia']"
                      echo ' <a href="procesos/borrarNoticia.php?idNoticia='.$rows[$n]['idNoticias'].'" id="editarNoticia'.$n.'" class="btn btn-danger">X Borrar Noticia</a>';
                    }
                  echo '</div>';
                  echo '<div class="card-footer text-muted">';
                    echo 'Publicado en ';
                    echo $rows[$n]['fechaPublicacion'];
                    echo ', por ';
                    //Coger nombre usando el email de usuario fk
                    echo $rows[$n]['emailUsuarioFK'];
                  echo '</div>';
                echo '</div>';
              }

          ?>

          <!-- Pagination -->
          <form class="" action="index.php" method="post">

          <ul class="pagination justify-content-center mb-4">
            <li class="page-item">
              <?php
              if ($_SESSION['PaginaActual'] != 1) {
              ?>
              <button type="submit" class="btn page-link" name="Anterior">
                &larr; Anteriores
              </button>
            </li>
            <?php
          }
          echo "<button class='btn disabled'>";
          echo $_SESSION['PaginaActual'];
          echo " de ";
          echo $_SESSION['Paginas'];
          echo "</button>";

          if ($_SESSION['PaginaActual'] != $_SESSION['Paginas']) {
            # code...
           ?>
            <li class="page-item">
              <button type="submit" class="btn page-link" name="Siguiente">
                Siguientes &rarr;
              </button>
            </li>
          </ul>
          <?php
        }

           ?>

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

          <!-- Search Widget -->
          <div class="card my-4">
            <h5 class="card-header">Animación</h5>
            <div class="card-body">
                <?php
                $numero = rand(1, 6);
                $numero = $numero.".gif";
                echo '<img class="img-responsive col-12" src="gif/'.$numero.'" alt="">';
                ?>
            </div>
          </div>


        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Darío Gómez Mármol</p>
      </div>
      <!-- /.container -->
    </footer>
    <!-- Bootstrap core JavaScript -->


  </body>

</html>
