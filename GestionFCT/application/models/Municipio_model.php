<?php

class Municipio_model extends CI_Model
{

    public function getMunicipios(){
        return R::findAll('municipio');
    }
    
    public function getMunicipioById($id){
        return R::load('municipio', $id);
    }
    
    function c($nombre,$idProvincia){       
        $ca = R::findOne('municipio','nombre=?',[$nombre]);
        $ok = ($ca==null && $nombre!=null);
        if ($ok) {
            $provincia = R::load('provincia', $idProvincia);
            $bean = R::dispense('municipio');
            $bean->nombre = $nombre;
            $bean->provincia = $provincia;
            R::store($bean);
        }
        else {
            $e = ($nombre==null?new Exception("nulo"):new Exception("Municipio duplicado"));
            throw $e;
        }
    }
    
    function getMunicipiosLike($search){
        return R::find('municipio',' nombre LIKE :nombre ',[':nombre' => '%' . $search . '%']);
    }
}

?>
