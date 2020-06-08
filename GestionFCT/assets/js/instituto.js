function crearInstituto(){
	var mensajeErr = document.getElementById("err-nombreInstituto");
	var mensajeOk = document.getElementById("ok-nombreInstituto");
	var nombreInstituto = document.getElementById("nombreInstituto").value;

	if(nombreInstituto==""){
		mostrarElementoById("err-nombreInstituto");
		ocultarElementoById("ok-nombreInstituto");
		mensajeErr.innerHTML="El nombre del instituto no puede estar vacío";
	} else {
		ocultarElementosById(["err-nombreInstituto","ok-nombreInstituto"]);
		var datos="nombre="+nombreInstituto;
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