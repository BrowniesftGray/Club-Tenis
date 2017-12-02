<?php

  $ganador = $_REQUEST['txtParticipante1'];
  $perdedor = $_REQUEST['txtParticipante2'];
  $competicion = $_REQUEST['idCompeticion'];
  $partido = $_REQUEST['idPartido'];

  $usuario = 'root';
  $contraseña = '';
  try {
    $con = new PDO('mysql:host=localhost;dbname=club', $usuario, $contraseña);
    $mbd = null;
  } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
  }
  $insertJugador = $con->prepare("INSERT INTO resultados (idPartidoFK, idPerdedor, idGanador, idCompeticionFK) VALUES ($partido, $ganador, $perdedor, $competicion)");
  $insertJugador->execute();

?>
