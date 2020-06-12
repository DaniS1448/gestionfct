<main class="page lanidng-page">
   <section id="nalumnos" class="portfolio-block block-intro">
      <div class="container">
         <div class="about-me">
            <form>
               <p>Crear nuevo usuario</p>
               <input type="text" class="form-control" id="email" placeholder="Email" />
               <span class="text-danger" id="errCrearUsuarioEmail" style="display:none"></span>
               <input type="password" class="form-control" id="pwd" placeholder="Contreaseña" />
               <span class="text-danger" id="errCrearUsuarioPwd" style="display:none"></span>
               <input type="password" class="form-control" id="nombre" placeholder="Nombre" />
               <span class="text-danger" id="errCrearUsuarioNombre" style="display:none"></span>
               <div class="form-check mt-4">
               	<input type="checkbox" class="form-check-input" id="formCheckAdmin" onchange="toggleElementoById('divDatosNoAdmin');"/>
               	<label class="form-check-label" for="formCheckAdmin"">Administrador</label>
               </div>
               <div id="divDatosNoAdmin" style="display:block;">
                  	<div class="form-group mt-4">
                   		<label for="nombreBuscarInstituto">Instituto</label>
                   		<input type="hidden" class="form-control" name="nombre" id="idInstituto" />
                   		<input type="text" class="form-control" id="nombreBuscarInstituto" placeholder="Nombre instituto" onfocus="mostrarElementoById('busquedaInstituto')" onblur="onBlurMiInput();" onkeyup="cargarLiInstitutos(this);" onclick="cargarLiInstitutos(this);"/>
                   		<span class="text-danger" id="errCrearUsuarioInstituto" style="display:none"></span>
                   		<ul id="busquedaInstituto" class="busquedaInstituto" style="display:none"></ul>
                   		<span class="text-danger" id="err-institutoGrupo" style="display:none"></span>
               		</div>
               		
               		<div class="form-group mt-4">
                   		<label>Grupos</label>
                   		<br>
                   		<div id="gruposCk"></div>
                   </div>
               </div>
               <span class="text-success mt-2" id="okCrearUsuario" style="display:none"></span>
               <button class="btn btn-outline-primary mt-3" type="button" id="btn-crear-ca" onclick="crearUsuario();">Crear</button>
            </form>
         </div>
      </div>
   </section>
</main>

<script>


function crearUsuario(){
	var email = document.getElementById("email").value;
	var pwd = document.getElementById("pwd").value;
	var nombre = document.getElementById("nombre").value;
	var errCrearUsuarioEmail = document.getElementById("errCrearUsuarioEmail");
	var errCrearUsuarioPwd = document.getElementById("errCrearUsuarioPwd");
	var errCrearUsuarioNombre = document.getElementById("errCrearUsuarioNombre");
	var errCrearUsuarioInstituto = document.getElementById("errCrearUsuarioInstituto");
	var okCrearUsuario = document.getElementById("okCrearUsuario");
	var formCheckAdmin = document.getElementById("formCheckAdmin");

	if(email==""){
		mostrarElemento(errCrearUsuarioEmail);
		ocultarElementos([errCrearUsuarioPwd,errCrearUsuarioNombre,okCrearUsuario,errCrearUsuarioInstituto]);
		errCrearUsuarioEmail.innerHTML="El email no puede estar vacío"
	}
	if(pwd==""){
		if(email !=""){ocultarElemento(errCrearUsuarioEmail);}
		ocultarElementos([errCrearUsuarioNombre,okCrearUsuario,errCrearUsuarioInstituto]);
		mostrarElemento(errCrearUsuarioPwd);
		errCrearUsuarioPwd.innerHTML="La contraseña no puede estar vacía"
	}
	if(nombre==""){
		if(email !=""){ocultarElemento(errCrearUsuarioEmail);}
		if(pwd !=""){ocultarElemento(errCrearUsuarioPwd);}
		ocultarElementos([okCrearUsuario, errCrearUsuarioInstituto]);
		mostrarElemento(errCrearUsuarioNombre);
		errCrearUsuarioNombre.innerHTML="El nombre no puede estar vacío"
	}

	if(!formCheckAdmin.checked && document.getElementById("idInstituto").value == ""){
		if(email !=""){ocultarElemento(errCrearUsuarioEmail);}
		if(pwd !=""){ocultarElemento(errCrearUsuarioPwd);}
		if(nombre !=""){ocultarElemento(errCrearUsuarioNombre);}
		ocultarElemento(okCrearUsuario);
		mostrarElemento(errCrearUsuarioInstituto);
		errCrearUsuarioInstituto.innerHTML="Si el nuevo usuario no es administrador debe seleccionar el instituto y grupos"
	}

	if(email != "" && pwd!="" && nombre!=""){
		ocultarElementos([errCrearUsuarioEmail,errCrearUsuarioPwd,errCrearUsuarioNombre,okCrearUsuario]);
		var datos = "email="+email;
		datos += "&pwd="+pwd;
		datos += "&nombre="+nombre;
		
		if(!formCheckAdmin.checked){
			for(grupo of document.getElementsByClassName("idsGrupos")){
				if(grupo.checked){
					datos += "&idsGrupo[]="+grupo.value;
				}
			}
		}

		var x = new XMLHttpRequest();

		x.open("POST",
				"/usuario/ajaxCPost",
				true);
		x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		x.setRequestHeader("X-Requested-With","XMLHttpRequest");
		x.send(datos);
		
		x.onreadystatechange=function(){
			if(x.readyState == 4 && x.status==200){
				var respuesta = JSON.parse(x.responseText);
				
				if(respuesta.estado == true){
					mostrarElemento(okCrearUsuario);
					
					var timeleft = 5;
					var downloadTimer = setInterval(function(){
					  if(timeleft <= 0){
					    clearInterval(downloadTimer);
					    window.location.href = "/";
					  } else {
						  okCrearUsuario.innerHTML = respuesta.mensaje + ".<br>Redirigiendo en " + timeleft + " segundos";
					  }
					  timeleft -= 1;
					}, 1000);
				} else {
					mostrarElemento(errCrearUsuarioEmail);
					mensajeErr.innerHTML=respuesta.mensaje;
				}
				desactivarBoton("btn-crear-grupo", 3000);
			}
		}
	}
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

			var gruposCk = document.getElementById("gruposCk");
			gruposCk.innerHTML="";
			
			for(opcion in respuesta){
				var idGrupo = respuesta[opcion].id;
				var nombreGrupo = respuesta[opcion].nombre;
				gruposCk.innerHTML+='<div class="form-check form-check-inline"><input class="form-check-input idsGrupos" type="checkbox" name="idsGrupos" id="idGrupo'+idGrupo+'" value="'+idGrupo+'"><label class="form-check-label" for="idGrupo'+idGrupo+'">'+nombreGrupo+'</label></div>';
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