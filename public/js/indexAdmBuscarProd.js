function buscar() {
    var inputBusq = document.getElementById('name').value;
    inputBusq = inputBusq.toLowerCase();
    var filas = document.getElementsByClassName('filas');

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
