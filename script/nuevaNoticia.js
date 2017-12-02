$("#divfrmNoticia").dialog({
    autoOpen: true,  // Es el valor por defecto
    close: function () {
        $("#frmNoticia")[0].reset();
    },
    hide: "fold",
    show: "fold",
    height:"auto",
    width:"400px",
    modal: "false",
    resizable:true,
    buttons: [{
        text: "Crear",
        class: "btn btn-primary",
        click: procesoNoticia
    },{
        text: "Cancelar",
        class: "btn btn-warning",
        click: function() {
                 $(this).dialog("close");
             }
    }]
});

function procesoNoticia(){
  if (comprobarNoticia()){
    llamadaAjaxNoticia();
  }
}

function comprobarNoticia(){

  var sError = "";
  var bValido = true;

  var expreContra = /^[a-zA-z\s\ñ\Ñ]{5,45}$/
  if (expreContra.test(frmNoticia.txtTitulo.value) == false) {
    bValido = false;
    sError+= "Titulo requiere de 5 letras mínimo y tiene un máximo de 45.";
  }

  var expreContra = /^[a-zA-z\s\ñ\Ñ]{5,2000}$/
  if (expreContra.test(frmNoticia.txtDescripcion.value) == false) {
    bValido = false;
    sError+= "Descripcion requiere de 5 letras mínimo y tiene un máximo de 2000.";
  }

  if(bValido == false){
		$("#divMensajes").dialog("open");
    $("#divMensajes").dialog("option","title","Error de Noticia");
    $("#pMensaje").text(sError); // A sustituir por el uso de un dialogo de mensajes
	}

  return bValido;
}

function llamadaAjaxNoticia(){
  $.ajax({ url : "php/altas/altaNoticia.php",
			 data: $("#frmNoticia").serialize(),
			 async: true, // Valor por defecto
			 dataType :'json',
			 method: "POST",
			 cache: false, // ya por defecto es false para POST
			 success: respuestaNoticia,
			 error :respuestaNoticia
			 });
}

function respuestaNoticia(oArrayRespuesta){
  $("#divMensajes").dialog("open");

  if (oArrayRespuesta[0] == true){
      $("#divMensajes").dialog("option","title","Error");
      $("#pMensaje").text('Se ha dado de alta al usuario con éxito');
      location.reload();
  } else {
      $('#divfrmBajaMedico').dialog("close");
      $("#divMensajes").dialog("option","title","OK");
      $("#pMensaje").text(oArrayRespuesta[1]);
  }
}

function objetoXHR() {
        if (window.XMLHttpRequest) {
            return new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            var versionesIE = new Array('Msxml2.XMLHTTP.5.0', 'Msxml2.XMLHTTP.4.0', 'Msxml2.XMLHTTP.3.0', 'Msxml2.XMLHTTP', 'Microsoft.XMLHTTP');
            for (var i = 0; i < versionesIE.length; i++) {
                try {
                    return new ActiveXObject(versionesIE[i]);
                } catch (errorControlado) {} //Capturamos el error,
            }
        }
        throw new Error("No se pudo crear el objeto XMLHttpRequest");
}
