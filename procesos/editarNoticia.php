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
    <title>Editar Noticia</title>

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
  <?php

  if ($_SESSION['tipo'] == 'Administrador') {
    if (isset($_GET['idNoticia'])) {


    if (isset($_POST["btnNoticia"])) {
        include("php/Modificaciones/updateNoticia.php");
    }

  ?>
        <div class="container">
        <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h2>Editar noticia</h2>
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
                            <textarea name="txtDescripcion" class="form-control" id="txtDescripcion" placeholder="Descripcion" rows="6"><?php echo $desc; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="imagen">Subir Imagen</label>
                  <div class="col-md-12">
                    <input id="imagen" type="file" name="imagen" class="form-control-file"/>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" style="padding-top: 1rem">
                <div class="col-md-3"></div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success" name="btnNoticia">Editar Noticia <i class="fa fa-plus-square"></i></button>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-danger active" name="btnVolver" formaction="../index.php"><i class="fa fa-undo"></i> Volver al Indice</button>
                </div>
            </div>
        </form>
    </div>
    <?php
    }
    else{
      echo '<div class="alert alert-warning fixed-top" role="alert">No ha ingresado de la forma correspondiente, <a href="../index.php">vuelva al inicio</a>.</div>';
    }
  }
  else{
    echo '<div class="alert alert-warning fixed-top" role="alert">No tiene acceso a este característica, <a href="../index.php">vuelva al inicio</a>.</div>';
  }
    ?>
</body>
</html>
