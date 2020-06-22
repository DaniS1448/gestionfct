<main class="page lanidng-page">
   <section id="nalumnos" class="portfolio-block block-intro">
      <div class="container">
         <div class="about-me">
            <form>
               <p>Crear nuevo grupo</p>
               <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre grupo" />
               <span class="text-danger" id="err-nombreGrupo" style="display:none"></span>
               
               <div class="form-group mt-4">
               		<label for="selectFamiliaProfesional">Familia profesional</label>
               		<select class="form-control" id="selectFamiliaProfesional" name="idFamiliaProfesional" 
               		onclick="cargarGrupoCadaDato('/titulacion/ajaxGetTitulacionesByFamiliaProfesional','selectTitulacion','nombre','idFamiliaProfesional='+this.value);"></select>
               </div>
               
               <div class="form-group mt-4">
               		<label for="selectTitulacion">Titulación</label>
               		<select class="form-control" id="selectTitulacion" name="idTitulacion"></select>
               		<span class="text-danger" id="err-titulacionGrupo" style="display:none"></span>
               </div>

               <div class="form-group mt-4">
               		<label for="nombreBuscarInstituto">Instituto</label>
               		<input type="hidden" class="form-control" name="nombre" id="idInstituto" />
               		<input type="text" class="form-control" id="nombreBuscarInstituto" placeholder="Nombre instituto" onfocus="mostrarElementoById('busquedaInstituto')" onblur="onBlurMiInput();" onkeyup="cargarLiInstitutos(this);" onclick="cargarLiInstitutos(this);"/>
               		<ul id="busquedaInstituto" class="busquedaInstituto" style="display:none"></ul>
               		<span class="text-danger" id="err-institutoGrupo" style="display:none"></span>
               </div>
               
               <span class="text-success mt-2" id="ok-nombreGrupo" style="display:none"></span>
               <button class="btn btn-outline-primary mt-3" type="button" id="btn-crear-grupo" onclick="crearGrupo();">Crear</button>
            </form>
         </div>
      </div>
   </section>
   <script>window.onload=function(){cargarGrupoDatos();}</script>
</main>
<script>

</script>