<?php

  $jugador = $_REQUEST['idJugador'];
  $espacio = $_REQUEST['txtEspacio'];

  $usuario = 'root';
  $contraseña = '';
  try {
    $con = new PDO('mysql:host=localhost;dbname=club', $usuario, $contraseña);
    $mbd = null;
  } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
  }
  $insertJugador = $con->prepare("INSERT INTO transporte (idJugadorFK, espacioDisponible) VALUES ($jugador, $espacio)");
  $insertJugador->execute();

?>
