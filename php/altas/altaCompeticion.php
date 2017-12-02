<?php

  $nombre = $_REQUEST['txtNombreEvento'];
  $fecha = $_REQUEST['txtFecha'];
  $descripcion = $_REQUEST['txtDescripcion'];

  $usuario = 'root';
  $contraseña = '';
  try {
    $con = new PDO('mysql:host=localhost;dbname=club', $usuario, $contraseña);
    $mbd = null;
  } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
  }
  $insertarCompeticion = $con->prepare("INSERT INTO competiciones (nombreEvento, fechaEvento, descripcion) VALUES ('$nombre','$fecha','$descripcion')");
  $insertarCompeticion->execute();

?>
