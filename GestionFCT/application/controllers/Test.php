<?php
class Test extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        verificarLogin();
    }
    
    public function index() {
        echo "ok";
    }
    
    public function testRol(){
        verificarRol();
        echo "ok";
    }
    
    public function devolverRol(){
        echo devolverRol();
    }
    
    public function iniCursoAcademico(){
        $this->load->model("CursoAcademico_model");
        $this->CursoAcademico_model->ini();
    }
    
    public function iniTitulaciones(){
        $this->load->model("FamiliaProfesional_model");
        $this->load->model("Nivel_model");
        $this->load->model("Titulacion_model");
        
//         foreach (['FPB','FPGM','FPGS','FPCE'] as $nombre){
//             $this->Nivel_model->c($nombre);
//         }

//         foreach (['Actividades Físicas y Deportivas','Administración y Gestión','Agraria','Artes Gráficas',
//             'Artes y Artesanías','Comercio y Marketing','Edificación y Obra Civil','Electricidad y Electrónica',
//             'Energía y Agua','Fabricación Mecánica','Hostelería y Turismo','Imagen Personal','Imagen y Sonido',
//             'Industrias Alimentarias','Industrias Extractivas','Informática y Comunicaciones','Instalación y Mantenimiento',
//             'Madera, Mueble y Corcho','Marítimo-Pesquera','Química','Sanidad','Seguridad y Medio Ambiente',
//             'Servicios Socioculturales y a la Comunidad','Textil, Confección y Piel','Transporte y Mantenimiento de Vehículos',
//             'Vidrio y Cerámica'] as $nombre){
//             $this->FamiliaProfesional_model->c($nombre);
//         }

//         foreach ([
//             ['Título Profesional Básico en Informática de Oficina','1','16'],
//             ['Título Profesional Básico en Informática y Comunicaciones','1','16'],
//             ['Técnico en Sistemas Microinformáticos y Redes','2','16'],
//             ['Técnico Superior en Administración de Sistemas Informáticos en Red','3','16'],
//             ['Técnico Superior en Desarrollo de Aplicaciones Multiplataforma','3','16'],
//             ['Técnico Superior en Desarrollo de Aplicaciones Web','3','16'],
//             ['Curso de Especialización en Ciberseguridad en Entornos de las Tecnologías de la Información','4','16']
//         ] as $titulacion){
//             $this->Titulacion_model->c($titulacion[0],$titulacion[1],$titulacion[2]);
//         }
        
    }
}
?>