<main class="page lanidng-page">
   <section id="nalumnos" class="portfolio-block block-intro">
      <div class="container">
         <div class="about-me">
            <form>
               <p>Modificar previsión puestos</p>
               
               <div class="form-group mt-4">
               		<label for="selectFamiliaProfesional">Empresa</label>
               		<select class="form-control" id="selectEmpresa" name="idFamiliaProfesional" 
               		onclick="cargarGrupoCadaDato('/sede/ajaxGetSedesByEmpresa','selectSede','direccion','idEmpresa='+this.value); setTimeout(function(){ cargarNumPuestos(); }, 1000);"></select>
               </div>
               
               <div class="form-group mt-4">
               		<label for="selectTitulacion">Sede</label>
               		<select class="form-control" id="selectSede" name="idTitulacion" onclick="cargarNumPuestos();"></select>
               		<span class="text-danger" id="errSede" style="display:none"></span>
               </div>
               
               <input type="text" class="form-control" name="nombre" id="numeroPrevision" placeholder="Número de puestos" />
               <span class="text-danger" id="errNumPuestos" style="display:none"></span>
               
               <span class="text-success mt-2" id="okPrevision" style="display:none"></span>
               <button class="btn btn-outline-primary mt-3" type="button" id="btn-crear-prevision" onclick="crearPrevision();">Modificar</button>
            </form>
         </div>
      </div>
   </section>
</main>

<script>
function crearPrevision(){
	var errSede = document.getElementById("errSede");
	var errNumPuestos = document.getElementById("errNumPuestos");
	var okPrevision = document.getElementById("okPrevision");

	if(document.getElementById("selectSede").value==""){
		ocultarElementos([errNumPuestos,okPrevision]);
		mostrarElemento(errSede);
		errSede.innerHTML="La sede no puede estar vacía";
	}
	
	if(document.getElementById("numeroPrevision").value ==""){
		if(document.getElementById("selectSede").value!=""){ocultarElemento(errSede);}
		ocultarElementos([okPrevision]);
		mostrarElemento(errNumPuestos);
		errNumPuestos.innerHTML="El campo número de puestos no puede estar vacío";
	}


	
	if(document.getElementById("selectSede").value!="" && document.getElementById("numeroPrevision").value !=""){
		
		ocultarElementos([errSede,errNumPuestos,okPrevision]);
		var datos="numero="+document.getElementById("numeroPrevision").value;
		datos+="&idSede="+document.getElementById("selectSede").value;

		desactivarBoton("btn-crear-prevision", 3000);
		
		var x = new XMLHttpRequest();

		x.open("POST",
				"/provisionpuestos/ajaxUPost",
				true);
		x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		x.setRequestHeader("X-Requested-With","XMLHttpRequest");
		x.send(datos);
		
		x.onreadystatechange=function(){
			if(x.readyState == 4 && x.status==200){
				var respuesta = JSON.parse(x.responseText);
				
				if(respuesta.estado == true){
					mostrarElementoById("okPrevision");
					var timeleft = 5;
					var downloadTimer = setInterval(function(){
					  if(timeleft <= 0){
					    clearInterval(downloadTimer);
					    window.location.href = "/";
					  } else {
						  document.getElementById("okPrevision").innerHTML = respuesta.mensaje + ".<br>Redirigiendo en " + timeleft + " segundos";
					  }
					  timeleft -= 1;
					}, 1000);
				} else {
					mostrarElemento(errSede);
					errSede.innerHTML=respuesta.mensaje;
					desactivarBoton("btn-crear-prevision", 3000);
				}
			}
		}
	}
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

function cargarGrupoDatos(){
	cargarGrupoCadaDato("/empresa/ajaxGetEmpresas","selectEmpresa","nombre");
}

function cargarNumPuestos(){
	var x = new XMLHttpRequest();

	x.open("POST", "/provisionpuestos/ajaxGetProvisionPuestosBySedeId", true);
	x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	x.setRequestHeader("X-Requested-With","XMLHttpRequest");
	x.send('idSede='+document.getElementById("selectSede").value);
	
	x.onreadystatechange=function(){
		if(x.readyState == 4 && x.status==200){
			document.getElementById('numeroPrevision').value=x.responseText;
		}
	}
}
</script>
<script>window.onload=function(){
	cargarGrupoDatos();
	setTimeout(function(){ cargarGrupoCadaDato('/sede/ajaxGetSedesByEmpresa','selectSede','direccion','idEmpresa='+document.getElementById("selectEmpresa").value); }, 500);
	setTimeout(function(){ cargarNumPuestos(); }, 1000);
}</script>