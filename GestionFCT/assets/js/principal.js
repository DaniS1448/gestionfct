function mostrarModalError(tipo = "warning", mensaje="No hay mensajes", volver=""){
	
	var cabecera = $('#modalErrores').find('.modal-header');
	var titulo = $('#modalErrores').find('.modal-header p');
	var icono = $('#modalErrores').find('.modal-body .text-center i');
	var pmensaje = $('#modalErrores').find('.modal-body .text-center p');
	var btnCerrar = $('#modalErrores').find("a[data-dismiss='modal']");
	var btnVolver = $('#modalErrores').find("a[type='button']:first");
	var btnVolverColor ="";
	
	titulo.removeClass().addClass("modal-title text-white").text("AVISO");
	pmensaje.text(mensaje);
	
	
	if(tipo=="light" || tipo=="white"){
		cabecera.removeClass().addClass("modal-header bg-dark");
		icono.removeClass().addClass("fas fa-4x mb-3 animated rotateIn"+" text-dark");
		btnVolverColor = "dark";
		btnCerrar.removeClass().addClass("btn btn-outline-dark waves-effect");
	} else {
		cabecera.removeClass().addClass("modal-header bg-"+tipo);
		icono.removeClass().addClass("fas fa-4x mb-3 animated rotateIn"+" text-"+tipo);
		btnVolverColor = tipo;
		btnCerrar.removeClass().addClass("btn btn-outline-"+tipo+" waves-effect");
	}
	
	
	if(volver !== ""){
		btnVolver.removeClass().addClass("btn d-block btn-"+btnVolverColor).attr("href", volver);
	} else {
		btnVolver.removeClass().addClass("btn d-none");
	}
	
	//fas fa-check fa-4x mb-3 animated rotateIn text-danger
	
	if(tipo=="success"){icono.addClass("fas fa-check-circle");}
	else if(tipo=="warning"){icono.addClass("fas fa-exclamation-circle");titulo.text("ATENCIÓN");}
	else if(tipo=="danger"){icono.addClass("fas fa-exclamation-circle");titulo.text("ERROR");}
	else {icono.addClass("fa-info-circle");}
	
	$('#modalErrores').modal();
}

function desactivarBoton($id, $milisegundos){
	document.getElementById($id).disabled = true;
	setTimeout(function() {
		document.getElementById($id).disabled = false;
	}, $milisegundos);
}