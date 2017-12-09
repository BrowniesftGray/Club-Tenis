<?php

if (!isset($_POST['btnEvento'])) {
  ?>
  <div class="container form">
  <form class="form-horizontal" role="form" method="POST">
  <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
          <div class="form-group has-danger">
              <label class="sr-only" for="email">Evento</label>
              <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                  <select class="form-control" name="elegirEvento">
                    <?php
                    $con = conexion();

                    //Realización de
                    $sql = $con->prepare("SELECT * FROM competiciones");
                    $sql->execute();

                    $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                    for ($i=0; $i < count($row); $i++) {
                      echo '<option value="'.$row[$i]["idCompeticion"].'">';
                      echo $row[$i]['nombreEvento'];
                      echo " - ";
                      echo $row[$i]['fechaEvento'];
                      echo "</option>";
                    }
                    ?>
                  </select>
              </div>
          </div>
      </div>
  </div>
  <div class="row" style="padding-top: 1rem">
      <div class="col-md-3"></div>
      <div class="col-md-4">
          <button type="submit" class="btn btn-success" name="btnEvento">Seleccionar Competicion</button>
      </div>
      <div class="col-md-3">
          <button type="submit" class="btn btn-danger active" name="btnVolver" formaction="../index.php"> Volver al Indice</button>
      </div>
  </div>
</div>
  <?php
}
else{

  $idCompeticion = $_REQUEST['elegirEvento'];
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
  $sql = $con->prepare("SELECT jugadores.nombreJugador, jugadores.emailJugador, jugadores.direccionJugador, competiciones.nombreEvento FROM inscripciones INNER JOIN competiciones ON inscripciones.idCompeticionFK = competiciones.idCompeticion INNER JOIN jugadores ON inscripciones.idJugadorFK = jugadores.idJugador WHERE idCompeticionFK = $idCompeticion");
  $sql->execute();



    $content = '<html>';
    $content .= '<head>';
    $content .= '<style>';
    $content .= '</style>';
    $content .= '</head><body>';
    $content .= "<div class='container'><div class='row' style='padding-top: 1rem'><table id='exportTable' class='table table-bordered table-hover'>";
    $content .= "<thead>";
      $content .= "<tr>";
        $content .= "<th>";
          $content .= "Nombre";
        $content .= "</th>";
        $content .= "<th>";
          $content .= "Email";
        $content .= "</th>";
        $content .= "<th>";
          $content .= "Direccion";
        $content .= "</th>";
      $content .= "</tr>";
    $content .= "</thead>";
    $content .= "<tbody>";

    $row = $sql->fetchAll(PDO::FETCH_ASSOC);
    for ($i=0; $i < count($row); $i++) {
      $content .= "<tr>";
        $content .= "<td>";
          $content .= $row[$i]['nombreJugador'];
        $content .= "</td>";
        $content .= "<td>";
          $content .= $row[$i]['emailJugador'];
        $content .= "</td>";
        $content .= "<td>";
          $content .= $row[$i]['direccionJugador'];
        $content .= "</td>";
      $content .= "</tr>";
    }
    $content .= "</tbody>";
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
                      fileName: "Listado de Inscritos a Competición"
                  });
              });
          });
      });
  </script>
