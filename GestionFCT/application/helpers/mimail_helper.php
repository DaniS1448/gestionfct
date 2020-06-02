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
     $message = <<<HTML
    <div style="background: linear-gradient(120deg,#7f70f5,#0ea0ff); text-align: center; color: aliceblue; font-size: x-large; font-variant: small-caps;padding: 10px; vertical-align: middle;">
        <img src="https://gestionfct.ga/assets/img/logo.png" width="30px" height="auto" alt="DaniS Logo">
        GestiónFCT
        <br>
        <span style="font-size: small;">Solicitud de cambio de contraseña</span>
    </div>
    <div style="text-align: center;">
        <br>
        <p style="font-size: x-large;">Hola $usuario->nombre</p>
        <p>
            Has solicitado cambiar la contraseña.
            <br>
            ¡Si no has sido tú, ignora este mensaje!
        </p>
            <a style="
            text-decoration: none;
            box-sizing: border-box;
            margin: 0;
            font-family: inherit;
            overflow: visible;
            text-transform: none;
            -webkit-appearance: button;
            display: inline-block;
            font-weight: 400;
            text-align: center;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: .375rem 1rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 2em;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            color: #fff;
            background-color: #0ea0ff;
            border-color: #0ea0ff;
            margin-top: .5rem!important;
            cursor: pointer;
            " href='$url'>Cambiar contraseña</a>
            
    </div>
HTML;
    return mandarMail($controlador,$message,$usuario->email,"Cambiar contraseña");
}

?>