$(document).ready(function(){

  //document.getElementById('login').addEventListener("click", cargaLogin);
  $("#Registro").on("click", cargaRegistro);
  //$("#btnNuevaNoticia").on("click", cargaNoticia);
  $("#altaUsuario").on("click", cargaUsuarioAdmin);
  //document.getElementById('cerrarSesion').addEventListener("click", destruirSesion);

  $("#divMensajes").dialog( {
		autoOpen:false,
		modal:true
	});

});

/*function cargaLogin(){
  if( $("#frmLogin").length == 0) {
		$("#formularios").load("formularios/Login.html",
    function(){	$.getScript("script/login.js")});
	}
  else {

		$("#divfrmLogin").dialog("open");

	}
}*/

function cargaRegistro(){
  if( $("#frmRegistro").length == 0) {
		$("#formularios").load("formularios/registro.html",
    function(){
						//$("#datepicker").datepicker({dateFormat: 'yy-mm-dd'});
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
