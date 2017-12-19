<?php

  $jugador = $_SESSION['idJugador'];
  $espacio = $_REQUEST['txtEspacio'];
  $competicion = $_REQUEST['elegirCompeticion'];

  $usuario = 'root';
$contraRoot = '';

try {
  $con = new PDO('mysql:host=localhost;dbname=club;charset=UTF8', $usuario, $contraRoot);
  $mbd = null;
} catch (PDOException $e) {
  print "¡Error!: " . $e->getMessage() . "<br/>";
  die();
}

  $comprobarTransporte = $con->prepare("SELECT * FROM transporte WHERE idCompeticionFK = $competicion AND idJugadorFK = $jugador");
  $comprobarTransporte->execute();
  $comprobacion = $comprobarTransporte->fetchAll(PDO::FETCH_ASSOC);

  if (count($comprobacion) > 0) {
    echo '<div class="alert alert-warning alert-dismissable" role="alert">Ya añadió un transporte anteriormente.</div>';
  }
  else{
    $insertJugador = $con->prepare("INSERT INTO transporte (idJugadorFK, espacioDisponible, idCompeticionFK) VALUES ($jugador, $espacio, $competicion)");
    $insertJugador->execute();

    echo '<div class="alert alert-success alert-dismissable" role="alert">Se ha añdido el transporte.</div>';
  }

?>
