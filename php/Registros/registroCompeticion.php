<?php

  $transporte = $_REQUEST['idTransporte'];
  $espacio = $_REQUEST['txtEspacio'];
  $competicion = $_REQUEST['idCompeticion'];
  $jugador = $_SESSION['idJugador'];

  $final = $espacio - 1;

  //Se modifica el valor de espacio disponible del transporte para evitar que se pueda apuntar más gente de la debida.
  $usuario = 'root';
  $contraseña = '';
  try {
    $con = new PDO('mysql:host=localhost;dbname=club', $usuario, $contraseña);
    $mbd = null;
  } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
  }
  $insertJugador = $con->prepare("UPDATE transporte SET espacioDisponible = $final WHERE idTransporte = $transporte");
  $insertJugador->execute();

  //Se inserta el registro en inscripciones.
  $registroCompeticion = $con->prepare("INSERT INTO inscripciones (idJugadorFK, idCompeticionFK, idTransporte) VALUES ($jugador, $competicion, $transporte)");
  $registroCompeticion->execute();

?>
