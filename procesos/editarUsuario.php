<?php
session_name("aplicacion");
session_start();

include('../php/Mobile_Detect.php');
$detect = new Mobile_Detect();

if ( $detect->isAndroidtablet() || $detect->isIpad() || $detect->isBlackberrytablet() || $detect->isAndroid() || $detect->isIphone() || $detect->isMobile() ) {
echo '<div class="alert alert-warning alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>No tiene acceso a esta características en el móvil.</div>';
}
else{
  function conexion(){
    $usuario = 'root';
    $contraRoot = '';

    try {
      $con = new PDO('mysql:host=localhost;dbname=club;charset=UTF8', $usuario, $contraRoot);
      $mbd = null;
    } catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    return $con;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Site Properties -->
    <title>Editar Usuario</title>

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
  <?php
  include("../php/navbar.php");


  if ($_SESSION['tipo'] == 'Administrador') {

    if (isset($_POST['btnActualizar'])) {
      include("../php/Modificaciones/updateUsuario.php");
    }

  if (!isset($_POST['btnUsuario']) && !isset($_POST['btnActualizar'])) {
    ?>
    <div class="container form">
    <form class="form-horizontal" role="form" method="POST">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h2>Seleccionar Usuario</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-group has-danger">
                    <label class="sr-only" for="email">Usuario</label>
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <select class="form-control" name="elegirUsuario">
                          <?php
                          $con = conexion();

                          //Realización de
                          $sql = $con->prepare("SELECT * FROM usuarios");
                          $sql->execute();

                          $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                          for ($i=0; $i < count($row); $i++) {
                            echo '<option value="'.$row[$i]["emailUsuario"].'">';
                            echo $row[$i]['nombre'];
                            echo " - ";
                            echo $row[$i]['tipoPerfil'];
                            echo "</option>";
                          }
                          ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="padding-top: 1rem">
            <div class="col-md-3"></div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-success" name="btnUsuario">Seleccionar Usuario</button>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-danger active" name="btnVolver" formaction="../index.php"> Volver al Indice</button>
            </div>
        </div>
    </form>
</div>
    <?php
  }
  else {
    if (isset($_POST['elegirUsuario'])) {
      $email = $_POST['elegirUsuario'];
      # code...
    }
    else{
      $email = $_POST['txtEmail'];
    }

    $con = conexion();

    $sql2 = $con->prepare("SELECT * FROM usuarios WHERE emailUsuario='".$email."'");
    $sql2->execute();

    $row = $sql2->fetchAll(PDO::FETCH_ASSOC);

    $tipo = $row[0]['tipoPerfil'];

    //print_r($_SESSION);
    if ($tipo == 'Administrador' && $email != $_SESSION['email']) {
      echo '<div class="alert alert-warning alert-dismissable" role="alert">Un usuario administrador no puede modificar a otros.</div>';
    }
    else{


    ?>
    <div class="container">
    <form class="form-horizontal" role="form" method="POST">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h2>Actualizar Usuario</h2>
                <hr>
            </div>
        </div>
        <?php

        $nombre = $row[0]['nombre'];
        $contra = $row[0]['contra'];
        $direccion = $row[0]['direccion'];
        $telefono = $row[0]['telefono'];

        ?>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
              <div class="form-group has-danger">
                  <label class="sr-only" for="txtEmail">Email</label>
                  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                    <?php
                    echo '<input id="txtEmail" name="txtEmail" type="text" placeholder="ejemplo@correo.com" class="form-control" value="'.$email.'">';
                    ?>
                  </input>
                    </div>
                </div>
            </div>
          </div>

        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
              <div class="form-group has-danger">
                  <label class="sr-only" for="txtNombre">Nombre</label>
                  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                      <?php
                      echo '<input id="txtNombre" type="text" name="txtNombre" placeholder="Mario Sánchez" class="form-control" value="'.$nombre.'">';
                      ?>
                    </div>
                </div>
            </div>
          </div>

        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
              <div class="form-group has-danger">
                  <label class="sr-only" for="txtContra">Contraseña</label>
                  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                      <?php
                      echo '<input id="txtContra" type="password" name="txtContra" placeholder="cinco Caracteres Minimo" class="form-control" value="'.$contra.'">';
                      ?>
                    </input>
                    </div>
                </div>
            </div>
          </div>

        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
              <div class="form-group has-danger">
                  <label class="sr-only" for="txtDireccion">Direccion</label>
                  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                      <?php
                      echo '<input id="txtDireccion" type="text" name="txtDireccion" placeholder="Avenida de España, 14" class="form-control" value="'.$direccion.'">';
                      ?>
                    </input>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
              <div class="form-group has-danger">
                  <label class="sr-only" for="txtTelefono">Telefono</label>
                  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                      <?php
                      echo '<input id="txtTelefono" type="text" name="txtTelefono" placeholder="955 08 54 89" class="form-control" value="'.$telefono.'">';
                      ?>
                    </input>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
              <div class="form-group has-danger">
                  <label class="sr-only" for="txtTipo">Tipo de Usuario</label>
                  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                      <select class="form-control" id="txtTipo" name="txtTipo">
                        <option value="Usuario">Usuario</option>
                        <option value="Administrador">Administrador</option>
                      </select>
                    </div>
                </div>
            </div>
          </div>
        <div class="row" style="padding-top: 1rem">
            <div class="col-md-3"></div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-success" name="btnActualizar">Actualizar Usuario</button>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-danger active" name="btnVolver" formaction="../index.php"> Volver al Indice</button>
            </div>
        </div>
    </form>
</div>
    <?php
  }
  }
}
else{
  echo '<div class="alert alert-warning alert-dismissable" role="alert">No tiene acceso a este característica, <a href="../index.php">vuelva al inicio</a>.</div>';
}
}
  ?>
</body>
</html>
