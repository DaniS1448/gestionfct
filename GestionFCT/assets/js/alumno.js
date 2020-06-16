function addAlumno(){
    var elemento = $(".grupo-alumno").first().clone()
    //elemento.find("input[type=text]").val("");
    //$(".grupo-alumno").length
    elemento.eq(0).find(".numAlumno").text("ALUMNO "+($(".grupo-alumno").length+1))
    elemento.find("span:last").hide();
    elemento.find("input").val("");
    elemento.appendTo("#grupo-alumnos");
}

function delAlumno(icono){
	if($(".grupo-alumno").length!=1){
		var alumno = icono.parentElement.parentElement;
	    alumno.parentElement.removeChild(alumno);
	}
}