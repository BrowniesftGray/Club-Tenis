<?php

  $resultado = $_REQUEST['elegirResultado'];
  $contrincante = $_REQUEST['elegirContrincante'];
  $competicion = $_REQUEST['idCompeticion'];
  $fase = $_REQUEST['numFase'];
  $jugador = $_SESSION['idJugador'];

  $usuario = 'root';
$contraRoot = '';

try {
  $con = new PDO('mysql:host=localhost;dbname=club;charset=UTF8', $usuario, $contraRoot);
  $mbd = null;
} catch (PDOException $e) {
  print "¡Error!: " . $e->getMessage() . "<br/>";
  die();
}


  if ($resultado == 0) {
    # code...
    $insertarResultado = $con->prepare("INSERT INTO resultados (idPerdedor, idGanador, idCompeticionFK, Fase) VALUES ($contrincante, $jugador, $competicion, $fase)");
  }
  else{
    $insertarResultado = $con->prepare("INSERT INTO resultados (idPerdedor, idGanador, idCompeticionFK, Fase) VALUES ($jugador, $contrincante,$competicion, $fase)");
  }
  $insertarResultado->execute();

?>
