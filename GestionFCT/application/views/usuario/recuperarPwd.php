<main class="page lanidng-page">
    <section class="portfolio-block block-intro">
        <div class="container">
            <form method="post" action="/usuario/recuperarPwdPost" id="recup-pwd-form">
                <input class="form-control" type="hidden" name="key" value="<?= $key ?>"/>
                <div class="form-group d-xl-flex justify-content-xl-start align-items-xl-center">
                    <label for="recup-pwd-1" style="width: 100%;">Nueva contraseña</label>
                    <input id="recup-pwd-1" class="form-control" type="password" name="newPwd" style="width: 100%;"/>
                </div>
                <div class="form-group d-xl-flex justify-content-xl-start align-items-xl-center">
                    <label for="recup-pwd-2" style="width: 100%;">Repetir contraseña</label>
                    <input id="recup-pwd-2" class="form-control" type="password" style="width: 100%;" />
                </div>
                <label id="recup-pwd-err" class="text-danger" style="width: 100%;"></label>
                <button id="recup-pwd-btn-cambiar" class="btn btn-primary mt-2" type="button" onclick="validarRecupPwd();">Cambiar</button>
            </form>
        </div>
    </section>
    <hr />
</main>