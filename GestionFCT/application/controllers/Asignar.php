<?php

class Asignar extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('Asignar_model');
    }
    
    public function c(){
        $data['scripts']=['asignar'];
        verificarRol();
        frame($this, "asignar/c",$data);
    }
    
    public function cPost(){
        verificarRol();
        $idGrupo = isset($_POST["idGrupo"])?$_POST["idGrupo"]:null;
        $idsAlumnos = isset($_POST["idsAlumnos"])?$_POST["idsAlumnos"]:[];
        if($idGrupo!=null){
            // CREACIÓN AUTOMÁTICA DE PRÁCTICAS
            $this->load->model('alumno_model');
            $alumnos = $this->alumno_model->getAlumnosByIds($idsAlumnos);

            //ALUMNOS
            foreach ($alumnos as $alumno){
                $origen = $alumno->latitud . "," . $alumno->longitud;
                $mode = $alumno->metodo_transporte;
                
                $arrResultado = devolverSedeMasCercana($this,$origen,$mode);
                if($arrResultado['idSede']!=null){
                    $this->Asignar_model->crearPractica($alumno->id,$arrResultado['idSede'],$arrResultado['distancia'],$arrResultado['duracion'],$_SESSION['user']->id,$idGrupo);
                } else {
                    session_start_seguro();
                    $_SESSION['_msg']['tipo']="danger";
                    $_SESSION['_msg']['texto']="No quedan sedes con puestos disponibles";
                    $_SESSION['_msg']['uri']='/';
                    redirect(base_url() . 'msg');
                }
                

            }

        } else {
            session_start_seguro();
            $_SESSION['_msg']['tipo']="danger";
            $_SESSION['_msg']['texto']="No existe id grupo";
            $_SESSION['_msg']['uri']='asignar/c';
            redirect(base_url() . 'msg');
        }
    }
    
    public function paso1(){
        verificarRol();
        $this->load->model('Anexo_model');
        $data['scripts']=['Sortable.min','asignar'];
        $data['anexos']=$this->Anexo_model->getAnexosCursoActual();
        frame($this, "asignar/paso1",$data);
    }
    
    public function mockup(){
        verificarRol();
        $data['scripts']=['Sortable.min','asignar'];
        frame($this, "asignar/mockup",$data);
    }

}
?>









