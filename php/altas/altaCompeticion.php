<?php

  $nombre = $_REQUEST['txtNombreEvento'];
  $fecha = $_REQUEST['txtfechaEvento'];
  $descripcion = $_REQUEST['txtDescripcion'];

  $usuario = 'root';
$contraRoot = '';

try {
  $con = new PDO('mysql:host=localhost;dbname=u752794017_club;charset=UTF8', $usuario, $contraRoot);
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
