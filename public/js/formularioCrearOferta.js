function formularioPorTipo() {
    var tipo = document.getElementById('tipoOferta').value;
    switch(tipo){
        case 'unitaria':
            document.getElementById('nombreCombo').style.display = "none";
            document.getElementById('imgCombo').style.display = "none";
            document.getElementById('tipoProducto').style.display = "none";
            document.getElementById('montoMinimo').style.display = "none";
            document.getElementById('seleccionProds').style.display = "block";
            document.getElementById('encTabla').style.display = "block";
            document.getElementById('tablaProds').style.display = "block";
            setTabla('unitaria');
            break;
        case 'tipo':
            document.getElementById('nombreCombo').style.display = "none";
            document.getElementById('imgCombo').style.display = "none";
            document.getElementById('tipoProducto').style.display = "block";
            document.getElementById('montoMinimo').style.display = "none";
            document.getElementById('seleccionProds').style.display = "none";
            document.getElementById('encTabla').style.display = "none";
            document.getElementById('tablaProds').style.display = "none";
            break;
        case 'combo':
            document.getElementById('nombreCombo').style.display = "block";
            document.getElementById('imgCombo').style.display = "block";
            document.getElementById('tipoProducto').style.display = "none";
            document.getElementById('montoMinimo').style.display = "none";
            document.getElementById('seleccionProds').style.display = "block";
            document.getElementById('encTabla').style.display = "block";
            document.getElementById('tablaProds').style.display = "block";
            setTabla('combo');
            break;
        case 'monto':
            document.getElementById('nombreCombo').style.display = "none";
            document.getElementById('imgCombo').style.display = "none";
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
    document.getElementById('imgCombo').style.display = "none";
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
        var ultimoItem = document.getElementById('itemVacio');
        document.getElementById('lista').removeChild(ultimoItem);

        var nuevo = document.createElement('li');
        nuevo.id = 'item'+id;
        nuevo.innerHTML = '<input type="text" readonly id="mostrarProd'+(id)+'" class="elementoLista w-[250px] rounded-md mb-1 mr-1 border-gray-600"><button type="button" id="btnEliminar'+(id)+'" onclick="eliminarProducto('+(id)+')" disabled class="btnLista bg-gray-600 hover:bg-gray-600 text-white h-8 w-8 rounded-md">X</button>'
        document.getElementById('lista').appendChild(nuevo);
        
        document.getElementById('mostrarProd'+id).value = id + '. ' + nombreProd + ' x' + cant;
        document.getElementById('mostrarProd'+id).name = 'productos[]';

        document.getElementById('btnEliminar'+id).disabled = false;
        document.getElementById('btnEliminar'+id).style.backgroundColor = '#1f2937';

        nuevo = document.createElement('li');
        nuevo.id = 'itemVacio';
        nuevo.innerHTML = '<input type="text" readonly class="elementoLista w-[250px] rounded-md mr-1 border-gray-600"><button type="button" disabled class="btnLista bg-gray-600 hover:bg-gray-600 text-white h-8 w-8 rounded-md">X</button>';
        document.getElementById('lista').appendChild(nuevo);

        document.getElementById('b'+id).disabled = true;
        document.getElementById('b'+id).innerHTML = 'Agregado';
        document.getElementById('b'+id).style.backgroundColor = "#6b7280";
    }
}

function limpiarLista(){
    document.getElementById('lista').innerHTML = '<li class="w-full py-3 h-10 px-4"></li>';
    document.getElementById('lista').innerHTML += '<li id="itemVacio"><input type="text" readonly class="elementoLista w-[250px] rounded-md mr-1 border-gray-600"><button type="button" disabled class="btnLista bg-gray-600 hover:bg-gray-600 text-white h-8 w-8 rounded-md">X</button></li>';
  
    var btns = document.getElementsByClassName('btnAgregar');
    for(var i = 0; i < btns.length; i++){
        btns[i].disabled = false;
        btns[i].innerHTML = 'Agregar';
        btns[i].style.backgroundColor = '#1f2937';
        document.getElementsByClassName('inpCant')[i].value = 1;
    };
}

function eliminarProducto(id){
    var itemLista = document.getElementById('item'+id);
    document.getElementById('lista').removeChild(itemLista);

    var btnAgregar = document.getElementById('b'+id);
    btnAgregar.disabled = false;
    btnAgregar.innerHTML = 'Agregar';
    btnAgregar.style.backgroundColor = '#1f2937';
}

function setTabla(tipo){
    var btnsInc = document.getElementsByClassName('btnInc');
    var btnsDrc = document.getElementsByClassName('btnDrc');
    if(tipo == 'unitaria'){
        for(var i = 0; i < btnsInc.length; i++){
            btnsInc[i].disabled = true;
            btnsDrc[i].disabled = true;
        }
    } else {
        for(var i = 0; i < btnsInc.length; i++){
            btnsInc[i].disabled = false;
            btnsDrc[i].disabled = false;
        }
    }
}