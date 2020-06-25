<main class="page lanidng-page">
    <section id="asignacion-alumnos" class="portfolio-block block-intro">
        <p>Asignación de los alumnos</p>
        <div class="container">
            <div class="row row-cols-2" id="lista-empresas">
                
                <!-- INI LISTA ANEXOS -->
                <?php foreach ($anexos as $anexo):?>
                <div class="col"><i class="fa fa-remove icono-eliminar-empresa" style="font-size: 22px;" onclick="delEmpresa(this);"></i>
                    <div class="mi-fila empresa-elemento m-2">
                        <div class="row mb-4">
                            <div class="col-xl-4 d-flex justify-content-center align-items-center"><img class="foto-empresa" style="background-image: url('<?=base_url(); ?>assets/img/empresa/EmpresaDefault.png');" src="<?=base_url(); ?>assets/img/empresa/EmpresaDefault.png" height="100px" /></div>
                            <div class="col">
                                <div class="text-right"><span>4/10 <i class="icon ion-person-stalker"></i></span></div>
                                <h1><?= $anexo->sede->empresa->nombre ?></h1><span><?= $anexo->sede->direccion ?><br /></span><span>Teléfono: xxxxxxxxx<br /></span></div>
                        </div>
                        <div class="row no-gutters row-cols-2 lista-alumnos">
                            
                            <!-- INI LISTA ALUMNOS -->
                            	<?php foreach ($anexo->ownPracticaList as $practica):?>
                            	<div class="col">
                                <div class="alumno-elemento m-2 p-2 rounded"><i class="fa fa-arrows handle-mover-alumno handle-pos-alumno-aisgnado"></i>
                                    <div class="row no-gutters">
                                        <div class="col-auto"><img class="rounded-circle" src="<?=base_url(); ?>assets/img/alumno/AlumnoDefault.png" height="45px" /></div>
                                        <div class="col">
                                            <div class="row no-gutters">
                                                <div class="col text-center"><span class="text-left ml-1 font-weight-bold"><?= $practica->alumno->nombre ?> <?= $practica->alumno->apellido ?></span></div>
                                            </div>
                                            <div class="row no-gutters text-center d-xl-flex justify-content-xl-center">
                                                <div class="col-auto">
                                                    <div class="row">
                                                        <div class="col-auto"><i class="fa fa-<?= $practica->alumno->metodo_transporte=='driving'?'car':'train'; ?>"></i></div>
                                                        <div class="col-auto"><span class="small"><?= $practica->distancia_trayecto ?></span></div>
                                                        <div class="col-auto"><span class="small"><?= $practica->duracion_trayecto ?></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <?php endforeach;?>
                                <!-- FIN LISTA ALUMNOS -->
                        </div>
                    </div>
                </div>
                <?php endforeach;?>

                <!-- FIN LISTA ANEXOS -->

            </div>
        </div>
</main>

<script>
window.onload=function(){
	crearElementosSortable();
}
</script>