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
    <title>Nueva Competición</title>

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
      .form{
        margin-top: 4%;
      }
    </style>
    <script type="text/javascript">
    $( function() {
      $( "#txtfechaEvento" ).datepicker({dateFormat: 'yy-mm-dd'});
    } );
    </script>
</head>
<body>
  <?php
    include("../php/navbar.php");
  ?>
  <div id="formularios"></div>
  <div id="divMensajes"><p id="pMensaje"></p></div>
  <?php

  if ($_SESSION['tipo'] == 'Administrador') {

    if (isset($_POST["btnCompeticion"])) {
      $nombreEvento = $_POST['txtNombreEvento'];
      $descripcion = $_POST['txtDescripcion'];

      $bValido = true;
      $sError = "";

      if (preg_match("/^[a-zA-Z\ñ\Ñ\w\d\D\s\S]{5,45}$/",$nombreEvento)) {
      }
        else{

        $sError .= "El título requiere de al menos 5 caracteres.<br>";
        $bValido = false;

      }

      if (preg_match("/^[a-zA-Z\ñ\Ñ\w\d\D\s\S]{5,2000}$/", $descripcion)) {
      }
        else{

        $sError .= "La descripcion debe tener una longitud mínima de 5 caracteres y un máximo de 2000.";
        $bValido = false;
      }

      if ($bValido == false) {
        echo '<div class="alert alert-warning alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$sError.'</div>';
      }
      else{
        include("../php/altas/altaCompeticion.php");
      }
    }

  ?>
        <div class="container form">
        <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h2>Añadir Competición</h2>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="label" for="txtNombreEvento">Nombre de Competición:</label>
                            <input type="text" name="txtNombreEvento" class="form-control" id="nombreEvento">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="txtfechaEvento">Fecha de Comienzo</label>
                            <input type="text" name="txtfechaEvento" class="form-control" id="txtfechaEvento">
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-6">
                <div class="form-group">
                    <label for="txtDescripcion">Descripcion</label>

                        <textarea name="txtDescripcion" class="form-control" id="txtDescripcion"
                               placeholder="Descripcion" rows="6"></textarea>
                </div>
              </div>
            </div>
            <div class="row" style="padding-top: 1rem">
                <div class="col-md-3"></div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success" name="btnCompeticion">Añadir Competición </button>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-danger active" name="btnVolver" formaction="../index.php"> Volver al Indice</button>
                </div>
            </div>
        </form>
    </div>
    <?php
  }
  else{
    echo '<div class="alert alert-warning alert-dismissable" role="alert">No tiene acceso a este característica, <a href="../index.php">vuelva al inicio</a>.</div>';
  }
    ?>
</body>
</html>
