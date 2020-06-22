<main class="page lanidng-page">
   <section id="introduccion-alumnos" class="portfolio-block block-intro">
      <div class="container">
         <div class="about-me">
            <form>
               <p>Crear alumnos</p>
               <div class="form-group mt-4">
                   	<label for="nombreBuscarInstituto">Instituto</label>
                   	<input type="hidden" class="form-control" id="idInstituto" />
                   	<input type="text" class="form-control" id="nombreBuscarInstituto" placeholder="Nombre instituto" onfocus="mostrarElementoById('busquedaInstituto')" onblur="onBlurMiInput();" onkeyup="cargarLiInstitutos(this);" onclick="cargarLiInstitutos(this);"/>
                   	<span class="text-danger" id="errCrearUsuarioInstituto" style="display:none"></span>
                   	<ul id="busquedaInstituto" class="busquedaInstituto" style="display:none"></ul>
               	</div>
               		
               	<div class="form-group mt-4">
                   	<label for="selectGrupo">Grupo</label>
                   	<select class="form-control" id="selectGrupo" name="idGrupo"></select>
                   	<span class="text-danger" id="errGrupo" style="display:none"></span>
               </div>

               <p>Introduzca todos los datos de los alumnos</p>
                <div id="grupo-alumnos">
                    <div class="border rounded grupo-alumno p-2 mb-3">
                        <div class="text-center numero-alumno mb-1"><span class="text-uppercase numAlumno">Alumno 1</span><i class="fa fa-remove icono-eliminar-alumno" onclick="delAlumno(this);"></i></div>
                        <div class="form-group d-flex" style="margin-bottom: 0px;width: 100%;">
                        	<input type="text" class="form-control" name="nombre" placeholder="Nombre" style="width: 50%;" />
                        	<input type="text" class="form-control" name="apellido" placeholder="Apellido" style="width: 50%;" />
                        </div>
                        <div class="form-group d-flex" style="margin-bottom: 0px;width: 100%;">
                        	<input type="text" class="form-control" name="dni" placeholder="DNI" style="width: 50%;" onblur="comprobarDNI(this)" />
                        	<input type="text" class="form-control" name="direccion" placeholder="Dirección" style="width: 50%;" onclick="autorellenar(this);" />
                        </div>
                        <input type="hidden" class="place_loc_lat" name="latitud">
                        <input type="hidden" class="place_loc_long" name="longitud">
                        
                        <div class="form-group d-flex" style="margin-bottom: 0px;width: 100%;">
                           	<label class="d-xl-flex align-items-center" for="metodoTransporte">Transporte: </label>
                           	<select class="form-control" id="metodoTransporte" name="metodoTransporte">
                               	<option value="driving" selected>En coche</option>
                               	<option value="transit">Transporte público</option>
                           	</select>
                       </div>
                       <span class="text-danger" style="display:none"></span>
                       
                       
                    </div>
                </div>
                <div style="padding-top: 26px;" onclick="addAlumno();"><i class="fa fa-plus-circle"></i><span style="padding-left: 9px;">Añadir más alumnos</span></div>

               <span class="text-success mt-2" id="okCrearUsuario" style="display:none"></span>
               <button class="btn btn-outline-primary mt-3" type="button" id="btn-crear-alumno" onclick="crearAlumno();">Crear</button>
            </form>
         </div>
      </div>
   </section>
</main>

<script>


function crearAlumno(){
	var errGrupo = document.getElementById("errGrupo");
	var mensajeOk = document.getElementById("okCrearUsuario");

	var idGrupo = document.getElementById("selectGrupo").value;

	if(idGrupo ==""){
		mostrarElemento(mensajeOk);
		mostrarElemento(errGrupo);
		errGrupo.innerHTML="Debes seleccionar un instituto y un grupo"
	} else {
		ocultarElementos([errGrupo,mensajeOk]);

		var todoOK = true;

		$("#grupo-alumnos .grupo-alumno").each(function(){
			var nombre = $(this).find("input[name='nombre']").val();
			var apellido = $(this).find("input[name='apellido']").val();
			var dni = $(this).find("input[name='dni']").val();
			var direccion = $(this).find("input[name='direccion']").val();
			var latitud = $(this).find("input[name='latitud']").val();
			var longitud = $(this).find("input[name='longitud']").val();
			var metodoTransporte = $(this).find("select[name='metodoTransporte']").val();
			errGrupoAlumno = $(this).find("span:last");
			
			if(nombre=="" || apellido=="" || dni=="" || direccion=="" || latitud=="" || longitud=="" || metodoTransporte==""){
				todoOK=false;
				errGrupoAlumno.show();
				errGrupoAlumno.text("Debes completar todos los campos");
			} else {
				errGrupoAlumno.hide();
			}
		});

		$("#grupo-alumnos .grupo-alumno").each(function(){
			var nombre = $(this).find("input[name='nombre']").val();
			var apellido = $(this).find("input[name='apellido']").val();
			var dni = $(this).find("input[name='dni']").val();
			var direccion = $(this).find("input[name='direccion']").val();
			var latitud = $(this).find("input[name='latitud']").val();
			var longitud = $(this).find("input[name='longitud']").val();
			var metodoTransporte = $(this).find("select[name='metodoTransporte']").val();

			if(todoOK){
				var numAlumno = $(this).find(".numAlumno");
				errGrupoAlumno = $(this).find("span:last");
				
				var datos="idGrupo="+idGrupo;
				datos+="&nombre="+nombre;
				datos+="&apellido="+apellido;
				datos+="&dni="+dni;
				datos+="&direccion="+direccion;
				datos+="&latitud="+latitud;
				datos+="&longitud="+longitud;
				datos+="&metodoTransporte="+metodoTransporte;
				var x = new XMLHttpRequest();

				x.open("POST",
						"/alumno/ajaxCPost",
						true);
				x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				x.setRequestHeader("X-Requested-With","XMLHttpRequest");
				x.send(datos);
				
				x.onreadystatechange=function(){
					//procesarRespuesta(x);
					if(x.readyState == 4 && x.status==200){
						var respuesta = JSON.parse(x.responseText);
						
						if(respuesta.estado == true){
							mostrarElemento(mensajeOk);
							numAlumno.text(respuesta.mensaje);
						} else {
							errGrupoAlumno.show();
							errGrupoAlumno.text(respuesta.mensaje);
						}
						desactivarBoton("btn-crear-alumno", 3000);
					}
				}
			}
			});

		if(todoOK){
			mostrarElemento(mensajeOk);
			var timeleft = 5;
			var downloadTimer = setInterval(function(){
			  if(timeleft <= 0){
			    clearInterval(downloadTimer);
			    window.location.href = "/";
			  } else {
				  mensajeOk.innerHTML = "Alumnos creados correctamente.<br>Redirigiendo en " + timeleft + " segundos";
			  }
			  timeleft -= 1;
			}, 1000);
		}
	}
}

function comprobarDNI(campo){
	//console.log(campo.value);
	var errDNI = campo.parentElement.parentElement.lastElementChild;
	errDNI.style.display = 'none';
	
	if(campo.value != ""){
		var datos="dni="+campo.value;
		var x = new XMLHttpRequest();

		x.open("POST", "/alumno/ajaxExisteDni", true);
		x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		x.setRequestHeader("X-Requested-With","XMLHttpRequest");
		x.send(datos);
		
		x.onreadystatechange=function(){
			if(x.readyState == 4 && x.status==200){
				var respuesta = JSON.parse(x.responseText);
				if(respuesta){
					errDNI.innerHTML="El DNI ya existe";
					errDNI.style.display = 'block';
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


function clickLiInstituto(elemento){
	document.getElementById("idInstituto").value=elemento.getAttribute("data-id-instituto");
	document.getElementById("nombreBuscarInstituto").value=elemento.getAttribute("data-nombre-instituto");
	document.getElementById("busquedaInstituto").innerHTML="";
	document.getElementById("nombreBuscarInstituto").disabled=true;

	cargarGrupos("/grupo/ajaxGetGruposByInstitutoId","idInstituto="+elemento.getAttribute("data-id-instituto"));
}

function cargarGrupos(url,datos){
	var x = new XMLHttpRequest();

	x.open("POST", url, true);
	x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	x.setRequestHeader("X-Requested-With","XMLHttpRequest");
	x.send(datos);
	
	x.onreadystatechange=function(){
		if(x.readyState == 4 && x.status==200){
			var respuesta = JSON.parse(x.responseText);
			var select = document.getElementById("selectGrupo");
			select.innerHTML = "";
			for(opcion in respuesta){
				var option = document.createElement("option");
				option.text = respuesta[opcion].nombre;
				option.value = respuesta[opcion].id;
				select.add(option);
			}
				
		}
	}
}

function cargarUl(url,idUl,campoText,datos){
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

</script>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=<?= getApiMaps();?>"></script>