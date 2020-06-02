<div id="modalLogin" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header gradient">
                <h4 class="modal-title">Iniciar sesión</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <span class="d-flex justify-content-start">Email</span>
                <input type="text" id="login-email" class="rounded" style="width: 100%;" />
				<span class="d-flex justify-content-start">Contraseña</span>
				<input type="password" id="login-pwd" class="rounded" style="width: 100%;" />
				<span class="d-flex justify-content-start text-danger" id="err-login"></span>
				<br>
				<span class="d-flex justify-content-start">¿Has olvidado tu contraseña? <button id="login-btn-recup-pwd" class="btn p-0 text-info" onclick="recuperarPwd()">Recuperar contraseña</button></span>
				<span class="d-flex justify-content-start text-danger" id="err-recup-pwd"></span>
            </div>
            <div class="modal-footer justify-content-between">
                <span class="justify-content-xl-center d-none">¿No tienes cuenta? <span class="text-info">Regístrate</span></span>
				<br/>
                <div>
                    <button class="btn btn-light" type="button" data-dismiss="modal">Cerrar</button>
                    <button id="login-btn-entrar" class="btn btn-primary" type="button" onclick="validarLogin()">Login</button>
                </div>
            </div>
        </div>
    </div>
</div>