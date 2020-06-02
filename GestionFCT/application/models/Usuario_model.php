<?php

class Usuario_model extends CI_Model
{
    function existeAdmin(){
        
        $noExiste = false;
        if(R::findOne('usuario','nombre=?',["admin"]) == null){
            $noExiste = true;
        }
        return $noExiste;
    }

    function crearUsuario($nombre,$email,$pwd,$esAdmin){
        $usuario = R::dispense('usuario');
        $usuario->nombre = $nombre;
        $usuario->email = $email;
        $usuario->pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $usuario->esAdmin = $esAdmin;
        $usuario->email_verificado = false;
        $usuario->verification_key = md5(rand());
        return R::store($usuario);
    }

    function verificarLogin($loginEmail,$loginPwd){
        $usuario = R::findOne('usuario','email=?',[$loginEmail]);

        if($usuario != null && password_verify($loginPwd, $usuario->pwd)){
            if($usuario->email_verificado == true){
                $respuesta['estado']=true;
                $respuesta['mensaje']="OK";
            } else {
                $respuesta['estado']=false;
                $respuesta['mensaje']="¡Su mail no está verificado, compruebe su bandeja de entrada o spam! <a href='".base_url()."/usuario/reenviarActivacion?email=".$loginEmail."'>Reenviar mail</a>";
            }
            
        } else {
            $respuesta['estado']=false;
            $respuesta['mensaje']="¡Los datos no son correctos!";
        }
        return $respuesta;
    }

    function verificarEmail($key){
        $usuario = R::findOne('usuario','verification_key=?',[$key]);
        $resultado = false;
        if($usuario != null && $usuario->email_verificado == false){
            $usuario->email_verificado = true;
            R::store($usuario);
            $resultado = true;
        }
        return $resultado;
    }

    function getUsuarioById($id){
        return R::load('usuario', $id);
    }

    function getUsuarioByEmail($email){
        return R::findOne('usuario','email=?',[$email]);
    }

    function comprobarMailNoVerificado($email){
        $usuario = R::findOne('usuario','email=?',[$email]);
        $resultado = false;
        if($usuario != null && $usuario->email_verificado==false){
            $resultado = true;
        }
        return $resultado;
    }

    function cambiarVerifKey($email){
        $usuario = R::findOne('usuario','email=?',[$email]);
        $respuesta=false;
        if($usuario != null){
            $usuario->verification_key = md5(rand());
            if(R::store($usuario) > 0){
                $respuesta=true;
            }
        }
        return $respuesta;
    }

    function recuperarPwd($key,$newPwd){
        $usuario = R::findOne('usuario','verification_key=?',[$key]);
        if($usuario != null){
            $usuario->pwd = password_hash($newPwd, PASSWORD_DEFAULT);
            R::store($usuario);
        }
    }
}

?>
