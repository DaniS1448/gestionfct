<main class="page lanidng-page">
   <section id="introduccion-alumnos" class="portfolio-block block-intro">
      <div class="container">
         <div class="about-me">
            <form method="post" action="<?= base_url(); ?>asignar/cPost">
               <p>Asignar prácticas</p>               		
               	<div class="form-group mt-4">
                   	<label for="selectGrupo">Grupo</label>
                   	<select class="form-control" id="selectGrupo" name="idGrupo" onclick="cargarAlumnos('/alumno/ajaxGetAlumnosByGrupoId','idGrupo='+this.value);"></select>
                   	<span class="text-danger" id="errGrupo" style="display:none"></span>
               </div>
               
               <div class="form-group mt-4">
                	<label>Alumnos</label>
               		<br>
               		<div id="alumnosCk"></div>
               </div>
               <button class="btn btn-outline-primary mt-3" type="subbmit" id="btn-crear-alumno">Siguiente</button>
            </form>
         </div>
      </div>
   </section>
</main>

<script>


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


function cargarAlumnos(url,datos){
	var x = new XMLHttpRequest();

	x.open("POST", url, true);
	x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	x.setRequestHeader("X-Requested-With","XMLHttpRequest");
	x.send(datos);
	
	x.onreadystatechange=function(){
		if(x.readyState == 4 && x.status==200){
			var respuesta = JSON.parse(x.responseText);

			var alumnosCk = document.getElementById("alumnosCk");
			alumnosCk.innerHTML="";
			
			for(opcion in respuesta){
				var idAlumno = respuesta[opcion].id;
				var nombreGrupo = respuesta[opcion].nombre;
				alumnosCk.innerHTML+='<div class="form-check form-check-inline"><input class="form-check-input idsAlumnos" type="checkbox" name="idsAlumnos[]" id="idAlumno'+idAlumno+'" value="'+idAlumno+'" checked><label class="form-check-label" for="idAlumno'+idAlumno+'">'+nombreGrupo+'</label></div>';
			}
				
		}
	}
}


</script>

<script>window.onload=function(){
	cargarGrupos("/grupo/ajaxGetGruposByUsuarioId");
	setTimeout(function(){ cargarAlumnos("/alumno/ajaxGetAlumnosByGrupoId","idGrupo="+document.getElementById("selectGrupo").value); }, 500);
}</script>