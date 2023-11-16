window.addEventListener("DOMContentLoaded", () => {
    const selector = document.getElementById("tipoReporte");
    const inputContainer = document.getElementById("input-container");

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

    // formReporte.addEventListener("submit", function (event) {
    //     const fechaInicio = document.getElementById("fechaInicio");
    //     const fechaFin = document.getElementById("fechaFin");
    //     const idCliente = document.getElementById("idCliente");
    //     event.preventDefault();

    //     axios
    //         .post("/reporteRedirect", {
    //             fechaInicio: fechaInicio.value,
    //             fechaFin: fechaFin.value,
    //             idCliente: idCliente.value,
    //             tipoReporte: selector.value,
    //         })
    //         .then(function (response) {
    //             if (response.data["error"]) {
    //                 const error = document.getElementById("error-reporte");
    //                 error.innerHTML = response.data["error"];
    //                 console.log("error");
    //             } else {
    //                 formReporte.submit();
    //             }
    //         })
    //         .catch(function (error) {
    //             console.log(error);
    //         });
    // });
});
