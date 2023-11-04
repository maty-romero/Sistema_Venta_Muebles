const selector = document.getElementById("tipoReporte");
const inputContainer = document.getElementById("input-container")


selector.addEventListener("change",()=>{
    if(selector.value === "VC"){
        inputContainer.innerHTML = "";
        inputContainer.innerHTML = `
        <div class="flex flex-col">
        <label for="fechaInicio">Fecha de inicio</label>
        <input class="rounded-lg border-gray-200" type="date" name="fechaInicio" id="fechaInicio">
    </div>
    <div class="flex flex-col">
        <label for="fechaFin">Fecha de fin</label> 
        <input class="rounded-lg border-gray-200" type="date" name="fechaFin" id="fechaFin">
    </div>
    <div class="flex flex-col">
        <label for="idCliente">Identificador de cliente</label>
        <input class="rounded-lg border-gray-200" type="text" name="idCliente" id="idCliente">   
    </div> `
    } else if (selector.value === "PMV" || selector.value === "OMV"){
        inputContainer.innerHTML = "";
        inputContainer.innerHTML = `
        <div class="flex flex-col">
        <label for="fechaInicio">Fecha de inicio</label>
        <input class="rounded-lg border-gray-200" type="date" name="fechaInicio" id="fechaInicio">
    </div>
    <div class="flex flex-col">
        <label for="fechaFin">Fecha de fin</label> 
        <input class="rounded-lg border-gray-200" type="date" name="fechaFin" id="fechaFin">
    </div>`
    } 
})
