function crearInstituto(){
	var mensajeErr = document.getElementById("err-nombreInstituto");
	var mensajeMunicipio = document.getElementById("err-municipioGrupo");
	var mensajeOk = document.getElementById("ok-nombreInstituto");
	var nombreInstituto = document.getElementById("nombreInstituto").value;

	if(nombreInstituto==""){
		mostrarElementoById("err-nombreInstituto");
		ocultarElementoById("ok-nombreInstituto");
		ocultarElementoById("err-municipioGrupo");
		mensajeErr.innerHTML="El nombre del instituto no puede estar vacío";
	}
	
	if(document.getElementById("idMunicipio").value ==""){
		if(nombreInstituto!=""){ocultarElementoById("err-nombreInstituto");}
		mostrarElementoById("err-municipioGrupo");
		ocultarElementoById("ok-nombreInstituto");
		mensajeMunicipio.innerHTML="El campo municipio no puede estar vacío";
	}
	
	if(nombreInstituto!="" && document.getElementById("idMunicipio").value !=""){
		ocultarElementosById(["err-nombreInstituto","ok-nombreInstituto"]);
		var datos="nombre="+nombreInstituto;
		datos+="&idMunicipio="+document.getElementById("idMunicipio").value;
		if(document.getElementById("formCheckMasDatos").checked){
			datos+="&n_centro="+document.getElementById("n_centro").value;
			
			datos+="&direccion="+document.getElementById("direccion").value;
			datos+="&cif="+document.getElementById("cif").value;
			datos+="&telefono="+document.getElementById("telefono").value;
			datos+="&email="+document.getElementById("email").value;
		}
		var x = new XMLHttpRequest();

		x.open("POST",
				"/instituto/ajaxCPost",
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
					mostrarElementoById("ok-nombreInstituto");
					//mensajeOk.innerHTML=respuesta.mensaje;
					desactivarBoton("btn-crear-instituto", 3000);
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
					mostrarElementoById("err-nombreInstituto");
					mensajeErr.innerHTML=respuesta.mensaje;
					desactivarBoton("btn-crear-instituto", 3000);
				}
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
				//console.log(respuesta[opcion]);
				var span = document.createElement("span");
				span.appendChild(document.createTextNode(" ("+respuesta[opcion].provincia+", "+respuesta[opcion].comunidad+")"));
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
	cargarUl("/municipio/ajaxGetMunicipiosLike","busquedaMunicipio","nombre","nombre="+elemento.value);
}

function onBlurMiInput(){
	setTimeout(function() {
			ocultarElementoById('busquedaMunicipio');
		}, 100);
}

function clickLiInstituto(elemento){
	document.getElementById("idMunicipio").value=elemento.getAttribute("data-id-instituto");
	document.getElementById("nombreBuscarMunicipio").value=elemento.getAttribute("data-nombre-instituto");
	document.getElementById("busquedaMunicipio").innerHTML="";
	document.getElementById("nombreBuscarMunicipio").disabled=true;
}