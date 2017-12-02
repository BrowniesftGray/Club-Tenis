<?php

  if (!isset($_POST['btnAceptar'])) {
    
  }
  else{

  $id = $_POST['txtIdEvento'];
  $usuario = 'root';
  $contraseña = '';
  try {
    $con = new PDO('mysql:host=localhost;dbname=club', $usuario, $contraseña);
    $mbd = null;
  } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
  }

  //Realización de
  $sql = $con->prepare("SELECT jugadores.nombreJugador, competiciones.idCompeticion, competiciones.nombreEvento FROM ((inscripciones INNER JOIN jugadores ON inscripciones.idJugadorFK = jugadores.idJugador) INNER JOIN jugadores ON inscripciones.idJugadorFK = jugadores.idJugador) WHERE idCompeticion = $id");
  $sql->execute();

  while ($row = $sql->fetchAll(PDO::FETCH_ASSOC)) {
    //Se almacena en un array las filas que se vaya leyendo
    $data[] = $row;
  }

  echo json_encode($data);
}
?>
