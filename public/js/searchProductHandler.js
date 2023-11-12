// INPUTS
const searchForm = document.getElementById("searchForm");
const tipoMueble = document.getElementById("tipoMueble");
const filtro = document.getElementById("filtro");
const ordenCriterio = document.getElementById("ordenCriterio");
const orden = document.getElementById("orden");
//select
tipoMueble.addEventListener("change", handleSelectChange);
filtro.addEventListener("change", handleSelectChange);
ordenCriterio.addEventListener("change", handleSelectChange);
orden.addEventListener("change", handleSelectChange);

searchForm.addEventListener("onSubmit", function (event) {
    event.preventDefault();
    handleSelectChange();
});

searchForm.addEventListener("keypress", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
        handleSelectChange();
    }
});

function handleSelectChange() {
    const extraFields = document.getElementById("extraFields");
    const containerExtraField = document.getElementById("containerExtraField");
    containerExtraField.innerHTML = "";
    containerExtraField.appendChild(extraFields);
    searchForm.submit();
}
