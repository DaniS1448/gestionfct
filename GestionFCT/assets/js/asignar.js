function crearElementosSortable(){
    const listas = document.getElementsByClassName('lista-alumnos');
    for(lista of listas){
        Sortable.create(lista, {
            //handle: '.handle-mover-alumno',
            animation: 150,
            chosenClass: "seleccionado",
            // ghostClass: "fantasma",
            dragClass: "drag",
        
            onEnd: () => {
                console.log('Se movió un elemento');
            },
            group: "lista-alumnos",
            store: {
                // Guardamos el orden de la lista
                set: (sortable) => {
                    const orden = sortable.toArray();
                    localStorage.setItem(sortable.options.group.name, orden.join('|'));
                },
        
                // Obtenemos el orden de la lista
                get: (sortable) => {
                    const orden = localStorage.getItem(sortable.options.group.name);
                    return orden ? orden.split('|') : [];
                }
            }
        });
    }
}

$(".empresas-desbloqueadas").on('click', 'li', function(){
    $(this).find('i').text('cancel').removeClass("text-success").addClass("text-danger");
    $(this).appendTo(".empresas-bloqueadas");
});

$(".empresas-bloqueadas").on('click', 'li', function(){
    $(this).find('i').text('check_circle').removeClass("text-danger").addClass("text-success");
    $(this).appendTo(".empresas-desbloqueadas");
});

function addEmpresa(){
    var elemento = $(".empresa-elemento").last().parent().clone(true,true)
    elemento.find(".lista-alumnos").empty();
    elemento.appendTo("#lista-empresas");
    crearElementosSortable()
}

function delEmpresa(icono){
    var empresa = icono.parentElement;
    empresa.parentElement.removeChild(empresa);
}