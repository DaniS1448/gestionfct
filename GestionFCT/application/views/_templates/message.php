<section id="info" class="content-section mb-5" style="margin-top:5%;">
<!--Content-->
     <div class="modal-content m-auto" style="width:50%;">
       <!--Header-->
       <div class="modal-header bg-<?=$tipo?>">
         <p class="modal-title text-<?= $colorTitulo ?>"><?=$tipoTitulo?></p>
       </div>

       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
           <i class="<?= $claseI ?>"></i>
           <p><?=$texto?></p>
         </div>
       </div>

       <!--Footer-->
       <div class="modal-footer justify-content-center">
         <a class="btn btn-outline-<?=$colorBtn?>" href="<?=base_url()?><?=$uri?>">Volver</a>
       </div>
     </div>
     <!--/.Content-->
</section>