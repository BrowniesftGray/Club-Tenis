<?php

  $idCompeticion = $_POST['idCompeticion'];
  $idTransporte = $_POST['elegirTransporte'];
  $comentario = $_POST['txtComentario'];
  $idJugador = $_SESSION['idJugador'];

  //echo "<script>alert($idCompeticion)</script>";

  $usuario = 'root';
$contraRoot = '';

try {
  $con = new PDO('mysql:host=localhost;dbname=u752794017_club;charset=UTF8', $usuario, $contraRoot);
  $mbd = null;
} catch (PDOException $e) {
  print "¡Error!: " . $e->getMessage() . "<br/>";
  die();
}


  $jugador = $_SESSION['idJugador'];
  $sql = $con->prepare("SELECT * FROM inscripciones WHERE idCompeticionFK=$idCompeticion AND idJugadorFK = $jugador");
  $sql->execute();

  $cuenta = $sql->rowCount();

  if ($cuenta>=1) {

    if ($idTransporte == 0) {
      $insertJugador = $con->prepare("INSERT INTO transporte (idJugadorFK, espacioDisponible, idCompeticionFK) VALUES ($idJugador, 0, $idCompeticion)");
      $insertJugador->execute();


      $insertarInscripcion = $con->prepare("INSERT INTO inscripciones (idCompeticionFK, Comentario, idJugadorFK) VALUES ($idCompeticion, '$comentario', $idJugador)");
      $insertarInscripcion->execute();

      $actualizarUsuario = $con->prepare("UPDATE inscripciones JOIN transporte ON transporte.idCompeticionFK = inscripciones.idCompeticionFK AND transporte.idJugadorFK = inscripciones.idJugadorFK SET inscripciones.idTransporteFK = transporte.idTransporte");
      $actualizarUsuario->execute();
      //update inscripciones
    }
    else{

      $insertarInscripcion = $con->prepare("INSERT INTO inscripciones (idCompeticionFK, idTransporteFK, Comentario, idJugadorFK) VALUES ($idCompeticion, $idTransporte, '$comentario', $idJugador)");
      $insertarInscripcion->execute();

      $insertarCompeticion = $con->prepare("UPDATE transporte SET espacioDisponible=espacioDisponible-1 WHERE idCompeticionFK = $idCompeticion AND idJugadorFK = $idJugador");
      $insertarCompeticion->execute();
    }
    echo '<div class="alert alert-success alert-dismissable" role="alert">Se ha inscrito a esta competicion.</div>';
  }
  else{
    echo '<div class="alert alert-warning alert-dismissable" role="alert">Ya está inscrito a esta competición.</div>';

  }


?>
