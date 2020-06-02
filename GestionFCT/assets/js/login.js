function validarLogin(){
	var mensajeErr = document.getElementById("err-login");
	var loginEmail = document.getElementById("login-email").value;
	var loginPwd = document.getElementById("login-pwd").value;

	var x = new XMLHttpRequest();

	x.open("POST",
			"/usuario/ajaxLoginPost",
			true);
	x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	x.setRequestHeader("X-Requested-With","XMLHttpRequest");
	x.send("loginEmail="+loginEmail+"&loginPwd="+loginPwd);
	
	x.onreadystatechange=function(){
		if(x.readyState == 4 && x.status==200){
			//console.log(x.responseText);
			var respuesta = JSON.parse(x.responseText);
			
			if(respuesta.estado == true){
				location.reload();
			} else {
				mensajeErr.innerHTML=respuesta.mensaje+"<br/>";
				desactivarBoton("login-btn-entrar", 5000);
			}
		}
	}
}

function recuperarPwd(){
	var mensajeErr = document.getElementById("err-recup-pwd");
	var loginEmail = document.getElementById("login-email").value;
	desactivarBoton("login-btn-recup-pwd", 5000);

	var x = new XMLHttpRequest();

	x.open("POST",
			"/usuario/ajaxRecuperarPwdPost",
			true);
	x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	x.setRequestHeader("X-Requested-With","XMLHttpRequest");
	x.send("email="+loginEmail);
	
	x.onreadystatechange=function(){
		if(x.readyState == 4 && x.status==200){
			//console.log(x.responseText);
			var respuesta = JSON.parse(x.responseText);
			
			if(respuesta.estado == true){
				mensajeErr.classList.remove("text-danger");
				mensajeErr.classList.add("text-success");
			} else {
				mensajeErr.classList.remove("text-success");
				mensajeErr.classList.add("text-danger");
				
			}
			mensajeErr.innerHTML=respuesta.mensaje+"<br/>";
		}
	}
}

function validarRecupPwd(){
	var pwd1 = document.getElementById("recup-pwd-1").value;
	var pwd2 = document.getElementById("recup-pwd-2").value;
	var labelErr = document.getElementById("recup-pwd-err");

	if(!pwd1.localeCompare(pwd2)){
		if(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/.test(pwd1)){
			document.getElementById("recup-pwd-form").submit();
		} else {
			labelErr.innerHTML="La contraseña debe tener entre 6 y 20 caracteres, al menos 1 número, 1 mayúscula y 1 minúscula";
		}
		
	} else {
		labelErr.innerHTML="Las contraseñas no coinciden";
	}
	
}