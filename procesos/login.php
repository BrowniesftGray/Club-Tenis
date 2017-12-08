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
    <title>Conexion</title>

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
</head>
<body>
  <body>
    <?php

      if (isset($_POST["destruirSesion"])) {
        session_destroy();
        header("location: ../index.php");
      }

      if (!isset($_SESSION['tipo'])) {
        $_SESSION['tipo'] = "";
      }

    include("../php/navbar.php");


    if (isset($_POST["btnLogin"])) {
      $email = $_POST['email'];
      $contra = $_POST['txtContra'];

      $bValido = true;
      $sError = "";

      if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email)) {
        $sError = "";
      }
      else{
        $sError .= "No tiene un formato de email correcto.<br>";
        $bValido = false;

      }

      if (preg_match("/^[a-zA-Z\ñ\Ñ\w\d\D\s\S]{5,45}$/", $contra)) {
        $sError = "";
      }
      else{
        $sError .= "La contraseña debe tener 6 dígitos o más";
        $bValido = false;
      }

      if ($bValido == false) {
        echo '<div class="alert alert-warning alert-dismissable" role="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button> '.$sError.'</div>';
      }
      else{
        include("../php/comprobarConexion.php");
      }
    }

  ?>
        <div class="container form">
        <form class="form-horizontal" role="form" method="POST">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h2>Conexión al club</h2>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group has-danger">
                        <label class="sr-only" for="email">E-Mail</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                            <input type="text" name="email" class="form-control" id="email"
                                   placeholder="nombre@prueba.com" required autofocus>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="sr-only" for="txtContra">Contraseña</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                            <input type="password" name="txtContra" class="form-control" id="txtContra"
                                   placeholder="Contraseña" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-top: 1rem">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success" name="btnLogin"><i class="fa fa-sign-in"></i> Conectarse</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
