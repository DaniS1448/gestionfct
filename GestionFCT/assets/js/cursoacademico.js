function crearCursoAcademico(){
	var mensajeErr = document.getElementById("err-crearCursoAcademico");
	var mensajeOk = document.getElementById("ok-crearCursoAcademico");
	var anyoini = document.getElementById("anyoini").value;
	var selectCursosAcademicosAnteriores = document.getElementById("selectCursosAcademicosAnteriores").value;

	if(anyoini==""){
		mostrarElementoById("err-crearCursoAcademico");
		ocultarElementoById("ok-crearCursoAcademico");
		mensajeErr.innerHTML="El año de cominezo no puede estar vacío";
	} else {
		ocultarElementosById(["err-crearCursoAcademico","ok-crearCursoAcademico"]);
		var datos="anyoini="+anyoini;
		if(document.getElementById("formCheckDuplicarCurso").checked && selectCursosAcademicosAnteriores!=""){
			datos+="&selectCursosAcademicosAnteriores="+selectCursosAcademicosAnteriores;
		}

		var x = new XMLHttpRequest();

		x.open("POST",
				"/cursoacademico/ajaxCPost",
				true);
		x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		x.setRequestHeader("X-Requested-With","XMLHttpRequest");
		x.send(datos);
		
		x.onreadystatechange=function(){
			if(x.readyState == 4 && x.status==200){
				//console.log(x.responseText);
				var respuesta = JSON.parse(x.responseText);
				
				if(respuesta.estado == true){
					//location.reload();
					mostrarElementoById("ok-crearCursoAcademico");
					//mensajeOk.innerHTML=respuesta.mensaje;
					desactivarBoton("btn-crear-ca", 3000);
					//window.location.href = "/";

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
					mostrarElementoById("err-crearCursoAcademico");
					mensajeErr.innerHTML=respuesta.mensaje;
					desactivarBoton("btn-crear-ca", 3000);
				}
			}
		}
	}
}

function duplicarCursoAcademicoAnterior(elemento){
	toggleElemento("divCursosAcademicosAnteriores");
	if(elemento.checked){
		var x = new XMLHttpRequest();

		x.open("POST",
				"/cursoacademico/ajaxGetCursosAcademicos",
				true);
		x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		x.setRequestHeader("X-Requested-With","XMLHttpRequest");
		x.send();
		
		x.onreadystatechange=function(){
			if(x.readyState == 4 && x.status==200){
				//console.log(x.responseText);
				var respuesta = JSON.parse(x.responseText);
				//console.log(respuesta);
				var selectCA = document.getElementById("selectCursosAcademicosAnteriores");
				selectCA.innerHTML = "";
				for(opcion in respuesta){
					var option = document.createElement("option");
					option.text = "Duplicar curso "+respuesta[opcion].anyoini;
					option.value = respuesta[opcion].id;
					selectCA.add(option);
				}
					
			}
		}
	}
}