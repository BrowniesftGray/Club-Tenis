<?php
session_name("aplicacion");
session_start();


?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Club de Tenis</title>

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
      .cerrarSesion{
        margin-left: 10%;
        width: 80%;
      }

    </style>

  </head>

  <body>
    <?php
include("../php/navbar.php");

$idCompeticion= $_GET['idCompeticion'];
$usuario = 'root';
$contraRoot = '';

try {
$con = new PDO('mysql:host=localhost;dbname=u752794017_club;charset=UTF8', $usuario, $contraRoot);
$mbd = null;
} catch (PDOException $e) {
print "¡Error!: " . $e->getMessage() . "<br/>";
die();
}

//Resultados para la competición
$participantes = array();

$obtenerTransportes = $con->prepare("SELECT * FROM transporte WHERE idCompeticionFK=$idCompeticion");
$obtenerTransportes->execute();
$transportes = $obtenerTransportes->fetchAll(PDO::FETCH_ASSOC);

  $content = '<html>';
  $content .= '<head>';
  $content .= '<style>';
  $content .= '</style>';
  $content .= '</head><body>';
  $content .= "<div class='container'>";
  $content .= "<div class='row' style='padding-top: 1rem'><table class='table table-bordered'>";
  $content .= "<thead>";
  $content .= "<tr>";
  $content .= "<th>";
  $content .= "Email Pasajero";
  $content .= "</th>";
  $content .= "<th>";
  $content .= "Nombre Pasajero";
  $content .= "</th>";
  $content .= "<th>";
  $content .= "Conductor";
  $content .= "</th>";
  $content .= "</tr>";
  $content .= "</thead>";

for ($i=0; $i < count($transportes); $i++) {
  $idTransporte = $transportes[$i]['idTransporte'];
  $idConductor = $transportes[$i]['idJugadorFK'];

  $obtenerConductor = $con->prepare("SELECT * FROM usuarios WHERE idJugadorFK=$idConductor");
  $obtenerConductor->execute();
  $conductor = $obtenerConductor->fetchAll(PDO::FETCH_ASSOC);

  $emailConductor = $conductor[0]['emailUsuario'];
  $nombreConductor = $conductor[0]['nombre'];

  $obtenerPasajeros = $con->prepare("SELECT * FROM inscripciones WHERE idCompeticionFK=$idCompeticion AND idTransporteFK=$idTransporte");
  $obtenerPasajeros->execute();
  $pasajeros = $obtenerPasajeros->fetchAll(PDO::FETCH_ASSOC);

  for ($i=0; $i < count($pasajeros); $i++) {
    $idPasajero = $pasajeros[$i]['idJugadorFK'];
    $obtenerPasajero = $con->prepare("SELECT * FROM usuarios WHERE idJugadorFK=$idPasajero");
    $obtenerPasajero->execute();
    $pasajero = $obtenerPasajero->fetchAll(PDO::FETCH_ASSOC);

    $emailPasajero = $pasajero[0]['emailUsuario'];
    $nombrePasajero = $pasajero[0]['nombre'];

    if ($i == 0) {
      //tr con nombre conductor (rowspan)
      $content .= "<tr>";
        $content .= "<td>";
          $content .= $emailPasajero;
        $content .= "</td>";
        $content .= "<td>";
          $content .= $nombrePasajero;
        $content .= "</td>";
        $content .= "<td rowspan='".count($pasajeros)."'>";
          $content .= $nombreConductor;
          $content .= " - ";
          $content .= $emailConductor;
        $content .= "</td>";
      $content .= "</tr>";
    }
    else{
      //tr sin nombre conductor
      $content .= "<tr>";
        $content .= "<td>";
          $content .= $emailPasajero;
        $content .= "</td>";
        $content .= "<td>";
          $content .= $nombrePasajero;
        $content .= "</td>";
      $content .= "</tr>";
    }
  }
$content .= "</table></div>";

$content .= '</body></html>';
echo $content;
?>
<button id="exportButtonR" class="btn btn-lg btn-danger clearfix"><span class="fa fa-file-pdf-o"></span> Exportar a PDF</button>
<button type="button" name="imprimir" onclick="window.print();" class="btn btn-lg btn-info"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button></div>
<?php
}

?>
<!-- you need to include the shieldui css and js assets in order for the components to work -->
<link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/jszip.min.js"></script>

<script type="text/javascript">
    jQuery(function ($) {
        $("#exportButtonR").click(function () {
            // parse the HTML table element having an id=exportTable
            var dataSource = shield.DataSource.create({
                data: "#exportTable",
                schema: {
                    type: "table",
                    fields: {
                        Nombre: { type: String },
                        Victorias: { type: Number },
                        Derrotas: { type: Number }
                    }
                }
            });

            // when parsing is done, export the data to PDF
            dataSource.read().then(function (data) {
                var pdf = new shield.exp.PDFDocument({
                    author: "Darío",
                    created: new Date()
                });

                pdf.addPage("a4", "landscape");

                pdf.table(
                    50,
                    50,
                    data,
                    [
                        { field: "Nombre", title: "Nombre"},
                        { field: "Victorias", title: "Victorias"},
                        { field: "Derrotas", title: "Derrotas"}
                    ],
                    {
                        margins: {
                            top: 50,
                            left: 50
                        }
                    }
                );

                pdf.saveAs({
                    fileName: "Listado de Resultados"
                });
            });
        });
    });
</script>
