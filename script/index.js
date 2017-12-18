$(document).ready(function(){

  $("#Registro").on("click", cargaRegistro);
  $("#altaUsuario").on("click", cargaUsuarioAdmin);

  $("#divMensajes").dialog( {
		autoOpen:false,
		modal:true
	});

});

function cargaRegistro(){
  if( $("#frmRegistro").length == 0) {
		$("#formularios").load("formularios/registro.html",
    function(){
						$.getScript("script/registro.js")
              }
					);
	}
  else {
		$("#divfrmRegistro").dialog("open");

	}
}

function cargaUsuarioAdmin(){
  if( $("#frmUsuarioAdmin").length == 0) {
		$("#formularios").load("formularios/usuarioAdmin.html",
    function(){
						//$("#datepicker").datepicker({dateFormat: 'yy-mm-dd'});
						$.getScript("script/usuarioAdmin.js")
              }
					);
	}
  else {
		$("#divfrmUsuarioAdmin").dialog("open");

	}
}
