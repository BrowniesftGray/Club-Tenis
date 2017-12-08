<?php

  $jugador = $_SESSION['idJugador'];
  $espacio = $_REQUEST['txtEspacio'];
  $competicion = $_REQUEST['elegirCompeticion'];

  $usuario = 'root';
  $contraseña = '';
  try {
    $con = new PDO('mysql:host=localhost;dbname=club;charset=UTF8', $usuario, $contraseña);
    $mbd = null;
  } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
  }
  $insertJugador = $con->prepare("INSERT INTO transporte (idJugadorFK, espacioDisponible, idCompeticionFK) VALUES ($jugador, $espacio, $competicion)");
  $insertJugador->execute();

  echo '<div class="alert alert-success alert-dismissable" role="alert">Se ha añdido el transporte.</div>';

?>
