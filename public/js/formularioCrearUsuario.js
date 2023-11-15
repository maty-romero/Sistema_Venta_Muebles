function formularioPorTipo() {
    var tipo = document.getElementById('idCmbRolUsuario').value;

    switch(tipo){
        case 'cliente':
            document.getElementById('idPNombreCliente').style.display = "block";
            document.getElementById('txtNombreCliente').style.display = "block";

            document.getElementById('idPTipoCliente').style.display = "block";
            document.getElementById('idCmbTipoCliente').style.display = "block";

            document.getElementById('idPDniCuit').style.display = "block";
            document.getElementById('txtDniCuit').style.display = "block";

            document.getElementById('idPCodigoPostal').style.display = "block";
            document.getElementById('txtCodigoPostal').style.display = "block";
            
            document.getElementById('idPTelefono').style.display = "block";
            document.getElementById('txtTelefono').style.display = "block";
          
            break;
        default:
            ocultarTodo();
            break;
    }
}

function ocultarTodo(){
   document.getElementById('idPNombreCliente').style.display = "none";
   document.getElementById('txtNombreCliente').style.display = "none";

   document.getElementById('idPTipoCliente').style.display = "none";
   document.getElementById('idCmbTipoCliente').style.display = "none";

   document.getElementById('idPDniCuit').style.display = "none";
   document.getElementById('txtDniCuit').style.display = "none";

   document.getElementById('idPCodigoPostal').style.display = "none";
   document.getElementById('txtCodigoPostal').style.display = "none";
   
   document.getElementById('idPTelefono').style.display = "none";
   document.getElementById('txtTelefono').style.display = "none";
}



