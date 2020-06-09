<?php

class Instituto extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('instituto_model');
    }

    public function c(){
        verificarRol("admin");
        $data['scripts']=['instituto'];
        frame($this, "instituto/c",$data);
    }
    
    public function ajaxCPost(){
        if(esAjax()){
            $nombre = isset($_POST["nombre"])?$_POST["nombre"]:null;
            $idMunicipio = isset($_POST["idMunicipio"])?$_POST["idMunicipio"]:null;
            $n_centro = isset($_POST["n_centro"])?$_POST["n_centro"]:null;
            $direccion = isset($_POST["direccion"])?$_POST["direccion"]:null;
            $cif = isset($_POST["cif"])?$_POST["cif"]:null;
            $telefono = isset($_POST["telefono"])?$_POST["telefono"]:null;
            $email = isset($_POST["email"])?$_POST["email"]:null;
            
            
            $respuesta['estado']=false;
            $respuesta['mensaje']="";
            
            if($nombre==null){
                $respuesta['mensaje']="El nombre del instituto no puede estar vacío";
            } else {
                if($idMunicipio!=null){
                    try {
                        $this->instituto_model->c($nombre,$idMunicipio,$n_centro,$direccion,$cif,$telefono,$email);
                        $respuesta['estado']=true;
                        $respuesta['mensaje']="Instituto $nombre creado correctamente";
                    }
                    catch (Exception $e) {
                        $respuesta['mensaje']=$e->getMessage();
                    }
                } else {
                    $respuesta['mensaje']="El campo municipio no puede estar vacío";
                }
            }
            
            echo json_encode($respuesta);
        }
    }
    
    public function ajaxGetInstitutos(){
        if(esAjax()){
            echo json_encode($this->instituto_model->getInstitutos());
        }
    }
    
    public function ajaxGetInstitutosLike(){
        if(esAjax()){
            $nombre = isset($_POST["nombre"])?$_POST["nombre"]:"";
            //echo json_encode($this->instituto_model->getInstitutosLike($nombre));
            $arrInstitutos=[];
            
            foreach ($this->instituto_model->getInstitutosLike($nombre) as $instituto){
                $atributos=[];
                foreach ($instituto as $k=>$v){
                    $atributos[$k]=$v;
                }
                $atributos["municipio"]=$instituto->municipio->nombre;
                $arrInstitutos[]=$atributos;
            }
            echo json_encode($arrInstitutos);
        }
    }

}
?>









