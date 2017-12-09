<?php

  $email = $_REQUEST['txtEmail'];
  $nombre = $_REQUEST['txtNombre'];
  $contra = $_REQUEST['txtContra'];
  $direccion = $_REQUEST['txtDireccion'];
  $telefono = $_REQUEST['txtTelefono'];

  $usuario = 'root';
$contraRoot = '';

try {
  $con = new PDO('mysql:host=localhost;dbname=u752794017_club;charset=UTF8', $usuario, $contraRoot);
  $mbd = null;
} catch (PDOException $e) {
  print "¡Error!: " . $e->getMessage() . "<br/>";
  die();
}


  $insertJugador = $con->prepare("INSERT INTO jugadores (nombreJugador, direccionJugador, emailJugador) VALUES ('$nombre','$direccion','$email')");
  $insertJugador->execute();

  /*$obtenerId = $con->prepare("SELECT idJugador FROM Jugadores WHERE email='$email'");
  $obtenerId->execute();
  $row = $obtenerId->fetch(PDO::FETCH_BOTH);
  $idJugador = $row[0];*/

  $insertarUsuario = $con->prepare("INSERT INTO usuarios (emailUsuario, nombre, contra, direccion, telefono, tipoPerfil) VALUES ('".$email."','".$nombre."','".$contra."','".$direccion."','".$telefono."','Usuario')");
  $insertarUsuario->execute();

  $actualizarUsuario = $con->prepare("UPDATE usuarios JOIN jugadores ON jugadores.emailJugador = usuarios.emailUsuario SET usuarios.idJugadorFK = jugadores.idJugador");
  $actualizarUsuario->execute();

?>
