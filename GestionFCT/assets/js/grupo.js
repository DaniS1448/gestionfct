function crearGrupo(){
	var mensajeErr = document.getElementById("err-nombreGrupo");
	var mensajeErrTitulacion = document.getElementById("err-titulacionGrupo");
	var mensajeErrInstituto = document.getElementById("err-institutoGrupo");
	var mensajeOk = document.getElementById("ok-nombreGrupo");
	var nombre = document.getElementById("nombre").value;

	if(nombre==""){
		mostrarElementoById("err-nombreGrupo");
		ocultarElementoById("ok-nombreGrupo");
		ocultarElementoById("err-titulacionGrupo");
		ocultarElementoById("err-institutoGrupo");
		mensajeErr.innerHTML="El nombre del grupo no puede estar vacío";
	} 
	if(document.getElementById("selectTitulacion").value ==""){
		if(nombre!=""){
			ocultarElementoById("err-nombreGrupo");
		}
		mostrarElementoById("err-titulacionGrupo");
		ocultarElementoById("ok-nombreGrupo");
		ocultarElementoById("err-institutoGrupo");
		mensajeErrTitulacion.innerHTML="La titulación no puede estar vacía";
	}
	if(document.getElementById("idInstituto").value ==""){
		if(nombre!=""){ocultarElementoById("err-nombreGrupo");}
		if(document.getElementById("selectTitulacion").value !=""){ocultarElementoById("err-titulacionGrupo");}
		mostrarElementoById("err-institutoGrupo");
		ocultarElementoById("ok-nombreGrupo");
		mensajeErrInstituto.innerHTML="El campo instituto no puede estar vacío";
	}
	
	if(nombre!="" && document.getElementById("selectTitulacion").value !="" && document.getElementById("idInstituto").value !="") {
		ocultarElementosById(["err-nombreGrupo","ok-nombreGrupo","err-titulacionGrupo"]);
		var datos="nombre="+nombre;
		datos+="&idTitulacion="+document.getElementById("selectTitulacion").value;
		datos+="&idInstituto="+document.getElementById("idInstituto").value;
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
	//cargarGrupoCadaDato("/instituto/ajaxGetInstitutos","selectInstituto","nombre");
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

function cargarUl(url,idUl,campoText,datos=""){
	var x = new XMLHttpRequest();

	x.open("POST", url, true);
	x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	x.setRequestHeader("X-Requested-With","XMLHttpRequest");
	x.send(datos);
	
	x.onreadystatechange=function(){
		if(x.readyState == 4 && x.status==200){
			var respuesta = JSON.parse(x.responseText);
			var ul = document.getElementById(idUl);
			ul.innerHTML = "";
			for(opcion in respuesta){
				var li = document.createElement("li");
				var textoLi = respuesta[opcion][campoText];
				var municipio = respuesta[opcion].municipio;
				//console.log(respuesta[opcion]);
				var span = document.createElement("span");
				span.appendChild(document.createTextNode(" ("+municipio+")"));
				span.setAttribute("style", "color:#999999");
				
				li.appendChild(document.createTextNode("\u00A0\u00A0\u00A0\u00A0"+textoLi));
				li.appendChild(span);
				li.setAttribute("onclick", "clickLiInstituto(this);");
				li.setAttribute("data-id-instituto", respuesta[opcion].id);
				li.setAttribute("data-nombre-instituto", textoLi);
			    ul.appendChild(li);
			}
				
		}
	}
}

function cargarLiInstitutos(elemento){
	cargarUl("/instituto/ajaxGetInstitutosLike","busquedaInstituto","nombre","nombre="+elemento.value);
}

function onBlurMiInput(){
	setTimeout(function() {
			ocultarElementoById('busquedaInstituto');
		}, 100);
}

function clickLiInstituto(elemento){
	document.getElementById("idInstituto").value=elemento.getAttribute("data-id-instituto");
	document.getElementById("nombreBuscarInstituto").value=elemento.getAttribute("data-nombre-instituto");
	document.getElementById("busquedaInstituto").innerHTML="";
	document.getElementById("nombreBuscarInstituto").disabled=true;
}
