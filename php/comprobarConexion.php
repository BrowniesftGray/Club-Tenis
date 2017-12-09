<?php
if (!isset($_SESSION)) {
  session_name("aplicacion");
  session_start();
}

  $email = $_REQUEST['email'];
  $contra = $_REQUEST['txtContra'];

  $usuario = 'root';
$contraRoot = '';

try {
  $con = new PDO('mysql:host=localhost;dbname=club;charset=UTF8', $usuario, $contraRoot);
  $mbd = null;
} catch (PDOException $e) {
  print "¡Error!: " . $e->getMessage() . "<br/>";
  die();
}



  //Realización de
  $sql = $con->prepare("SELECT * FROM usuarios WHERE emailUsuario='$email' AND contra='$contra'");
  $sql->execute();
  $cuenta = $sql->rowCount();

  if ($cuenta==1) {
    $row = $sql->fetchAll(PDO::FETCH_ASSOC);
    $tipo = $row[0]['tipoPerfil'];
    if ($tipo == 'Administrador') {
      $respuesta = array ( 'existe' => 'Si', 'tipo' => 'Administrador');
      $_SESSION['tipo'] = "Administrador";
      $_SESSION['email'] = $email;
      $_SESSION['idJugador'] = $row[0]['idJugadorFK'];
    }
    else{
      $respuesta = array ( 'existe' => 'Si', 'tipo' => 'Usuario');
      $_SESSION['tipo'] = "Usuario";
      $_SESSION['email'] = $email;
      $_SESSION['idJugador'] = $row[0]['idJugadorFK'];
    }
  }
  else{
    $respuesta = array ( 'existe' => 'No');
  }

  if ($respuesta['existe'] == 'No') {
    echo '<div class="alert alert-warning alert-dismissable" role="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button> No existe el usuario</div>';
  }
  else{
    header("Location:../index.php");
  }
?>
