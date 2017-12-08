<?php
  $titulo = str_replace(" ", "", $_REQUEST['txtTitulo']);

  $destino = "imagenes/$titulo";
  if(is_uploaded_file($_FILES['imagen']['tmp_name'])) { // verifica haya sido cargado el archivo
    //echo "<pre>";
    //print_r($_FILES);
    //echo "</pre>";
    //echo $_FILES['imagen']['name'];
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
    $imagen = $final;
  }
  else{
    $imagen = "";
  }
  $email = $_SESSION['email'];
  $fecha = date("Y/m/d");//fecha hoy


  $usuario = 'root';
  $contraseña = '';
  try {
    $con = new PDO('mysql:host=localhost;dbname=club;charset=UTF8', $usuario, $contraseña);
    $mbd = null;
  } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
  }
  $insertarCompeticion = $con->prepare("INSERT INTO noticias (titulo, descripcion, rutaImagen, fechaPublicacion, emailUsuarioFK) VALUES ('$titulo','$descripcion', '$imagen', '$fecha', '$email')");
  $insertarCompeticion->execute();

  echo '<div class="alert alert-warning alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert"></button>Se añadió la noticia correctamente</div>';
?>
