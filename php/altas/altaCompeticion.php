<?php

  $nombre = $_REQUEST['txtNombreEvento'];
  $fecha = $_REQUEST['txtfechaEvento'];
  $descripcion = $_REQUEST['txtDescripcion'];

  $usuario = 'root';
  $contraseña = '';
  try {
    $con = new PDO('mysql:host=localhost;dbname=club;charset=utf8', $usuario, $contraseña);
    $mbd = null;
  } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
  }

  //$fechaFinal = date("Y/m/d", strtotime($fecha));//fecha hoy

  $insertarCompeticion = $con->prepare("INSERT INTO competiciones (nombreEvento, fechaEvento, descripcion) VALUES ('$nombre','$fecha','$descripcion')");
  $insertarCompeticion->execute();

  echo '<div class="alert alert-warning alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert"></button>Se añadió la competición correctamente</div>';
?>
