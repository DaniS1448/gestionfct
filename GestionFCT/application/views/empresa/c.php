<main class="page lanidng-page">
   <section id="nalumnos" class="portfolio-block block-intro">
      <div class="container">
         <div class="about-me">
            <form>
               <p>Crear nueva Empresa</p>
               <input type="text" class="form-control" name="nombre" id="nombreEmpresa" placeholder="Nombre empresa" />
               <span class="text-danger" id="errNombreEmpresa" style="display:none"></span>
               
               <div class="form-group mt-4">
               		<input type="hidden" class="form-control" id="idMunicipio" />
               		<input type="text" class="form-control" id="nombreBuscarMunicipio" placeholder="Nombre municipio" onfocus="mostrarElementoById('busquedaMunicipio')" onblur="onBlurMiInput();" onkeyup="cargarLiInstitutos(this);" onclick="cargarLiInstitutos(this);"/>
               		<ul id="busquedaMunicipio" class="busquedaInstituto" style="display:none"></ul>
               		<span class="text-danger" id="errMunicipioGrupo" style="display:none"></span>
               </div>
               <div class="form-group mt-4">
                   <input type="text" class="form-control" name="nombre" id="cifInstituto" placeholder="CIF" onblur="comprobarCIF(this)"/>
                   <span class="text-danger" id="errCIF" style="display:none"></span>
               </div>
               
               <div class="form-group mt-4">
                   <input type="text" class="form-control" name="nombre" id="direccion" placeholder="Dirección" onclick="autorellenar(this);"/>
                   <span class="text-danger" id="errDireccion" style="display:none"></span>
               </div>
               <input type="hidden" class="place_loc_lat" id="latitud" name="latitud">
               <input type="hidden" class="place_loc_long" id="longitud" name="longitud">
               
               <div class="form-group mt-4">
               		<label for="selectFamiliaProfesional">Familia profesional</label>
               		<select class="form-control" id="selectFamiliaProfesional" name="idFamiliaProfesional" 
               		onclick="cargarGrupoCadaDato('/titulacion/ajaxGetTitulacionesByFamiliaProfesional','selectTitulacion','nombre','idFamiliaProfesional='+this.value);"></select>
               </div>
               
               <div class="form-group mt-4">
               		<label for="selectTitulacion">Titulación</label>
               		<select class="form-control" id="selectTitulacion" name="idTitulacion"></select>
               		<span class="text-danger" id="errTitulacionGrupo" style="display:none"></span>
               </div>
               
               <span class="text-success mt-2" id="okEmpresa" style="display:none"></span>
               <button class="btn btn-outline-primary mt-3" type="button" id="btn-crear-empresa" onclick="crearEmpresa();">Crear</button>
            </form>
         </div>
      </div>
   </section>
</main>

<script>
function crearEmpresa(){
	var errNombreEmpresa = document.getElementById("errNombreEmpresa");
	var errMunicipioGrupo = document.getElementById("errMunicipioGrupo");
	var errDireccion = document.getElementById("errDireccion");
	var errCIF = document.getElementById("errCIF");
	var errTitulacionGrupo = document.getElementById("errTitulacionGrupo");
	var okEmpresa = document.getElementById("okEmpresa");

	if(document.getElementById("nombreEmpresa").value==""){
		ocultarElementos([errMunicipioGrupo,errCIF,errDireccion,errTitulacionGrupo,okEmpresa]);
		mostrarElemento(errNombreEmpresa);
		errNombreEmpresa.innerHTML="El nombre de la empresa no puede estar vacío";
	}
	
	if(document.getElementById("idMunicipio").value ==""){
		if(document.getElementById("nombreEmpresa").value!=""){ocultarElemento(errNombreEmpresa);}
		ocultarElementos([errCIF,errDireccion,errTitulacionGrupo,okEmpresa]);
		mostrarElemento(errMunicipioGrupo);
		errMunicipioGrupo.innerHTML="El campo municipio no puede estar vacío";
	}

	if(document.getElementById("cifInstituto").value ==""){
		if(document.getElementById("nombreEmpresa").value!=""){ocultarElemento(errNombreEmpresa);}
		if(document.getElementById("idMunicipio").value !=""){ocultarElemento(errMunicipioGrupo);}
		ocultarElementos([errDireccion,errTitulacionGrupo,okEmpresa]);
		mostrarElemento(errCIF);
		errCIF.innerHTML="El campo CIF no puede estar vacío";
	}

	if(document.getElementById("direccion").value ==""){
		if(document.getElementById("nombreEmpresa").value!=""){ocultarElemento(errNombreEmpresa);}
		if(document.getElementById("idMunicipio").value !=""){ocultarElemento(errMunicipioGrupo);}
		if(document.getElementById("cifInstituto").value !=""){ocultarElemento(errCIF);}
		ocultarElementos([errTitulacionGrupo,okEmpresa]);
		mostrarElemento(errDireccion);
		errDireccion.innerHTML="El campo dirección no puede estar vacío";
	}

	if(document.getElementById("selectTitulacion").value ==""){
		if(document.getElementById("nombreEmpresa").value!=""){ocultarElemento(errNombreEmpresa);}
		if(document.getElementById("idMunicipio").value !=""){ocultarElemento(errMunicipioGrupo);}
		if(document.getElementById("cifInstituto").value !=""){ocultarElemento(errCIF);}
		if(document.getElementById("direccion").value !=""){ocultarElemento(errDireccion);}
		ocultarElementos([okEmpresa]);
		mostrarElemento(errTitulacionGrupo);
		errTitulacionGrupo.innerHTML="El campo dirección no puede estar vacío";
	}
	
	
	if(document.getElementById("nombreEmpresa").value!="" && document.getElementById("idMunicipio").value !=""
		&& document.getElementById("cifInstituto").value !="" && document.getElementById("direccion").value !=""
		&& document.getElementById("selectTitulacion").value !=""){
		
		ocultarElementos([errNombreEmpresa,errMunicipioGrupo,errCIF,errDireccion,errTitulacionGrupo,okEmpresa]);
		var datos="nombre="+document.getElementById("nombreEmpresa").value;
		datos+="&idMunicipio="+document.getElementById("idMunicipio").value;
		datos+="&cif="+document.getElementById("cifInstituto").value;
		datos+="&direccion="+document.getElementById("direccion").value;
		datos+="&latitud="+document.getElementById("latitud").value;
		datos+="&longitud="+document.getElementById("longitud").value;
		datos+="&idTitulacion="+document.getElementById("selectTitulacion").value;

		desactivarBoton("btn-crear-empresa", 7000);
		
		var x = new XMLHttpRequest();

		x.open("POST",
				"/empresa/ajaxCPost",
				true);
		x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		x.setRequestHeader("X-Requested-With","XMLHttpRequest");
		x.send(datos);
		
		x.onreadystatechange=function(){
			if(x.readyState == 4 && x.status==200){
				var respuesta = JSON.parse(x.responseText);
				
				if(respuesta.estado == true){
					mostrarElementoById("okEmpresa");
					var timeleft = 5;
					var downloadTimer = setInterval(function(){
					  if(timeleft <= 0){
					    clearInterval(downloadTimer);
					    window.location.href = "/";
					  } else {
						  document.getElementById("okEmpresa").innerHTML = respuesta.mensaje + ".<br>Redirigiendo en " + timeleft + " segundos";
					  }
					  timeleft -= 1;
					}, 1000);
				} else {
					mostrarElemento(errCIF);
					errCIF.innerHTML=respuesta.mensaje;
					desactivarBoton("btn-crear-empresa", 3000);
				}
			}
		}
	}
}

function autorellenar(campo){

	$(document).ready(function () {
	    var autocomplete;
	    autocomplete = new google.maps.places.Autocomplete((campo), {
	        types: ['geocode','establishment'],
	        componentRestrictions: {
	            country: "ES"
	        }
	    });
		
	    google.maps.event.addListener(autocomplete, 'place_changed', function () {
	        var near_place = autocomplete.getPlace();
			campo.parentElement.nextElementSibling.value=near_place.geometry.location.lat();
			campo.parentElement.nextElementSibling.nextElementSibling.value=near_place.geometry.location.lng();
	    });
	});
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
	cargarGrupoCadaDato("/familiaprofesional/ajaxGetFamiliasProfesionales","selectFamiliaProfesional","nombre");
}

function comprobarCIF(campo){
	var errCIF = document.getElementById("errCIF");
	ocultarElemento(errCIF);
	
	if(campo.value != ""){
		var datos="cif="+campo.value;
		var x = new XMLHttpRequest();

		x.open("POST", "/empresa/ajaxExisteCif", true);
		x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		x.setRequestHeader("X-Requested-With","XMLHttpRequest");
		x.send(datos);
		
		x.onreadystatechange=function(){
			if(x.readyState == 4 && x.status==200){
				var respuesta = JSON.parse(x.responseText);
				if(respuesta){
					errCIF.innerHTML="El CIF ya existe";
					mostrarElemento(errCIF);
				}
			}
		}
	}
	
}
</script>
<script>window.onload=function(){cargarGrupoDatos();}</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=<?= getApiMaps();?>"></script>