<main class="page lanidng-page">
   <section id="nalumnos" class="portfolio-block block-intro">
      <div class="container">
         <div class="about-me">
            <form>
               <p>Crear nuevo Instituto</p>
               <input type="text" class="form-control" name="nombre" id="nombreInstituto" placeholder="Nombre instituto" />
               <span class="text-danger" id="err-nombreInstituto" style="display:none"></span>
               <div class="form-check mt-4">
               	<input type="checkbox" class="form-check-input" id="formCheckMasDatos" onchange="toggleElemento('divMasDatos');"/>
               	<label class="form-check-label" for="formCheckMasDatos">Introducir más datos del instituto</label>
               </div>
               <div id="divMasDatos" style="display:none;">
                  <input type="text" class="form-control" name="n_centro" id="n_centro" placeholder="Número del centro" />
                  <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección" />
                  <input type="text" class="form-control" name="cif" id="cif" placeholder="CIF" />
                  <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" />
                  <input type="text" class="form-control" name="email" id="email" placeholder="Email" />
               </div>
               <span class="text-success mt-2" id="ok-nombreInstituto" style="display:none"></span>
               <button class="btn btn-outline-primary mt-3" type="button" id="btn-crear-instituto" onclick="crearInstituto();">Crear</button>
            </form>
         </div>
      </div>
   </section>
</main>