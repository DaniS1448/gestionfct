<?php

class Instituto_model extends CI_Model
{

    public function getInstitutos(){
        return R::findAll('instituto');
    }
    
    public function getInstitutosLike($search){
        return R::find('instituto',' nombre LIKE :nombre ',[':nombre' => '%' . $search . '%']);
    }
    
    function c($nombre,$idMunicipio){       
        $ca = R::findOne('instituto','nombre=?',[$nombre]);
        $ok = ($ca==null && $nombre!=null);
        if ($ok) {
            $municipio = R::load('municipio', $idMunicipio);
            if($municipio!=null){
                $instituto = R::dispense('instituto');
                $instituto->nombre = $nombre;
                $instituto->municipio = $municipio;
                R::store($instituto);
            }
            
        }
        else {
            $e = ($nombre==null?new Exception("nulo"):new Exception("Instituto duplicado"));
            throw $e;
        }
    }
}

?>
