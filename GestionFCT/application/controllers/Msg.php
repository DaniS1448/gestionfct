<?php
class Msg extends CI_Controller {
    
    public function index() {
        session_start_seguro();
        $data['tipo'] = isset($_SESSION['_msg']['tipo'])?$_SESSION['_msg']['tipo']:'info';
        $data['texto'] = isset($_SESSION['_msg']['texto'])?$_SESSION['_msg']['texto']:'No hay mensajes';
        $data['uri'] = isset($_SESSION['_msg']['uri'])?$_SESSION['_msg']['uri']:'';
        
        
        $data['tipoTitulo']="AVISO";
        $data['claseI']="fas fa-check fa-4x mb-3 animated rotateIn text-".$data['tipo'];
        
        if($data['tipo'] == "light" || $data['tipo'] == "white"){
            $data['colorTitulo']=$data['colorBtn']=$data['colorI']="dark";
        } else {
            $data['colorBtn']=$data['colorI']=$data['tipo'];
            $data['colorTitulo']="white";
        }

        if($data['tipo'] == "success"){
            $data['claseI']="fas fa-check-circle fa-4x mb-3 animated rotateIn text-".$data['colorI'];
        } elseif ($data['tipo'] == "warning"){
            $data['claseI']="fas fa-exclamation-circle fa-4x mb-3 animated rotateIn text-".$data['colorI'];
            $data['tipoTitulo']="ATENCIÓN";
        } elseif ($data['tipo'] == "danger"){
            $data['claseI']="fas fa-exclamation-circle fa-4x mb-3 animated rotateIn text-".$data['colorI'];
            $data['tipoTitulo']="ERROR";
        } else {
            $data['claseI']="fas fa-info-circle fa-4x mb-3 animated rotateIn text-".$data['colorI'];
        }
        
        unset ($_SESSION['_msg']);
        frame($this,'_templates/message',$data);
    }
}
?>