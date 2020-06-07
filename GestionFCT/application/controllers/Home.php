<?php

class Home extends CI_Controller
{
    
    public function index()
    {
        $data['modals']=['modalLogin'];
        $data['scripts']=['login'];
        frame($this, 'home/index',$data);
    }
    
    public function test(){
        
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;
        
        try {
            if($nombre==null){
                throw new Exception("No hay nombre");
            } 
            redirect(base_url() . '/');
        }
        catch (Exception $e) {
            session_start_seguro();
            $_SESSION['_msg']['texto']=$e->getMessage();
            $_SESSION['_msg']['uri']='';
            redirect(base_url() . 'msg');
        }
    }
    
    
    
}
?>









