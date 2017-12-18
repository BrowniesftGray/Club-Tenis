<?php
$usuario = 'root';
$contraRoot = '';

try {
  $con = new PDO('mysql:host=localhost;dbname=club;charset=UTF8', $usuario, $contraRoot);
  $mbd = null;
} catch (PDOException $e) {
  print "¡Error!: " . $e->getMessage() . "<br/>";
  die();
}

  $conseguirNumero = $con->prepare("SELECT idNoticias FROM noticias");
  $conseguirNumero->execute();
  $row = $conseguirNumero->fetchAll(PDO::FETCH_ASSOC);
  $numero = count($row)+1;

  $titulo = str_replace(" ", "", $_REQUEST['txtTitulo']);
  $titulo = $titulo.$numero;

  $destino = "../imagenes/$titulo";
  if(is_uploaded_file($_FILES['imagen']['tmp_name'])) {
    $name = $_FILES['imagen']['name'];
    $final = $destino."_portada.jpg";
      if(move_uploaded_file($_FILES['imagen']['tmp_name'], $final)) {
        // se coloca en su lugar final
                  //echo "<b>Upload exitoso!. Datos:</b><br>";
          //echo "Nombre: <i><a href=\"".$_FILES['imagen']['name']."\">".$_FILES['imagen']['name']."</a></i><br>";
          //echo "Tipo MIME: <i>".$_FILES['imagen']['type']."</i><br>";
                  //echo "Peso: <i>".$_FILES['imagen']['size']." bytes</i><br>";
                    //  echo "<br><hr><br>";
      }
  }

  $descripcion = $_REQUEST['txtDescripcion'];
  if (isset($final)) {
    $imagen = "imagenes/".$titulo."_portada.jpg";
  }
  else{
    $imagen = "";
  }
  $titulo = $_REQUEST['txtTitulo'];
  $email = $_SESSION['email'];
  $fecha = date("Y/m/d");//fecha hoy



  $insertarCompeticion = $con->prepare("INSERT INTO noticias (titulo, descripcion, rutaImagen, fechaPublicacion, emailUsuarioFK) VALUES ('$titulo','$descripcion', '$imagen', '$fecha', '$email')");
  $insertarCompeticion->execute();

  echo '<div class="alert alert-warning alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert"></button>Se añadió la noticia correctamente</div>';
?>
