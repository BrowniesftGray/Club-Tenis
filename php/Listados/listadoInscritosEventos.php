<?php
  $id = $_REQUEST['IdEvento'];
  $usuario = 'root';
  $contraseña = '';
  try {
    $con = new PDO('mysql:host=localhost;dbname=club;charset=UTF8', $usuario, $contraseña);
    $mbd = null;
  } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
  }

  //Realización de
  $sql = $con->prepare("SELECT jugadores.nombreJugador, competiciones.nombreEvento FROM inscripciones INNER JOIN competiciones ON inscripciones.idCompeticionFK = competiciones.idCompeticion INNER JOIN jugadores ON inscripciones.idJugadorFK = jugadores.idJugador WHERE idCompeticionFK = $id");
  $sql->execute();

  while ($row = $sql->fetchAll(PDO::FETCH_ASSOC)) {
    //Se almacena en un array las filas que se vaya leyendo
    $data[] = $row;
  }

  echo json_encode($data);
?>
