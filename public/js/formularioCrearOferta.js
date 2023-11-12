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

function agregarProd(id, nombreProd){
    var cant = document.getElementById(id).value;    
    if(cant > 0){
        var inputs = document.getElementsByClassName('elementoLista');
        inputs[inputs.length-1].value = id + '. ' + nombreProd + ' x' + cant;
        inputs[inputs.length-1].name = 'productos[]';

        document.getElementsByClassName('btnLista')[inputs.length-1].disabled = false;
        document.getElementsByClassName('btnLista')[inputs.length-1].style.backgroundColor = '#1f2937';

        var nuevo = document.createElement('li');
        nuevo.innerHTML = '<input type="text" readonly class="elementoLista w-[250px] rounded-md mt-1 mr-1 border-gray-600"><button type="button" disabled class="btnLista bg-gray-600 hover:bg-gray-600 text-white h-8 w-8 rounded-md">X</button>'
        document.getElementById('lista').appendChild(nuevo);
        
        document.getElementById('b'+id).disabled = true;
        document.getElementById('b'+id).innerHTML = 'Agregado';
        document.getElementById('b'+id).style.backgroundColor = "#6b7280";
    }
}

function limpiarLista(){
    document.getElementById('lista').innerHTML = '<li class="w-full py-3 h-10 px-4"></li>';
    document.getElementById('lista').innerHTML += '<li><input name="productos" type="text" readonly class="elementoLista w-[250px] rounded-md mr-1 border-gray-600"><button type="button" class="btnLista bg-gray-600 disabled hover:bg-gray-600 text-white h-8 w-8 rounded-md">X</button></li>';
    ultimo = 0;
  
    var btns = document.getElementsByClassName('btnAgregar');
    for(var i = 0; i < btns.length; i++){
        btns[i].disabled = false;
        btns[i].innerHTML = 'Agregar';
        btns[i].style.backgroundColor = '#1f2937';
        document.getElementsByClassName('inpCant')[i].value = 0;
    };
}

 