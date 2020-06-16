<?php

class Alumno_model extends CI_Model
{
    function c($idGrupo,$nombre,$apellido,$dni,$direccion,$latitud,$longitud){
        
        $usuario = R::findOne('alumno','dni=?',[$dni]);
        $ok = ($usuario==null && $dni!=null);
        if ($ok) {
            $alumno = R::dispense("alumno");
            $alumno->nombre = $nombre;
            $alumno->apellido = $apellido;
            $alumno->dni = $dni;
            $alumno->direccion = $direccion;
            $alumno->latitud = $latitud;
            $alumno->longitud = $longitud;
            $alumno->telefono = null;
            $alumno->email = null;
            $alumno->fecha_nacimiento = null;
            $alumno->n_matricula = null;
            $alumno->foto = null;
            $alumno->cv = null;
            R::store($alumno);
            
            $grupo = R::load('grupo', $idGrupo);
            $cursa = R::dispense('cursa');
            $cursa->alumno = $alumno;
            $cursa->grupo = $grupo;
            R::store($cursa);
            

        } else {
            $e = ($nombre==null?new Exception("DNI nulo"):new Exception("Alumno duplicado"));
            throw $e;
        }
    }
    
    function existeDNI($dni){
        
        $existe = false;
        if(R::findOne('alumno','dni=?',[$dni]) != null){
            $existe = true;
        }
        return $existe;
    }
}
?>
