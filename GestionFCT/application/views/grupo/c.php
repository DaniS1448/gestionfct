<main class="page lanidng-page">
   <section id="nalumnos" class="portfolio-block block-intro">
      <div class="container">
         <div class="about-me">
            <form>
               <p>Crear nuevo grupo</p>
               <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre grupo" />
               <span class="text-danger" id="err-nombreGrupo" style="display:none"></span>
               
               <div class="form-group mt-4">
               		<label for="formCheckDuplicarCurso">Familia profesional</label>
               		<select class="form-control" id="selectFamiliaProfesional" name="idFamiliaProfesional" 
               		onclick="cargarGrupoCadaDato('/titulacion/ajaxGetTitulacionesByFamiliaProfesional','selectTitulacion','nombre','idFamiliaProfesional='+this.value);"></select>
               </div>
               
               <div class="form-group mt-4">
               		<label for="formCheckDuplicarCurso">Titulación</label>
               		<select class="form-control" id="selectTitulacion" name="idTitulacion"></select>
               		<span class="text-danger" id="err-titulacionGrupo" style="display:none"></span>
               </div>

               <div class="form-group mt-4">
               		<label for="formCheckDuplicarCurso">Instituto (filtrar cuando hayan muchos)</label>
               		<select class="form-control" id="selectInstituto" name="idInstituto"></select>
               </div>
               
               <span class="text-success mt-2" id="ok-nombreGrupo" style="display:none"></span>
               <button class="btn btn-outline-primary mt-3" type="button" id="btn-crear-grupo" onclick="crearGrupo();">Crear</button>
            </form>
         </div>
      </div>
   </section>
</main>
<script>
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
</script>

<script>cargarGrupoDatos();</script>