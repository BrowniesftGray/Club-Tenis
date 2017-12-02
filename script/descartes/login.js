$("#divfrmLogin").dialog({
    autoOpen: true,  // Es el valor por defecto
    close: function () {
        $("#frmLogin")[0].reset();
    },
    hide: "fold",
    show: "fold",
    height:"auto",
    width:"auto",
    modal: "false",
    resizable:true,
    buttons: [{
        text: "Conectarse",
        class: "btn",
        type: "submit",
        click: procesoConexion
    },{
        text: "Cancelar",
        class: "btn",
        click: function() {
                 $(this).dialog("close");
             }
    }]
});

function procesoConexion(){
  if (comprobarConexion()) {
    llamadaAjaxConexion();
  }
}

function comprobarConexion(){
  var sError = "";
  var bValido = true;

  var expreEmail = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i

  if (expreEmail.test(frmLogin.txtEmail.value) == false) {
    bValido = false;
    sError+= "Ingrese un email con formato correcto";
  }

  var expreContra = /^[a-zA-z\s\ñ\Ñ]{5,45}$/
  if (expreContra.test(frmLogin.txtContra.value) == false) {
    bValido = false;
    sError+= "Este campo requiere de 5 letras mínimo y tiene un máximo de 45.";
  }

  if(bValido == false){
		$("#divMensajes").dialog("open");
    $("#divMensajes").dialog("option","title","Error");
    $("#pMensaje").text(sError); // A sustituir por el uso de un dialogo de mensajes
	}

  return bValido;
}

function llamadaAjaxConexion(){
  $.ajax({ url : "php/comprobarConexion.php",
			 data: $("#frmLogin").serialize(),
			 async: true, // Valor por defecto
			 dataType :'json',
			 method: "POST",
			 cache: false, // ya por defecto es false para POST
			 success: respuestaConexion,
			 error :respuestaConexion
			 });
}

function respuestaConexion(oArrayRespuesta){


    $("#divMensajes").dialog("open");

    if (oArrayRespuesta[0] == true){
        $("#divMensajes").dialog("option","title","Error");
        $("#pMensaje").text(oArrayRespuesta[1]);
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
