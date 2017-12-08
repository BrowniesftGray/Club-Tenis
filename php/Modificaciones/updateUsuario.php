<?php

  $email = $_REQUEST['txtEmail'];
  $nombre = $_REQUEST['txtNombre'];
  $contra = $_REQUEST['txtContra'];
  $direccion = $_REQUEST['txtDireccion'];
  $telefono = $_REQUEST['txtTelefono'];
  $perfil = $_REQUEST['txtTipo'];

  $usuario = 'root';
  $contraseña = '';
  try {
    $con = new PDO('mysql:host=localhost;dbname=club;charset=UTF8', $usuario, $contraseña);
    $mbd = null;
  } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
  }
  /*
  $obtenerId = $con->prepare("SELECT MAX(idJugador) FROM Jugadores WHERE email='$email'");
  $obtenerId->execute();
  $row = $obtenerId->fetch(PDO::FETCH_BOTH);
  $idJugador = $row[0];
  */

  $insertarUsuario = $con->prepare("UPDATE usuarios SET nombre = '$nombre', contra = '$contra', direccion = '$direccion', telefono = $telefono, tipoPerfil = '$perfil' WHERE emailUsuario = '$email'");
  $insertarUsuario->execute();

  //print_r($insertarUsuario);


  echo '<div class="alert alert-warning alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert"></button>Se modificó la noticia correctamente</div>';

?>
