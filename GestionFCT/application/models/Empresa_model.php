<?php

class Empresa_model extends CI_Model
{

    public function getEmpresas(){
        return R::findAll('empresa');
    }
    
    function c($nombre,$idMunicipio,$cif,$direccion,$latitud,$longitud,$idTitulacion){
        $empresa = R::findOne('empresa','cif=?',[$cif]);
        $ok = ($empresa==null && $nombre!=null && $idMunicipio!=null && $cif!=null && $direccion!=null && $latitud!=null && $longitud!=null && $idTitulacion!=null);
        if ($ok) {
            $municipio = R::load('municipio', $idMunicipio);
            $titulacion = R::load('titulacion', $idTitulacion);
            if($municipio!=null && $titulacion!=null){
                $empresa = R::dispense('empresa');
                $empresa->nombre = $nombre;
                $empresa->cif = $cif;
                $empresa->email = null;
                $empresa->foto = null;
                $empresa->responsable_convenio = null;
                $empresa->rrhh_responsable = null;
                $empresa->rrhh_telefono = null;
                $empresa->rrhh_email = null;
                $empresa->bloqueada = false;
                R::store($empresa);
                
                $sede = R::dispense('sede');
                $sede->direccion = $direccion;
                $sede->latitud = $latitud;
                $sede->longitud = $longitud;
                $sede->telefono = null;
                $sede->fax = null;
                $sede->observaciones = null;
                $sede->empresa = $empresa;
                R::store($sede);
                
                $pertenece = R::dispense('pertenece');
                $pertenece->empresa = $empresa;
                $pertenece->titulacion = $titulacion;
                R::store($pertenece);
            }
            
        }
        else {
            $e = ($nombre==null?new Exception("nulo"):new Exception("Empresa duplicada.El cif ya existe"));
            throw $e;
        }
    }
    
    function existeCIF($cif){
        
        $existe = false;
        if(R::findOne('empresa','cif=?',[$cif]) != null){
            $existe = true;
        }
        return $existe;
    }
    
    function getEmpresasDesbloqueadas(){
        return R::find('empresa','bloqueada = ?', [false]);
    }
}

?>
