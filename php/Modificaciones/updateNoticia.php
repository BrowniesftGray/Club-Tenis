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

  $titulo = $_REQUEST['txtTitulo'];
  $descripcion = $_REQUEST['txtDescripcion'];
  if (isset($final)) {
    $imagen = $final;
  }
  $email = $_SESSION['email'];


  $usuario = 'root';
  $contraseña = '';
  try {
    $con = new PDO('mysql:host=localhost;dbname=club', $usuario, $contraseña);
    $mbd = null;
  } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
  }

  if (isset($imagen)) {
    $insertarCompeticion = $con->prepare("UPDATE noticias SET titulo = '$titulo', descripcion = '$descripcion', rutaImagen = '$imagen'");
  }
  else{
    $insertarCompeticion = $con->prepare("UPDATE noticias SET titulo = '$titulo', descripcion = '$descripcion'");

  }
  $insertarCompeticion->execute();

  echo '<div class="alert alert-warning alert-dismissable" role="alert">Se modificó la noticia correctamente</div>';
?>
