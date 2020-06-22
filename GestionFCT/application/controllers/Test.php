<?php
class Test extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        //verificarLogin();
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
    
    public function iniAdmin(){
        $this->load->model('usuario_model');
        if($this->usuario_model->existeAdmin()){
            $id = $this->usuario_model->crearUsuario("admin","stuparudani@gmail.com","admin",true);
            if($id > 0){
                $usuario = $this->usuario_model->getUsuarioById($id);
                $this->load->helper("mimail_helper");
                mandarMailActivacion($this,$usuario);
                echo "El administrador se ha creado correctamente";
            } else {
                echo "Error al crear el admin";
            }
        } else {
            echo "No se ha podido crear la cuenta admin, ya existe!";
        }
    }
    
    public function iniAuth(){
        $this->load->model('usuario_model');
        if(true){
            $id = $this->usuario_model->crearUsuario("Daniel Stuparu","razvan.stuparu@educa.madrid.org","Daniel123",false);
            if($id > 0){
                $usuario = $this->usuario_model->getUsuarioById($id);
                $this->load->helper("mimail_helper");
                mandarMailActivacion($this,$usuario);
                echo "La cuenta se ha creado correctamente";
            } else {
                echo "Error al crear el la cuenta";
            }
        } else {
            echo "No se ha podido crear la cuenta, ya existe!";
        }
    }
    
    public function iniPais(){
        $this->load->model('Pais_model');
        foreach (['España'] as $nombre){
            $this->Pais_model->c($nombre);
        }
    }
    
    public function iniCCAA(){
        $this->load->model('ComunidadAutonoma_model');
        foreach ([
            ['Comunidad de Madrid',"1"]
        ] as $ccaa){
            $this->ComunidadAutonoma_model->c($ccaa[0],$ccaa[1]);
        }
    }
    
    public function iniProvincia(){
        $this->load->model('Provincia_model');
        foreach ([
            ['Madrid',"1"]
        ] as $provincia){
            $this->Provincia_model->c($provincia[0],$provincia[1]);
        }
    }
    
    public function iniMunicipio(){
        $this->load->model('Municipio_model');
        foreach ([
            ['Torrejón de Ardoz',"1"]
        ] as $municipio){
            $this->Municipio_model->c($municipio[0],$municipio[1]);
        }
    }
    
    public function iniInstiMuni(){
        $municipio = R::load('municipio', "1");
        $instituto = R::dispense('instituto');
        $instituto->nombre = "Test Insti con Municipio";
        $instituto->municipio = $municipio;
        R::store($instituto);
    }
    
    public function inclauses(){
        $ids = ['25','26'];
        $alumnos = R::find('alumno',' id IN ('.R::genSlots($ids).') ', $ids);
        foreach ($alumnos as $alumno){
            //echo $alumno->nombre;
        }
        
        echo "<pre>";
        print_r($alumnos);
        echo "</pre>";
    }
}
?>