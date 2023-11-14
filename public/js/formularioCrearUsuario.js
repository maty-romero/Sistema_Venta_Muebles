function formularioPorTipo() {
    var tipo = document.getElementById('idCmbRolUsuario').value;

    switch(tipo){
        case 'cliente':
            document.getElementById('txtNombreCliente').style.display = "block";
            document.getElementById('idCmbTipoCliente').style.display = "block";
            document.getElementById('txtDniCuit').style.display = "block";
            document.getElementById('txtCodigoPostal').style.display = "block";
            document.getElementById('txtCodigoPostal').style.display = "block";
            break;
        default:
            ocultarTodo();
            break;
    }
}

function ocultarTodo(){
    document.getElementById('txtNombreCliente').style.display = "none";
    document.getElementById('idCmbTipoCliente').style.display = "none";
    document.getElementById('txtDniCuit').style.display = "none";
    document.getElementById('txtCodigoPostal').style.display = "none";
    document.getElementById('txtCodigoPostal').style.display = "none";
}



