<?php

if (!isset($_POST['btnAceptar'])) {

}
else{
  $id = $_REQUEST['txtIdEvento'];
  $usuario = 'root';
  $contraseña = '';
  try {
    $con = new PDO('mysql:host=localhost;dbname=club', $usuario, $contraseña);
    $mbd = null;
  } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
  }

  //Ganador:(Select jugadores.nombreJugador, jugadores.idJugador, competiciones.nombreEvento from ((resultados INNER JOIN jugadores on resultados.idGanador = jugadores.idJugador) INNER JOIN competiciones on resultados.idCompeticionFK = competiciones.idCompeticion) WHERE idCompeticion = $id");
  //Perdedor:(Select jugadores.nombreJugador, jugadores.idJugador, competiciones.nombreEvento from ((resultados INNER JOIN jugadores on resultados.idPerdedor = jugadores.idJugador) INNER JOIN competiciones on resultados.idCompeticionFK = competiciones.idCompeticion) WHERE idCompeticion = $id");
  //"SELECT COUNT(resultados.idGanador), COUNT(resultados.idPerdedor), competiciones.nombreEvento, jugadores.nombreJugador FROM ((resultados WHERE idCompeticionFK = $idCompeticion) INNER JOIN jugadores ON (idPerdedor = $id OR idGanador = $id) = jugadores.idJugador) WHERE idCompeticionFK = $id");
  $sql = $con->prepare("SELECT COUNT(resultados.idGanador), COUNT(resultados.idPerdedor), competiciones.nombreEvento, jugadores.nombreJugador FROM ((resultados INNER JOIN competiciones ON resultados.idCompeticionFK = competiciones.idCompeticion) INNER JOIN jugadores ON resultados.idPerdedor = jugadores.idJugador OR resultados.idGanador = jugadores.idJugador) WHERE idCompeticionFK = $id");
  $sql->execute();

  while ($row = $sql->fetchAll(PDO::FETCH_ASSOC)) {
    //Se almacena en un array las filas que se vaya leyendo
    $data[] = $row;
  }

  echo json_encode($data);
}
?>
