<?php
session_name("aplicacion");
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Site Properties -->
    <title>Borrar Noticia</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/blog-home.css" rel="stylesheet">
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../jquery-ui/jquery-ui.css">
    <script type="text/javascript" src="../jquery-ui/jquery-ui.js"></script>
    <script src="../script/index.js"></script>
    <style>
      .container{
        margin-top: 4%;
      }
    </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Tenis Oromana</a>
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
            <a class="nav-link" href="#">Eventos Deportivos</a>
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
                <li><a class="dropdown-item" id="listadoSocios" href="#">Listado de socios</a></li>
                <li><a class="dropdown-item" id="listadoEventos" href="#">Listado de eventos</a></li>
                <li><a class="dropdown-item" id="listadosInscritos" href="#">Listado de inscritos a un evento</a></li>
                <li><a class="dropdown-item" id="listadoResultados" href="#">Listado de resultados de un evento</a></li>
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
  <?php

  if ($_SESSION['tipo'] == 'Administrador') {

    if (isset($_POST["btnNoticia"])) {
        include("../php/Borrado/deleteNoticia.php");
    }

  ?>
        <div class="container">
        <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h2>¿Quieres borrar esta noticia?</h2>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group has-danger">
                        <label class="sr-only" for="txtTitulo">Titulo</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">

                                   <?php
                                     $usuario = 'root';
                                     $contraRoot = '';

                                     try {
                                       $con = new PDO('mysql:host=localhost;dbname=club', $usuario, $contraRoot);
                                       $mbd = null;
                                     } catch (PDOException $e) {
                                         print "¡Error!: " . $e->getMessage() . "<br/>";
                                         die();
                                     }

                                     //Realización de
                                     $idNoticia = $_GET['idNoticia'];
                                     $sql = $con->prepare("SELECT * FROM noticias WHERE idNoticias = ".$idNoticia."");
                                     $sql->execute();

                                     $row = $sql->fetchAll(PDO::FETCH_ASSOC);
                                     $titulo = $row[0]['titulo'];
                                     $desc = $row[0]['descripcion'];

                                     echo '<input type="text" name="txtTitulo" class="form-control" id="titulo" placeholder="Titulo de prueba" autofocus value="'.$titulo.'">';


                                    echo '<input type="hidden" name="idNoticia" value="'.$idNoticia.'">';
                                   ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="sr-only" for="txtDescripcion">Descripcion</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <textarea name="txtDescripcion" class="form-control" id="txtDescripcion" placeholder="Descripcion" rows="6">
                                   <?php echo $desc; ?>
                                 </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-top: 1rem">
                <div class="col-md-3"></div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-warning" name="btnNoticia">Sí, borrar noticia <i class="fa fa-plus-square"></i></button>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-danger active" name="btnVolver" formaction="../index.php"><i class="fa fa-undo"></i> No, volver al Indice</button>
                </div>
            </div>
        </form>
    </div>
    <?php
  }
  else{
    echo '<div class="alert alert-warning alert-dismissable" role="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button><a href="login.php>"conéctese</a>';
  }
    ?>
</body>
</html>
