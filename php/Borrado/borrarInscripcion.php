<?php

  $id = $_REQUEST['idCompeticion'];
  $idJugador = $_SESSION['idJugador'];

  $usuario = 'root';
$contraRoot = '';

try {
  $con = new PDO('mysql:host=localhost;dbname=u752794017_club;charset=UTF8', $usuario, $contraRoot);
  $mbd = null;
} catch (PDOException $e) {
  print "¡Error!: " . $e->getMessage() . "<br/>";
  die();
}


  $insertarCompeticion = $con->prepare("DELETE FROM inscripciones WHERE idCompeticionFK = $id AND idJugadorFK = $idJugador");
  $insertarCompeticion->execute();

  $insertarCompeticion = $con->prepare("UPDATE transporte SET espacioDisponible=espacioDisponible+1 WHERE idCompeticionFK = $id AND idJugadorFK = $idJugador");
  $insertarCompeticion->execute();

  echo '<div class="alert alert-warning alert-dismissable" role="alert">Se ha borrado su inscripcion.</div>';

?>
