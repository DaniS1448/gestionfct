<?php

class Sede_model extends CI_Model
{

    public function getSedes(){
        return R::findAll('sede');
    }
    
    public function getSedesByEmpresa($idEmpresa){
        return R::find('sede','empresa_id = ?', [$idEmpresa]);
    }
    
    public function c($direccion,$latitud,$longitud,$idEmpresa){
        $sede = R::findOne('sede','direccion=?',[$direccion]);
        $ok = ($sede==null && $direccion!=null && $latitud!=null && $longitud!=null && $idEmpresa!=null);
        if ($ok) {
            $empresa = R::load('empresa', $idEmpresa);
            if($empresa!=null){
                $sede = R::dispense('sede');
                $sede->direccion = $direccion;
                $sede->latitud = $latitud;
                $sede->longitud = $longitud;
                $sede->telefono = null;
                $sede->fax = null;
                $sede->observaciones = null;
                $sede->empresa = $empresa;
                R::store($sede);
            }
            
        }
        else {
            $e = ($direccion==null?new Exception("nulo"):new Exception("Sede duplicada."));
            throw $e;
        }
    }
}

?>
