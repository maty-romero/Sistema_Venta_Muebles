window.addEventListener("DOMContentLoaded", () => {
    const selector = document.getElementById("tipoReporte");
    const inputContainer = document.getElementById("input-container");
    const error = document.getElementById("error-reporte");
    selector.addEventListener("change", () => {
        if (selector.value === "VC") {
            inputContainer.innerHTML = "";
            inputContainer.innerHTML = `
        <div class="flex flex-col">
        <label for="fechaInicio">Fecha de inicio</label>
        <input class="rounded-lg border-gray-200" type="date" name="fechaInicio" id="fechaInicio" required>
    </div>
    <div class="flex flex-col">
        <label for="fechaFin">Fecha de fin</label> 
        <input class="rounded-lg border-gray-200" type="date" name="fechaFin" id="fechaFin" required>
    </div>
    <div class="flex flex-col">
        <label for="idCliente">Identificador de cliente</label>
        <input class="rounded-lg border-gray-200" type="text" name="idCliente" id="idCliente" required>   
    </div> `;
        } else if (selector.value === "PMV" || selector.value === "OMV") {
            inputContainer.innerHTML = "";
            inputContainer.innerHTML = `
        <div class="flex flex-col">
        <label for="fechaInicio">Fecha de inicio</label>
        <input class="rounded-lg border-gray-200" type="date" name="fechaInicio" id="fechaInicio" required>
    </div>
    <div class="flex flex-col">
        <label for="fechaFin">Fecha de fin</label> 
        <input class="rounded-lg border-gray-200" type="date" name="fechaFin" id="fechaFin" required>
    </div>`;
        }
    });

    fechaInicio.addEventListener("change", function () {
        const fechaInicio = document.getElementById("fechaInicio");
        const fechaFin = document.getElementById("fechaFin");
        if (fechaInicio.value != "" && fechaFin.value != "") {
            if (fechaInicio.value >= fechaFin.value) {
                error.innerHTML = "";
                error.innerHTML = "El rango de fechas debe ser valido.";
            } else {
                error.innerHTML = "";
            }
        }
    });

    fechaFin.addEventListener("change", function () {
        const fechaInicio = document.getElementById("fechaInicio");
        const fechaFin = document.getElementById("fechaFin");
        if (fechaInicio.value != "" && fechaFin.value != "") {
            if (fechaInicio.value >= fechaFin.value) {
                error.innerHTML = "";
                error.innerHTML = "El rango de fechas debe ser valido.";
            } else {
                error.innerHTML = "";
            }
        }
    });

    formReporte.addEventListener("submit", function (event) {
        event.preventDefault();
        const fechaInicio = document.getElementById("fechaInicio");
        const fechaFin = document.getElementById("fechaFin");
        if (fechaInicio.value >= fechaFin.value) {
            error.innerHTML = "El rango de fechas debe ser valido.";
        } else {
            error.innerHTML = "";
            formReporte.submit();
        }

        // axios
        //     .post("/reporteRedirect", {
        //         fechaInicio: fechaInicio.value,
        //         fechaFin: fechaFin.value,
        //         idCliente: idCliente.value,
        //         tipoReporte: selector.value,
        //     })
        //     .then(function (response) {
        //         if (response.data["error"]) {
        //             const error = document.getElementById("error-reporte");
        //             error.innerHTML = response.data["error"];
        //             console.log("error");
        //         } else {
        //             formReporte.submit();
        //         }
        //     })
        //     .catch(function (error) {
        //         console.log(error);
        //     });
    });
});
