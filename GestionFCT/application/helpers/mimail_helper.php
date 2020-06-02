<?php

function mandarMail($controlador,$message,$destinatario,$asunto){
    $configMiMail['protocol']    = 'smtp';
    $configMiMail['smtp_host']    = 'ssl://smtp.gmail.com';
    $configMiMail['smtp_port']    = '465';
    $configMiMail['smtp_timeout'] = '7';
    $configMiMail['smtp_user']    = 'reygestionfct@gmail.com';
    $configMiMail['smtp_pass']    = 'Est0yas3acaba!';
    $configMiMail['charset']    = 'utf-8';
    $configMiMail['newline']    = "\r\n";
    $configMiMail['mailtype'] = 'html'; // or text
    $configMiMail['validation'] = TRUE; // bool whether to validate email or not

    $controlador->load->library('email', $configMiMail);       

    $controlador->email->from('reygestionfct@gmail.com', 'GestionFCT');
    $controlador->email->to($destinatario);
    $controlador->email->subject("GestiónFCT -".$asunto);
    $controlador->email->message($message);
          
    $resultado = false;
    if($controlador->email->send()) {
        $resultado = true;
    }
    return $resultado;
}

function mandarMailActivacion($controlador,$usuario){
    $url = base_url()."usuario/vericarMail?key=".$usuario->verification_key;
    $message = "
                    <p>Hola ".$usuario->nombre."</p>
                    <p>Este es un mail de verificación. Para continuar con el registro por favor haz clic <a href='".$url."'>aquí</a>.</p>
                    <p>Una vez hagas clic, tu email será verificado y podrás entrar en GestionFCT.</p>
                    <p>Gracias!!!</p>
                ";
    return mandarMail($controlador,$message,$usuario->email,"Verifica tu mail");
}

function mandarMailRecupPwd($controlador,$usuario){
    $url = base_url()."usuario/recuperarPwd?key=".$usuario->verification_key;
    $message = "
                    <p>Hola ".$usuario->nombre."</p>
                    <p>Para cambiar la contraseña haz clic <a href='".$url."'>aquí</a>.</p>
                ";
    return mandarMail($controlador,$message,$usuario->email,"Cambiar contraseña");
}

?>