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

    <?php

    echo "<title>Listado Socios</title>";

    ?>

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
  $sql = $con->prepare("SELECT * FROM Competiciones");
  $sql->execute();
  $content = '<html>';
  $content .= '<head>';
  $content .= '<style>';
  $content .= '</style>';
  $content .= '</head><body>';
  $content .= "<div class='container'><div class='row' style='padding-top: 1rem'><table id='exportTable' class='table table-bordered'>";
  $content .= "<thead>";
    $content .= "<tr>";
    $content .= "<th>";
      $content .= "Nombre";
    $content .= "</th>";
    $content .= "<th>";
      $content .= "Fecha";
    $content .= "</th>";
    $content .= "<th>";
      $content .= "Descripcion";
    $content .= "</th>";
    $content .= "</tr>";
  $content .= "</thead>";
  $content .= "<tbody>";

  $row = $sql->fetchAll(PDO::FETCH_ASSOC);
  for ($i=0; $i < count($row); $i++) {
    $content .= "<tr>";
      $content .= "<td>";
        $content .= $row[$i]['nombreEvento'];
      $content .= "</td>";
      $content .= "<td>";
        $content .= date("Y/m/d", strtotime($row[$i]['fechaEvento']));
      $content .= "</td>";
      $content .= "<td>";
        $content .= $row[$i]['descripcion'];
      $content .= "</td>";
    $content .= "</tr>";
  }
  $content .= "</tbody>";
  $content .= "</table></div>";
  $content .= '</body></html>';

  echo $content;
?>
<button id="exportButton" class="btn btn-lg btn-danger clearfix"><span class="fa fa-file-pdf-o"></span> Exportar a PDF</button>
<button type="button" name="imprimir" onclick="window.print();" class="btn btn-lg btn-info"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
  <!-- you need to include the shieldui css and js assets in order for the components to work -->
  <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
  <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
  <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/jszip.min.js"></script>

  <script type="text/javascript">
      jQuery(function ($) {
          $("#exportButton").click(function () {
              // parse the HTML table element having an id=exportTable
              var dataSource = shield.DataSource.create({
                  data: "#exportTable",
                  schema: {
                      type: "table",
                      fields: {
                          Nombre: { type: String },
                          Fecha: { type: String },
                          Descripcion: { type: String }
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
                          { field: "Nombre", title: "Nombre",},
                          { field: "Fecha", title: "Fecha"},
                          { field: "Descripcion", title: "Descripcion"},
                      ],
                      {
                          margins: {
                              top: 50,
                              left: 50
                          }
                      }
                  );

                  pdf.saveAs({
                      fileName: "Listado de Eventos"
                  });
              });
          });
      });
  </script>
