<main class="page lanidng-page">
    <section id="asignacion-alumnos" class="portfolio-block block-intro">
        <div>Lo que yo quiera</div>
        <p>Filtrar empresas</p>
        <div class="container">
            <div class="row">
                <div class="col-3 offset-3">
                    <h5 class="mb-3">Empresas desbloqueadas</h5><input type="text" class="w-100" placeholder="Buscar empresa desbloqueada" />
                    <ul class="list-group empresas-desbloqueadas border">
                        <li class="list-group-item d-xl-flex justify-content-xl-center align-items-xl-center"><img src="<?=base_url(); ?>assets/img/empresa/EmpresaDefault.png" style="height: 25px;" /><span class="mx-1">Panell Systems 1</span><i class="material-icons text-success">check_circle</i></li>
                        <li class="list-group-item d-xl-flex justify-content-xl-center align-items-xl-center"><img src="<?=base_url(); ?>assets/img/empresa/EmpresaDefault.png" style="height: 25px;" /><span class="mx-1">Panell Systems 2</span><i class="material-icons text-success">check_circle</i></li>
                        <li class="list-group-item d-xl-flex justify-content-xl-center align-items-xl-center"><img src="<?=base_url(); ?>assets/img/empresa/EmpresaDefault.png" style="height: 25px;" /><span class="mx-1">Panell Systems 3</span><i class="material-icons text-success">check_circle</i></li>
                    </ul>
                </div>
                <div class="col-3">
                    <h5 class="mb-3">Empresas bloqueadas</h5><input type="text" class="w-100" placeholder="Buscar empresa bloqueada" />
                    <ul class="list-group empresas-bloqueadas border">
                        <li class="list-group-item d-xl-flex justify-content-xl-center align-items-xl-center"><img src="<?=base_url(); ?>assets/img/empresa/EmpresaDefault.png" style="height: 25px;" /><span class="mx-1">Panell Systems 4</span><i class="material-icons text-danger">cancel</i></li>
                        <li class="list-group-item d-xl-flex justify-content-xl-center align-items-xl-center"><img src="<?=base_url(); ?>assets/img/empresa/EmpresaDefault.png" style="height: 25px;" /><span class="mx-1">Panell Systems 5</span><i class="material-icons text-danger">cancel</i></li>
                    </ul>
                </div>
            </div>
        </div>
        <p class="mt-5">Asignación de los alumnos</p>
        <div class="container">
            <div class="row row-cols-2" id="lista-empresas">
                <div class="col"><i class="fa fa-remove icono-eliminar-empresa" style="font-size: 22px;" onclick="delEmpresa(this);"></i>
                    <div class="mi-fila empresa-elemento m-2">
                        <div class="row mb-4">
                            <div class="col-xl-4 d-flex justify-content-center align-items-center"><img class="foto-empresa" style="background-image: url('<?=base_url(); ?>assets/img/empresa/EmpresaDefault.png');" src="<?=base_url(); ?>assets/img/empresa/EmpresaDefault.png" height="100px" /></div>
                            <div class="col">
                                <div class="text-right"><span>4/10 <i class="icon ion-person-stalker"></i></span></div>
                                <h1>Panell Systems</h1><span>Calle Condesa de Venadito, 528027 Madrid<br /></span><span>Teléfono: 914057878<br /></span></div>
                        </div>
                        <div class="row no-gutters row-cols-2 lista-alumnos">
                            <div class="col">
                                <div class="alumno-elemento m-2 p-2 rounded"><i class="fa fa-arrows handle-mover-alumno handle-pos-alumno-aisgnado"></i>
                                    <div class="row no-gutters">
                                        <div class="col-auto"><img class="rounded-circle" src="<?=base_url(); ?>assets/img/alumno/AlumnoDefault.png" height="45px" /></div>
                                        <div class="col">
                                            <div class="row no-gutters">
                                                <div class="col text-center"><span class="text-left ml-1 font-weight-bold">Razvan Daniel Stuparu</span></div>
                                            </div>
                                            <div class="row no-gutters text-center d-xl-flex justify-content-xl-center">
                                                <div class="col-auto">
                                                    <div class="row">
                                                        <div class="col"><i class="fa fa-car"></i></div>
                                                        <div class="col"><span class="small">20km</span></div>
                                                        <div class="col"><span class="small">1,3h</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="alumno-elemento m-2 p-2 rounded"><i class="fa fa-arrows handle-mover-alumno handle-pos-alumno-aisgnado"></i>
                                    <div class="row no-gutters">
                                        <div class="col-auto"><img class="rounded-circle" src="<?=base_url(); ?>assets/img/alumno/AlumnoDefault.png" height="45px" /></div>
                                        <div class="col">
                                            <div class="row no-gutters">
                                                <div class="col text-center"><span class="text-left ml-1 font-weight-bold">Razvan Daniel Stuparu</span></div>
                                            </div>
                                            <div class="row no-gutters text-center d-xl-flex justify-content-xl-center">
                                                <div class="col-auto">
                                                    <div class="row">
                                                        <div class="col"><i class="fa fa-car"></i></div>
                                                        <div class="col"><span class="small">20km</span></div>
                                                        <div class="col"><span class="small">1,3h</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="alumno-elemento m-2 p-2 rounded"><i class="fa fa-arrows handle-mover-alumno handle-pos-alumno-aisgnado"></i>
                                    <div class="row no-gutters">
                                        <div class="col-auto"><img class="rounded-circle" src="<?=base_url(); ?>assets/img/alumno/AlumnoDefault.png" height="45px" /></div>
                                        <div class="col">
                                            <div class="row no-gutters">
                                                <div class="col text-center"><span class="text-left ml-1 font-weight-bold">Razvan Daniel Stuparu</span></div>
                                            </div>
                                            <div class="row no-gutters text-center d-xl-flex justify-content-xl-center">
                                                <div class="col-auto">
                                                    <div class="row">
                                                        <div class="col"><i class="fa fa-car"></i></div>
                                                        <div class="col"><span class="small">20km</span></div>
                                                        <div class="col"><span class="small">1,3h</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="alumno-elemento m-2 p-2 rounded"><i class="fa fa-arrows handle-mover-alumno handle-pos-alumno-aisgnado"></i>
                                    <div class="row no-gutters">
                                        <div class="col-auto"><img class="rounded-circle" src="<?=base_url(); ?>assets/img/alumno/AlumnoDefault.png" height="45px" /></div>
                                        <div class="col">
                                            <div class="row no-gutters">
                                                <div class="col text-center"><span class="text-left ml-1 font-weight-bold">Razvan Daniel Stuparu</span></div>
                                            </div>
                                            <div class="row no-gutters text-center d-xl-flex justify-content-xl-center">
                                                <div class="col-auto">
                                                    <div class="row">
                                                        <div class="col"><i class="fa fa-car"></i></div>
                                                        <div class="col"><span class="small">20km</span></div>
                                                        <div class="col"><span class="small">1,3h</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col"><i class="fa fa-remove icono-eliminar-empresa" style="font-size: 22px;" onclick="delEmpresa(this);"></i>
                    <div class="mi-fila empresa-elemento m-2">
                        <div class="row mb-4">
                            <div class="col-xl-4 d-flex justify-content-center align-items-center"><img class="foto-empresa" style="background-image: url('<?=base_url(); ?>assets/img/empresa/EmpresaDefault.png');" src="<?=base_url(); ?>assets/img/empresa/EmpresaDefault.png" height="100px" /></div>
                            <div class="col">
                                <div class="text-right"><span>4/10 <i class="icon ion-person-stalker"></i></span></div>
                                <h1>Panell Systems</h1><span>Calle Condesa de Venadito, 528027 Madrid<br /></span><span>Teléfono: 914057878<br /></span></div>
                        </div>
                        <div class="row no-gutters row-cols-2 lista-alumnos">
                            <div class="col">
                                <div class="alumno-elemento m-2 p-2 rounded"><i class="fa fa-arrows handle-mover-alumno handle-pos-alumno-aisgnado"></i>
                                    <div class="row no-gutters">
                                        <div class="col-auto"><img class="rounded-circle" src="<?=base_url(); ?>assets/img/alumno/AlumnoDefault.png" height="45px" /></div>
                                        <div class="col">
                                            <div class="row no-gutters">
                                                <div class="col text-center"><span class="text-left ml-1 font-weight-bold">Razvan Daniel Stuparu</span></div>
                                            </div>
                                            <div class="row no-gutters text-center d-xl-flex justify-content-xl-center">
                                                <div class="col-auto">
                                                    <div class="row">
                                                        <div class="col"><i class="fa fa-car"></i></div>
                                                        <div class="col"><span class="small">20km</span></div>
                                                        <div class="col"><span class="small">1,3h</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="alumno-elemento m-2 p-2 rounded"><i class="fa fa-arrows handle-mover-alumno handle-pos-alumno-aisgnado"></i>
                                    <div class="row no-gutters">
                                        <div class="col-auto"><img class="rounded-circle" src="<?=base_url(); ?>assets/img/alumno/AlumnoDefault.png" height="45px" /></div>
                                        <div class="col">
                                            <div class="row no-gutters">
                                                <div class="col text-center"><span class="text-left ml-1 font-weight-bold">Razvan Daniel Stuparu</span></div>
                                            </div>
                                            <div class="row no-gutters text-center d-xl-flex justify-content-xl-center">
                                                <div class="col-auto">
                                                    <div class="row">
                                                        <div class="col"><i class="fa fa-car"></i></div>
                                                        <div class="col"><span class="small">20km</span></div>
                                                        <div class="col"><span class="small">1,3h</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="alumno-elemento m-2 p-2 rounded"><i class="fa fa-arrows handle-mover-alumno handle-pos-alumno-aisgnado"></i>
                                    <div class="row no-gutters">
                                        <div class="col-auto"><img class="rounded-circle" src="<?=base_url(); ?>assets/img/alumno/AlumnoDefault.png" height="45px" /></div>
                                        <div class="col">
                                            <div class="row no-gutters">
                                                <div class="col text-center"><span class="text-left ml-1 font-weight-bold">Razvan Daniel Stuparu</span></div>
                                            </div>
                                            <div class="row no-gutters text-center d-xl-flex justify-content-xl-center">
                                                <div class="col-auto">
                                                    <div class="row">
                                                        <div class="col"><i class="fa fa-car"></i></div>
                                                        <div class="col"><span class="small">20km</span></div>
                                                        <div class="col"><span class="small">1,3h</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="alumno-elemento m-2 p-2 rounded"><i class="fa fa-arrows handle-mover-alumno handle-pos-alumno-aisgnado"></i>
                                    <div class="row no-gutters">
                                        <div class="col-auto"><img class="rounded-circle" src="<?=base_url(); ?>assets/img/alumno/AlumnoDefault.png" height="45px" /></div>
                                        <div class="col">
                                            <div class="row no-gutters">
                                                <div class="col text-center"><span class="text-left ml-1 font-weight-bold">Razvan Daniel Stuparu</span></div>
                                            </div>
                                            <div class="row no-gutters text-center d-xl-flex justify-content-xl-center">
                                                <div class="col-auto">
                                                    <div class="row">
                                                        <div class="col"><i class="fa fa-car"></i></div>
                                                        <div class="col"><span class="small">20km</span></div>
                                                        <div class="col"><span class="small">1,3h</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p class="mt-5">Alumnos no asignados</p>
        <div class="container">
            <div class="row">
                <div class="col-1 d-xl-flex justify-content-xl-center align-items-xl-center"><i class="fa fa-caret-left flecha-iz"></i></div>
                <div class="col-10">
                    <div class="row no-gutters row-cols-4 lista-alumnos">
                        <div class="col">
                            <div class="alumno-elemento m-2 p-2 rounded">
                                <div class="row no-gutters justify-content-center align-items-center align-content-center">
                                    <div class="col text-center"><i class="fa fa-arrows handle-mover-alumno handle-pos-alumno-no-aisgnado"></i><img class="rounded-circle" src="<?=base_url(); ?>assets/img/alumno/AlumnoDefault.png" height="30px" /><span class="text-left ml-1 font-weight-bold">Razvan Daniel Stuparu</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alumno-elemento m-2 p-2 rounded">
                                <div class="row no-gutters justify-content-center align-items-center align-content-center">
                                    <div class="col text-center"><i class="fa fa-arrows handle-mover-alumno handle-pos-alumno-no-aisgnado"></i><img class="rounded-circle" src="<?=base_url(); ?>assets/img/alumno/AlumnoDefault.png" height="30px" /><span class="text-left ml-1 font-weight-bold">Razvan Daniel Stuparu</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alumno-elemento m-2 p-2 rounded">
                                <div class="row no-gutters justify-content-center align-items-center align-content-center">
                                    <div class="col text-center"><i class="fa fa-arrows handle-mover-alumno handle-pos-alumno-no-aisgnado"></i><img class="rounded-circle" src="<?=base_url(); ?>assets/img/alumno/AlumnoDefault.png" height="30px" /><span class="text-left ml-1 font-weight-bold">Razvan Daniel Stuparu</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alumno-elemento m-2 p-2 rounded">
                                <div class="row no-gutters justify-content-center align-items-center align-content-center">
                                    <div class="col text-center"><i class="fa fa-arrows handle-mover-alumno handle-pos-alumno-no-aisgnado"></i><img class="rounded-circle" src="<?=base_url(); ?>assets/img/alumno/AlumnoDefault.png" height="30px" /><span class="text-left ml-1 font-weight-bold">Razvan Daniel Stuparu</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1 d-xl-flex justify-content-xl-center align-items-xl-center"><i class="fa fa-caret-right flecha-iz"></i></div>
            </div>
        </div>
        <p class="mt-5">Empresas disponibles</p>
        <div class="container">
            <div class="row lista-alumnos">
                <div class="col-1 d-xl-flex justify-content-xl-center align-items-xl-center"><i class="fa fa-caret-left flecha-iz"></i></div>
                <div class="col-10">
                    <div class="row no-gutters row-cols-4 lista-alumnos">
                        <div class="col">
                            <div class="alumno-elemento m-2 p-3 rounded">
                                <div class="row no-gutters justify-content-center align-items-center align-content-center">
                                    <div class="col text-center">
                                        <div><i class="material-icons icono-asig-empresa" onclick="addEmpresa();">assignment</i><span>4/10 <i class="icon ion-person-stalker"></i></span></div><img class="rounded-circle" src="<?=base_url(); ?>assets/img/empresa/EmpresaDefault.png" height="80px"
                                        /></div>
                                </div>
                                <div class="row text-center d-xl-flex justify-content-xl-center">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <h4>Panell Systems</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><span class="small">Calle Condesa de Venadito, 528027 Madrid<br /></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alumno-elemento m-2 p-3 rounded">
                                <div class="row no-gutters justify-content-center align-items-center align-content-center">
                                    <div class="col text-center">
                                        <div><i class="material-icons icono-asig-empresa" onclick="addEmpresa();">assignment</i><span>4/10 <i class="icon ion-person-stalker"></i></span></div><img class="rounded-circle" src="<?=base_url(); ?>assets/img/empresa/EmpresaDefault.png" height="80px"
                                        /></div>
                                </div>
                                <div class="row text-center d-xl-flex justify-content-xl-center">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <h4>Panell Systems</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><span class="small">Calle Condesa de Venadito, 528027 Madrid<br /></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alumno-elemento m-2 p-3 rounded">
                                <div class="row no-gutters justify-content-center align-items-center align-content-center">
                                    <div class="col text-center">
                                        <div><i class="material-icons icono-asig-empresa" onclick="addEmpresa();">assignment</i><span>4/10 <i class="icon ion-person-stalker"></i></span></div><img class="rounded-circle" src="<?=base_url(); ?>assets/img/empresa/EmpresaDefault.png" height="80px"
                                        /></div>
                                </div>
                                <div class="row text-center d-xl-flex justify-content-xl-center">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <h4>Panell Systems</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><span class="small">Calle Condesa de Venadito, 528027 Madrid<br /></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alumno-elemento m-2 p-3 rounded">
                                <div class="row no-gutters justify-content-center align-items-center align-content-center">
                                    <div class="col text-center">
                                        <div><i class="material-icons icono-asig-empresa" onclick="addEmpresa();">assignment</i><span>4/10 <i class="icon ion-person-stalker"></i></span></div><img class="rounded-circle" src="<?=base_url(); ?>assets/img/empresa/EmpresaDefault.png" height="80px"
                                        /></div>
                                </div>
                                <div class="row text-center d-xl-flex justify-content-xl-center">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <h4>Panell Systems</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><span class="small">Calle Condesa de Venadito, 528027 Madrid<br /></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1 d-xl-flex justify-content-xl-center align-items-xl-center"><i class="fa fa-caret-right flecha-iz"></i></div>
            </div>
        </div><a class="btn btn-outline-primary" role="button" href="asignar-4-asignar-alumnos.html" style="margin-top: 21px;">Siguiente</a></section>
</main>

<script>
window.onload=function(){
	crearElementosSortable();
}
</script>