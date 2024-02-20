function buscar() {
    var inputBusq = document.getElementById('busqueda').value;
    inputBusq = inputBusq.toLowerCase();
    var filas = document.getElementsByClassName('filas');

    console.log(inputBusq);

    if(inputBusq != ''){
        var nombre = '';
        for (var i = 0; i < filas.length; i++) {
            nombre = filas[i].id.toLowerCase();
            if(nombre.includes(inputBusq)){
                filas[i].style.display = "";
            } else {
                filas[i].style.display = "none";
            }
        }
    } else {
        for (var i = 0; i < filas.length; i++) {
            filas[i].style.display = "";
        }
    }
}

function agregarProd(id, nombreProd){
    var stock = parseInt(document.getElementById('st'+id).value); 
    var precio = parseFloat(document.getElementById('pr'+id).value).toFixed(2); 

    if(stock > 0){
        var ultimoItem = document.getElementById('itemVacio');
        document.getElementById('lista').removeChild(ultimoItem);

        var nuevo = document.createElement('li');
        nuevo.id = 'item'+id;
        nuevo.innerHTML = '<input type="text" readonly id="mostrarProd'+(id)+'" class="elementoLista w-[250px] rounded-md mb-1 mr-1 border-gray-600"><button type="button" id="btnEliminar'+(id)+'" onclick="eliminarProducto('+(id)+')" disabled class="btnLista bg-gray-600 hover:bg-gray-600 text-white h-8 w-8 rounded-md">X</button>'
        document.getElementById('lista').appendChild(nuevo);
        
        if(precio > 0){
            document.getElementById('mostrarProd'+id).value = id + '. ' + nombreProd + ' - ' + stock + ' unids. - $' + precio;
        } else {
            document.getElementById('mostrarProd'+id).value = id + '. ' + nombreProd + ' - ' + stock + ' unids.';
        }
        document.getElementById('mostrarProd'+id).name = 'productos[]';

        document.getElementById('btnEliminar'+id).disabled = false;
        document.getElementById('btnEliminar'+id).style.backgroundColor = '#1f2937';

        nuevo = document.createElement('li');
        nuevo.id = 'itemVacio';
        nuevo.innerHTML = '<input type="text" readonly class="elementoLista w-[250px] rounded-md mr-1 border-gray-600"><button type="button" disabled class="btnLista bg-gray-600 hover:bg-gray-600 text-white h-8 w-8 rounded-md">X</button>';
        document.getElementById('lista').appendChild(nuevo);

        document.getElementById('b'+id).disabled = true;
        document.getElementById('b'+id).innerHTML = '✓';
        document.getElementById('b'+id).style.backgroundColor = "#6b7280";
    }
}

function eliminarProducto(id){
    var itemLista = document.getElementById('item'+id);
    document.getElementById('lista').removeChild(itemLista);

    var btnAgregar = document.getElementById('b'+id);
    btnAgregar.disabled = false;
    btnAgregar.innerHTML = '+';
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