<?php

  $id = $_REQUEST['idNoticia'];

  $usuario = 'root';
  $contraseña = '';
  try {
    $con = new PDO('mysql:host=localhost;dbname=club', $usuario, $contraseña);
    $mbd = null;
  } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
  }
  $insertarCompeticion = $con->prepare("DELETE FROM noticias WHERE idNoticias = $id");
  $insertarCompeticion->execute();

  header("Location:index.php");
?>

?>
