<main class="page lanidng-page">
   <section id="nalumnos" class="portfolio-block block-intro">
      <div class="container">
         <div class="about-me">
            <form>
               <p>Crear nueva previsión puestos</p>
               
               <div class="form-group mt-4">
               		<label for="selectFamiliaProfesional">Empresa</label>
               		<select class="form-control" id="selectEmpresa"></select>
               </div>
               
               <div class="form-group mt-4">
                   <input type="text" class="form-control" name="nombre" id="direccion" placeholder="Dirección" onclick="autorellenar(this);"/>
                   <span class="text-danger" id="errDireccion" style="display:none"></span>
               </div>
               <input type="hidden" class="place_loc_lat" id="latitud" name="latitud">
               <input type="hidden" class="place_loc_long" id="longitud" name="longitud">
               
               <span class="text-success mt-2" id="okSede" style="display:none"></span>
               <button class="btn btn-outline-primary mt-3" type="button" id="btn-crear-sede" onclick="crearSede();">Crear</button>
            </form>
         </div>
      </div>
   </section>
</main>

<script>
function crearSede(){
	var errDireccion = document.getElementById("errDireccion");
	var okSede = document.getElementById("okSede");

	if(document.getElementById("direccion").value==""){
		ocultarElementos([okSede]);
		mostrarElemento(errDireccion);
		errDireccion.innerHTML="La dirección no puede estar vacía";
	}
	
	
	if(document.getElementById("direccion").value!="" && document.getElementById("latitud").value !="" && document.getElementById("longitud").value !=""){
		
		ocultarElementos([errDireccion,okSede]);
		var datos="direccion="+document.getElementById("direccion").value;
		datos+="&latitud="+document.getElementById("latitud").value;
		datos+="&longitud="+document.getElementById("longitud").value;
		datos+="&idEmpresa="+document.getElementById("selectEmpresa").value;

		desactivarBoton("btn-crear-sede", 3000);
		
		var x = new XMLHttpRequest();

		x.open("POST",
				"/sede/ajaxCPost",
				true);
		x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		x.setRequestHeader("X-Requested-With","XMLHttpRequest");
		x.send(datos);
		
		x.onreadystatechange=function(){
			if(x.readyState == 4 && x.status==200){
				var respuesta = JSON.parse(x.responseText);
				
				if(respuesta.estado == true){
					mostrarElementoById("okSede");
					var timeleft = 5;
					var downloadTimer = setInterval(function(){
					  if(timeleft <= 0){
					    clearInterval(downloadTimer);
					    window.location.href = "/";
					  } else {
						  document.getElementById("okSede").innerHTML = respuesta.mensaje + ".<br>Redirigiendo en " + timeleft + " segundos";
					  }
					  timeleft -= 1;
					}, 1000);
				} else {
					mostrarElemento(errDireccion);
					errDireccion.innerHTML=respuesta.mensaje;
					desactivarBoton("btn-crear-sede", 3000);
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
	cargarGrupoCadaDato("/empresa/ajaxGetEmpresas","selectEmpresa","nombre");
}
</script>
<script>window.onload=function(){cargarGrupoDatos();}</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=<?= getApiMaps();?>"></script>