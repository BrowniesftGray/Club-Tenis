$("#divfrmRegistro").dialog({
    autoOpen: true,  // Es el valor por defecto
    close: function () {
        $("#frmRegistro")[0].reset();
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
        click: procesoRegistro
    },{
        text: "Cancelar",
        class: "btn btn-warning",
        click: function() {
                 $(this).dialog("close");
             }
    }]
});

function procesoRegistro(){
  if (comprobarRegistro()){
    llamadaAjaxRegistro();
  }
}

function comprobarRegistro(){
  var sError = "";
  var bValido = true;

  var expreEmail = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i

  if (expreEmail.test(frmRegistro.txtEmail.value) == false) {
    bValido = false;
    sError+= "Ingrese un email con formato correcto";
  }

  var expreContra = /^[a-zA-Z\ñ\Ñ\w\d\D\s\S]{3,45}$/
  if (expreContra.test(frmRegistro.txtNombre.value) == false) {
    bValido = false;
    sError+= "Nombre requiere de 5 letras mínimo y tiene un máximo de 45.";
  }

  var expreContra = /^[a-zA-Z\ñ\Ñ\w\d\D\s\S]{5,45}$/
  if (expreContra.test(frmRegistro.txtContra.value) == false) {
    bValido = false;
    sError+= "La contraseña requiere de 8 letras mínimo y tiene un máximo de 45.";
  }

  var expreContra = /^[a-zA-Z\ñ\Ñ\w\d\D\s\S]{8,45}$/
  if (expreContra.test(frmRegistro.txtDireccion.value) == false) {
    bValido = false;
    sError+= "La direccion debe constar de 8 letras mínimo y tiene un máximo de 45.";
  }

  var expreTelefono = /^[0-9]{9}/;
  if (expreTelefono.test(frmRegistro.txtTelefono.value) == false) {
    bValido = false;
    sError+= "El teléfono no tiene un formato correcto.";
  }

  if(bValido == false){
		$("#divMensajes").dialog("open");
    $("#divMensajes").dialog("option","title","Error de Registro");
    $("#pMensaje").text(sError); // A sustituir por el uso de un dialogo de mensajes
	}

  return bValido;
}

function llamadaAjaxRegistro(){
  $.ajax({ url : "php/altas/altaUsuario.php",
			 data: $("#frmRegistro").serialize(),
			 async: true, // Valor por defecto
			 dataType :'json',
			 method: "POST",
			 cache: false, // ya por defecto es false para POST
			 success: respuestaRegistro,
			 error :respuestaRegistro
			 });
}

function respuestaRegistro(oArrayRespuesta){
  $("#divMensajes").dialog("open");

  if (oArrayRespuesta[0] == true){
      $("#divMensajes").dialog("option","title","Error");
      $("#pMensaje").text(oArrayRespuesta[1]);
      location.reload();
  } else {
      $('#divfrmBajaMedico').dialog("close");
      $("#divMensajes").dialog("option","title","OK");
      $("#pMensaje").text('Se ha dado de alta al usuario con éxito');
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
