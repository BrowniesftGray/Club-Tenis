<?php
session_name("aplicacion");
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Site Properties -->
    <title>Borrar Noticia</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/blog-home.css" rel="stylesheet">
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../jquery-ui/jquery-ui.css">
    <script type="text/javascript" src="../jquery-ui/jquery-ui.js"></script>
    <script src="../script/index.js"></script>
    <style>
      .form{
        margin-top: 4%;
      }
    </style>
</head>
<body>
  <?php
  include("../php/navbar.php");


  if ($_SESSION['tipo'] == 'Administrador') {

    if (isset($_POST["btnNoticia"])) {
        include("../php/Borrado/deleteNoticia.php");
    }

  ?>
        <div class="container form">
        <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h2>¿Quieres borrar esta noticia?</h2>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group has-danger">
                        <label class="sr-only" for="txtTitulo">Titulo</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">

                                   <?php
                                     $con = conexion();

                                     //Realización de
                                     $idNoticia = $_GET['idNoticia'];
                                     $sql = $con->prepare("SELECT * FROM noticias WHERE idNoticias = ".$idNoticia."");
                                     $sql->execute();

                                     $row = $sql->fetchAll(PDO::FETCH_ASSOC);
                                     $titulo = $row[0]['titulo'];
                                     $desc = $row[0]['descripcion'];

                                     echo '<input type="text" name="txtTitulo" class="form-control" id="titulo" placeholder="Titulo de prueba" autofocus value="'.$titulo.'">';


                                    echo '<input type="hidden" name="idNoticia" value="'.$idNoticia.'">';
                                   ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="sr-only" for="txtDescripcion">Descripcion</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <textarea name="txtDescripcion" class="form-control" id="txtDescripcion" placeholder="Descripcion" rows="6">
                                   <?php echo $desc; ?>
                                 </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-top: 1rem">
                <div class="col-md-3"></div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-warning" name="btnNoticia">Sí, borrar noticia </button>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-danger active" name="btnVolver" formaction="../index.php"> No, volver al Indice</button>
                </div>
            </div>
        </form>
    </div>
    <?php
  }
  else{
    echo '<div class="alert alert-warning alert-dismissable" role="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button><a href="login.php>"conéctese</a>';
  }

  function conexion(){
    $usuario = 'root';
    $contraRoot = '';

    try {
      $con = new PDO('mysql:host=localhost;dbname=club', $usuario, $contraRoot);
      $mbd = null;
    } catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    return $con;
  }
    ?>
</body>
</html>
