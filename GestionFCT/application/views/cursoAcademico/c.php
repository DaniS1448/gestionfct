<main class="page lanidng-page">
   <section id="nalumnos" class="portfolio-block block-intro">
      <div class="container">
         <div class="about-me">
            <form method="post" action="<?= base_url() ?>cursoacademico/cPost">
               <p>Crear nuevo curso académico</p>
               <input type="text" class="form-control" name="anyoini" placeholder="Año de cominezo" />
               <div class="form-check mt-4">
               	<input type="checkbox" class="form-check-input" id="formCheck-1" onchange="duplicarCursoAcademicoAnterior(this);"/>
               	<label class="form-check-label" for="formCheck-1">Duplicar un curso académico anterior</label>
               </div>
               <div id="divCursosAcademicosAnteriores" style="display:none;">
                  <select class="form-control" id="selectCursosAcademicosAnteriores" name="idCursoAnterior">
                        
                  </select>
               </div>
               <button class="btn btn-outline-primary mt-3" type="submit">Siguiente</button>
            </form>
         </div>
      </div>
   </section>
</main>

<script>
var respuesta;
function duplicarCursoAcademicoAnterior(elemento){
	toggleOcultarElemento("divCursosAcademicosAnteriores");
	if(elemento.checked){
		var x = new XMLHttpRequest();

		x.open("POST",
				"/cursoacademico/ajaxGetCursosAcademicos",
				true);
		x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		x.setRequestHeader("X-Requested-With","XMLHttpRequest");
		x.send();
		
		x.onreadystatechange=function(){
			if(x.readyState == 4 && x.status==200){
				//console.log(x.responseText);
				respuesta = JSON.parse(x.responseText);
				//console.log(respuesta);
				var selectCA = document.getElementById("selectCursosAcademicosAnteriores");
				selectCA.innerHTML = "";
				for(opcion in respuesta){
					var option = document.createElement("option");
					option.text = respuesta[opcion].anyoini;
					option.value = respuesta[opcion].id;
					selectCA.add(option);
				}
					
			}
		}
	}
}
</script>