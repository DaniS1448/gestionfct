<main class="page lanidng-page">
   <section id="nalumnos" class="portfolio-block block-intro">
      <div class="container">
         <div class="about-me">
            <form>
               <p>Crear nuevo curso académico</p>
               <input type="text" class="form-control" name="anyoini" id="anyoini" placeholder="Año de cominezo" />
               <span class="text-danger" id="err-crearCursoAcademico" style="display:none"></span>
               <div class="form-check mt-4">
               	<input type="checkbox" class="form-check-input" id="formCheckDuplicarCurso" onchange="duplicarCursoAcademicoAnterior(this);"/>
               	<label class="form-check-label" for="formCheckDuplicarCurso">Duplicar un curso académico anterior</label>
               </div>
               <div id="divCursosAcademicosAnteriores" style="display:none;">
                  <select class="form-control" id="selectCursosAcademicosAnteriores" name="idCursoAnterior">
                        
                  </select>
               </div>
               <span class="text-success mt-2" id="ok-crearCursoAcademico" style="display:none"></span>
               <button class="btn btn-outline-primary mt-3" type="button" id="btn-crear-ca" onclick="crearCursoAcademico();">Crear</button>
            </form>
         </div>
      </div>
   </section>
</main>