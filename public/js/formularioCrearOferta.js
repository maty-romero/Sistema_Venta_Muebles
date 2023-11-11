function formularioPorTipo() {
    var tipo = document.getElementById('tipoOferta').value;
    switch(tipo){
        case 'unitaria':
            document.getElementById('nombreCombo').style.display = "none";
            document.getElementById('tipoProducto').style.display = "none";
            document.getElementById('montoMinimo').style.display = "none";
            document.getElementById('seleccionProds').style.display = "block";
            document.getElementById('encTabla').style.display = "block";
            document.getElementById('tablaProds').style.display = "block";
            break;
        case 'tipo':
            document.getElementById('nombreCombo').style.display = "none";
            document.getElementById('tipoProducto').style.display = "block";
            document.getElementById('montoMinimo').style.display = "none";
            document.getElementById('seleccionProds').style.display = "none";
            document.getElementById('encTabla').style.display = "none";
            document.getElementById('tablaProds').style.display = "none";
            break;
        case 'combo':
            document.getElementById('nombreCombo').style.display = "block";
            document.getElementById('tipoProducto').style.display = "none";
            document.getElementById('montoMinimo').style.display = "none";
            document.getElementById('seleccionProds').style.display = "block";
            document.getElementById('encTabla').style.display = "block";
            document.getElementById('tablaProds').style.display = "block";
            break;
        case 'monto':
            document.getElementById('nombreCombo').style.display = "none";
            document.getElementById('tipoProducto').style.display = "none";
            document.getElementById('montoMinimo').style.display = "block";
            document.getElementById('seleccionProds').style.display = "none";
            document.getElementById('encTabla').style.display = "none";
            document.getElementById('tablaProds').style.display = "none";
            break;
        default:
            ocultarTodo();
            break;
    }
    limpiarLista();
}

function ocultarTodo(){
    document.getElementById('nombreCombo').style.display = "none";
    document.getElementById('tipoProducto').style.display = "none";
    document.getElementById('montoMinimo').style.display = "none";
    document.getElementById('seleccionProds').style.display = "none";
    document.getElementById('encTabla').style.display = "none";
    document.getElementById('tablaProds').style.display = "none";
}

function incrementar(inpID){
    document.getElementById(inpID).value++;
}

function decrementar(inpID){
    if(document.getElementById(inpID).value > 0){
        document.getElementById(inpID).value--;
    }
}

var ultimo = 0;
function agregarProd(id, nombreProd){
    var lista = document.getElementsByClassName('elementoLista');
    var cant = document.getElementById(id).value;
    
    if(cant > 0){
        lista[ultimo].innerHTML = id + '. ' + nombreProd + ' x' + cant;

        var ultimoItem = lista[lista.length - 1];
        document.getElementById('lista').removeChild(ultimoItem);
        document.getElementById('lista').innerHTML += '<li class="elementoLista w-full py-3 px-4 h-10 border-b-[1.5px] border-gray-200 dark:border-gray-600"></li>';
        document.getElementById('lista').innerHTML += '<li class="elementoLista w-full py-3 px-4 h-10"></li>';
        ultimo++;

        document.getElementById('b'+id).disabled = true;
        document.getElementById('b'+id).innerHTML = 'Agregado';
        document.getElementById('b'+id).style.backgroundColor = "#6b7280";
    }
}

function limpiarLista(){
    document.getElementById('lista').innerHTML = '<li class="elementoLista w-full py-3 h-10 px-4 border-b-[1.5px] border-gray-200 rounded-t-lg dark:border-gray-600"></li><li class="elementoLista w-full py-3 px-4 h-10 border-b-[1.5px] border-gray-200 dark:border-gray-600"></li><li class="elementoLista w-full py-3 px-4 h-10"></li>'
    ultimo = 0;
  
    var btns = document.getElementsByClassName('btnAgregar');
    for(var i = 0; i < btns.length; i++){
        btns[i].disabled = false;
        btns[i].innerHTML = 'Agregar';
        btns[i].style.backgroundColor = '#374151';
        document.getElementsByClassName('inpCant')[i].value = 0;
    };
}

 