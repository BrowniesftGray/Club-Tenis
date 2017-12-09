<?php

  $id = $_REQUEST['idNoticia'];

  $usuario = 'root';
$contraRoot = '';

try {
  $con = new PDO('mysql:host=localhost;dbname=club;charset=UTF8', $usuario, $contraRoot);
  $mbd = null;
} catch (PDOException $e) {
  print "¡Error!: " . $e->getMessage() . "<br/>";
  die();
}


  $insertarCompeticion = $con->prepare("DELETE FROM noticias WHERE idNoticias = $id");
  $insertarCompeticion->execute();

  header("Location:index.php");
?>
