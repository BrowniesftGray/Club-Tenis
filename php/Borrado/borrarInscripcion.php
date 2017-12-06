<?php

  $id = $_REQUEST['idCompeticion'];
  $idJugador = $_SESSION['idJugador'];

  $usuario = 'root';
  $contraseña = '';
  try {
    $con = new PDO('mysql:host=localhost;dbname=club', $usuario, $contraseña);
    $mbd = null;
  } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
  }
  $insertarCompeticion = $con->prepare("DELETE FROM inscripciones WHERE idCompeticionFK = $id AND idJugadorFK = $idJugador");
  $insertarCompeticion->execute();

  $insertarCompeticion = $con->prepare("DELETE FROM transporte WHERE idCompeticionFK = $id AND idJugadorFK = $idJugador");
  $insertarCompeticion->execute();

  echo '<div class="alert alert-warning alert-dismissable" role="alert">Se ha borrado su inscripcion.</div>';

?>
