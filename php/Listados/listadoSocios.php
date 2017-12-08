<?php

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
  $sql = $con->prepare("SELECT * FROM Usuarios");
  $sql->execute();

  while ($row = $sql->fetchAll(PDO::FETCH_ASSOC)) {
    //Se almacena en un array las filas que se vaya leyendo
    $data[] = $row;
  }

  echo json_encode($data);
?>
