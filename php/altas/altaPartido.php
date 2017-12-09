<?php

  $jugador1 = $_REQUEST['txtParticipante1'];
  $jugador2 = $_REQUEST['txtParticipante2'];
  $competicion = $_REQUEST['idCompeticion'];
  $fase = $_REQUEST['txtFase'];

  $usuario = 'root';
$contraRoot = '';

try {
  $con = new PDO('mysql:host=localhost;dbname=club;charset=UTF8', $usuario, $contraRoot);
  $mbd = null;
} catch (PDOException $e) {
  print "¡Error!: " . $e->getMessage() . "<br/>";
  die();
}


  $insertJugador = $con->prepare("INSERT INTO partidos (idParticipante1, idParticipante2, idCompeticionFK, Fase) VALUES ($jugador1, $jugador2, $competicion,'$fase')");
  $insertJugador->execute();

?>
