<?php
function conexion(){
  $usuario = 'root';
  $contraRoot = '';

  try {
    $con = new PDO('mysql:host=localhost;dbname=club;charset=UTF8', $usuario, $contraRoot);
    $mbd = null;
  } catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
  }
  return $con;
}
?>
