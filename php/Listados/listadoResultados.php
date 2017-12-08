<?php

  $idCompeticion = $_REQUEST['IdEvento'];
  $usuario = 'root';
  $contraseña = '';

  try {
    $con = new PDO('mysql:host=localhost;dbname=club;charset=UTF8', $usuario, $contraseña);
    $mbd = null;
  } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
  }

  //Resultados para la competición
  $participantes = array();

  //Obtenemos ganadores
  $obtenerGanadores = $con->prepare("SELECT DISTINCT idGanador FROM resultados WHERE idCompeticionFK=$idCompeticion ORDER BY COUNT(idGanador)");
  $obtenerGanadores->execute();
  $ganadores = $obtenerGanadores->fetchAll(PDO::FETCH_ASSOC);
  for ($i=0; $i < count($ganadores); $i++) {
    $participantes[] = $ganadores[$i]['idGanador'];
  }


  //obtenemos Perdedores
  $obtenerPerdedores = $con->prepare("SELECT DISTINCT idPerdedor FROM resultados WHERE idCompeticionFK=$idCompeticion");
  $obtenerPerdedores->execute();
  $perdedores = $obtenerPerdedores->fetchAll(PDO::FETCH_ASSOC);
  //print_r($perdedores);
  for ($i=0; $i < count($perdedores); $i++) {
    $perdedor = $perdedores[$i]['idPerdedor'];
    if (!in_array($perdedor, $participantes)) {
      $participantes[] = $perdedores[$i]['idPerdedor'];
    }
  }


  echo "<div class='row' style='padding-top: 1rem'><table class='table table-bordered'>";
  echo "<thead>";
    echo "<tr>";
    echo "<th>";
      echo "Participante";
    echo "</th>";
    echo "<th>";
      echo "Victorias";
    echo "</th>";
    echo "<th>";
      echo "Derrotas";
    echo "</th>";
    echo "</tr>";
  echo "</thead>";

  for ($i=0; $i < count($participantes); $i++) {
    $participante = $participantes[$i];
    $victorias = $con->prepare("SELECT COUNT(idGanador) FROM resultados WHERE idCompeticionFK = $idCompeticion AND idGanador = $participante");
    $victorias->execute();
    $derrotas = $con->prepare("SELECT COUNT(idPerdedor) FROM resultados WHERE idCompeticionFK = $idCompeticion AND idPerdedor = $participante");
    $derrotas->execute();

    $nombreJugador = $con->prepare("SELECT nombreJugador FROM jugadores WHERE idJugador = $participante");
    $nombreJugador->execute();

    $row = $victorias->fetchAll(PDO::FETCH_ASSOC);
    $data[$i]['Victorias'] = $row[0]['COUNT(idGanador)'];

    $row = $derrotas->fetchAll(PDO::FETCH_ASSOC);
    $data[$i]['Derrotas'] = $row[0]['COUNT(idPerdedor)'];

    $row = $nombreJugador->fetchAll(PDO::FETCH_ASSOC);
    $data[$i]['Nombre'] = $row[0]['nombreJugador'];


  }
  array_multisort($data, SORT_DESC);
  for ($i=0; $i < count($data); $i++) {
    echo "<tr>";
      echo "<td>";
      echo $data[$i]['Nombre'];
      echo "</td>";
      echo "<td>";
      echo $data[$i]['Victorias'];
      echo "</td>";
      echo "<td>";
      echo $data[$i]['Derrotas'];
      echo "</td>";
    echo "</tr>";
  }
  echo "</table></div>";

?>
