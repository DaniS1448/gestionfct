<?php

class Usuario extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('usuario_model');
    }

    public function ajaxLoginPost(){
        if (esAjax()) {
            $loginEmail = isset($_POST['loginEmail'])?$_POST['loginEmail']:null;
            $loginPwd = isset($_POST['loginPwd'])?$_POST['loginPwd']:null;
            
            $respuesta = $this->usuario_model->verificarLogin($loginEmail,$loginPwd);
            if($respuesta['estado']){
                $_SESSION['user']=$this->usuario_model->getUsuarioByEmail($loginEmail);
            } else {
                unset($_SESSION['user']);
            }
            
            echo json_encode($respuesta);
            
        }
    }

    public function logout(){
        unset($_SESSION['user']);
        redirect(base_url());
    }

    public function vericarMail(){
        $key = isset($_GET['key'])?$_GET['key']:null;
        if($key !=  null && $key!= ""){
            session_start_seguro();
            if($this->usuario_model->verificarEmail($key)){
                $_SESSION['_msg']['tipo']="success";
                $_SESSION['_msg']['texto']="Su mail ha sido verificado!";
                $_SESSION['_msg']['uri']='';
                
            } else {
                $_SESSION['_msg']['tipo']="danger";
                $_SESSION['_msg']['texto']="Su mail no ha sido verificado!";
                $_SESSION['_msg']['uri']='';
            }
            redirect(base_url() . 'msg');
        }
    }

    public function reenviarActivacion(){
        $email = isset($_GET['email'])?$_GET['email']:null;
        session_start_seguro();
        $_SESSION['_msg']['tipo']="danger";
        $_SESSION['_msg']['texto']="Ha habido algún error al mandar el mail de verificación";
        $_SESSION['_msg']['uri']='';
        if($email != null && $this->usuario_model->comprobarMailNoVerificado($email)){
            $this->load->helper("mimail_helper");
            $usuario = $this->usuario_model->getUsuarioByEmail($email);
            if($usuario != null){
                if(mandarMailActivacion($this,$usuario)){
                    $_SESSION['_msg']['tipo']="success";
                    $_SESSION['_msg']['texto']="El mail ha sido enviado, compruebe su bandeja de entrada o spam!";
                } else {
                    $_SESSION['_msg']['tipo']="danger";
                    $_SESSION['_msg']['texto']="El servidor mail ha fallado, no ha sido posible mandar su mail";
                }
            }
        }
        redirect(base_url() . 'msg');
    }

    public function ajaxRecuperarPwdPost(){
        if (esAjax()) {
            $email = isset($_POST['email'])?$_POST['email']:null;
            $respuesta['estado']=false;
            $respuesta['mensaje']="¡Comprueba que el mail sea correcto!";
            if($email != null && $this->usuario_model->cambiarVerifKey($email)){
                $this->load->helper("mimail_helper");
                $usuario = $this->usuario_model->getUsuarioByEmail($email);
                if(mandarMailRecupPwd($this,$usuario)){
                    $respuesta['estado']=true;
                    $respuesta['mensaje']="Hemos enviado un mail con las instrucciones. ¡Compruebe su bandeja de entrada o spam!";
                } else {
                    $respuesta['mensaje']="El servidor mail ha fallado, no ha sido posible mandar su mail";
                }
                
            }
            
            echo json_encode($respuesta);
            
        }
    }

    public function recuperarPwd(){
        $key = isset($_GET['key'])?$_GET['key']:null;
        if($key !=  null && $key!= ""){
            $data['key']=$key;
            $data['scripts']=['login'];
            frame($this, 'usuario/recuperarPwd',$data);
        } else{
            session_start_seguro();
            $_SESSION['_msg']['tipo']="danger";
            $_SESSION['_msg']['texto']="Hay un problema con la recuperación de contraseña";
            $_SESSION['_msg']['uri']='';
            redirect(base_url() . 'msg');
        }
    }

    public function recuperarPwdPost(){
        $key = isset($_POST['key'])?$_POST['key']:null;
        $newPwd = isset($_POST['newPwd'])?$_POST['newPwd']:null;
        if($key!=null && $newPwd!=null && $key!="" && $newPwd!=""){
            $this->usuario_model->recuperarPwd($key,$newPwd);
        }
        session_start_seguro();
        $_SESSION['_msg']['tipo']="success";
        $_SESSION['_msg']['texto']="La contraseña ha sido actualizada!";
        $_SESSION['_msg']['uri']='';
        redirect(base_url() . 'msg');  
    }
    
    public function c(){
        verificarRol("admin");
        $data['scripts']=['usuario'];
        frame($this, "usuario/c",$data);
    }
    
    public function ajaxCPost(){
        if(esAjax()){
            $email = isset($_POST['email'])?$_POST['email']:null;
            $pwd = isset($_POST['pwd'])?$_POST['pwd']:null;
            $nombre = isset($_POST['nombre'])?$_POST['nombre']:null;
            $idsGrupo = isset($_POST['idsGrupo'])?$_POST['idsGrupo']:null;
            
            $respuesta['estado']=false;
            $respuesta['mensaje']="";
            
            if($email!=null && $pwd!=null && $nombre!=null){
                if($idsGrupo==null){
                    try {
                        $this->usuario_model->c($nombre,$email,$pwd,true,[]);
                        $respuesta['estado']=true;
                        $respuesta['mensaje']="Usuario $nombre creado correctamente";
                    }
                    catch (Exception $e) {
                        $respuesta['mensaje']=$e->getMessage();
                    }
                } else {
                    try {
                        $this->usuario_model->c($nombre,$email,$pwd,false,$idsGrupo);
                        //TODO no se manda el mail
                        $usuario = $this->usuario_model->getUsuarioByEmail($email);
                        $this->load->helper("mimail_helper");
                        mandarMailActivacion($this,$usuario);
                       
                        $respuesta['estado']=true;
                        $respuesta['mensaje']="Usuario $nombre creado correctamente";
                    }
                    catch (Exception $e) {
                        $respuesta['mensaje']=$e->getMessage();
                    }
                }
            } else {
                $respuesta['mensaje']="Comprueba que has mandado el email, la contraseña y el nombre";
            }
            
            echo json_encode($respuesta);
        }
    }

}
?>









