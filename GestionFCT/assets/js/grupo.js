function crearGrupo(){
	var mensajeErr = document.getElementById("err-nombreGrupo");
	var mensajeErrTitulacion = document.getElementById("err-titulacionGrupo");
	var mensajeOk = document.getElementById("ok-nombreGrupo");
	var nombre = document.getElementById("nombre").value;

	if(nombre==""){
		mostrarElementoById("err-nombreGrupo");
		ocultarElementoById("ok-nombreGrupo");
		ocultarElementoById("err-titulacionGrupo");
		mensajeErr.innerHTML="El nombre del grupo no puede estar vacío";
	} 
	if(document.getElementById("selectTitulacion").value ==""){
		if(nombre!=""){
			ocultarElementoById("err-nombreGrupo");
		}
		mostrarElementoById("err-titulacionGrupo");
		ocultarElementoById("ok-nombreGrupo");
		mensajeErrTitulacion.innerHTML="La titulación no puede estar vacía";
	} 
	if(nombre!="" && document.getElementById("selectTitulacion").value !="") {
		ocultarElementosById(["err-nombreGrupo","ok-nombreGrupo","err-titulacionGrupo"]);
		var datos="nombre="+nombre;
		datos+="&idTitulacion="+document.getElementById("selectTitulacion").value;
		datos+="&idInstituto="+document.getElementById("selectInstituto").value;
		var x = new XMLHttpRequest();

		x.open("POST",
				"/grupo/ajaxCPost",
				true);
		x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		x.setRequestHeader("X-Requested-With","XMLHttpRequest");
		x.send(datos);
		
		x.onreadystatechange=function(){
			if(x.readyState == 4 && x.status==200){
				var respuesta = JSON.parse(x.responseText);
				
				if(respuesta.estado == true){
					mostrarElementoById("ok-nombreGrupo");
					
					var timeleft = 5;
					var downloadTimer = setInterval(function(){
					  if(timeleft <= 0){
					    clearInterval(downloadTimer);
					    window.location.href = "/";
					  } else {
						  mensajeOk.innerHTML = respuesta.mensaje + ".<br>Redirigiendo en " + timeleft + " segundos";
					  }
					  timeleft -= 1;
					}, 1000);
				} else {
					mostrarElementoById("err-nombreGrupo");
					mensajeErr.innerHTML=respuesta.mensaje;
				}
				desactivarBoton("btn-crear-grupo", 3000);
			}
		}
	}
}

function cargarGrupoDatos(){
	cargarGrupoCadaDato("/familiaprofesional/ajaxGetFamiliasProfesionales","selectFamiliaProfesional","nombre");
	cargarGrupoCadaDato("/instituto/ajaxGetInstitutos","selectInstituto","nombre");
}

function cargarGrupoCadaDato(url,idSelect,campoText,datos=""){
	var x = new XMLHttpRequest();

	x.open("POST", url, true);
	x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	x.setRequestHeader("X-Requested-With","XMLHttpRequest");
	x.send(datos);
	
	x.onreadystatechange=function(){
		if(x.readyState == 4 && x.status==200){
			var respuesta = JSON.parse(x.responseText);
			var select = document.getElementById(idSelect);
			select.innerHTML = "";
			for(opcion in respuesta){
				var option = document.createElement("option");
				option.text = respuesta[opcion][campoText];
				option.value = respuesta[opcion].id;
				select.add(option);
			}
				
		}
	}
}