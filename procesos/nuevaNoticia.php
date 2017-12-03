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
    <title>Nueva Noticia</title>

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

    if (isset($_POST["btnNoticia"])) {
      $titulo = $_POST['txtTitulo'];
      $descripcion = $_POST['txtDescripcion'];

      $bValido = true;
      $sError = "";

      if (preg_match("/^[a-zA-z\s\ñ\Ñ\w\d\D]{5,45}$/",$titulo)) {
      }
        else{

        $sError .= "El título requiere de al menos 5 caracteres.<br>";
        $bValido = false;

      }

      if (preg_match("/^[a-zA-z\s\ñ\Ñ\w\d\D]{5,2000}$/", $descripcion)) {
      }
        else{

        $sError .= "La descripcion debe tener una longitud mínima de 5 caracteres y un máximo de 2000.";
        $bValido = false;
      }

      if ($bValido == false) {
        echo '<div class="alert alert-warning fixed-top" role="alert">'.$sError.'</div>';
      }
      else{
        include("../php/altas/altaNoticia.php");
      }
    }

  ?>
        <div class="container">
        <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h2>Añadir Noticia</h2>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group has-danger">
                        <label class="sr-only" for="txtTitulo">Titulo</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <input type="text" name="txtTitulo" class="form-control" id="titulo"
                                   placeholder="Titulo de prueba" autofocus>
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
                            <textarea name="txtDescripcion" class="form-control" id="txtDescripcion"
                                   placeholder="Descripcion" rows="6"></textarea>
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
                    <button type="submit" class="btn btn-success" name="btnNoticia">Añadir Noticia <i class="fa fa-plus-square"></i></button>
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
    echo "No tiene acceso a esta característica, <a href='login.php'>conéctese</a>.";
  }
    ?>
</body>
</html>
