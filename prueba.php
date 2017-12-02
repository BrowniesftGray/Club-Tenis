<?php
$destino = 'imagenes';
if (isset($_POST['submit'])) {
    if(is_uploaded_file($_FILES['fichero']['tmp_name'])) { // verifica haya sido cargado el archivo
      echo "<pre>";
      print_r($_FILES);
      echo "</pre>";
      //echo $_FILES['fichero']['name'];
      $name = $_FILES['fichero']['name'];
      $final = "$destino/$name";
        if(move_uploaded_file($_FILES['fichero']['tmp_name'], $final)) { // se coloca en su lugar final
                    echo "<b>Upload exitoso!. Datos:</b><br>";
            echo "Nombre: <i><a href=\"".$_FILES['fichero']['name']."\">".$_FILES['fichero']['name']."</a></i><br>";
            echo "Tipo MIME: <i>".$_FILES['fichero']['type']."</i><br>";
                    echo "Peso: <i>".$_FILES['fichero']['size']." bytes</i><br>";
                        echo "<br><hr><br>";
        }
    }

// A continuación el formulario
}
?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    Archivo: <input name="fichero" type="file">
    <input name="submit" type="submit" value="Upload!">
</form>
