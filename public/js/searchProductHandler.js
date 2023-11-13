window.addEventListener("DOMContentLoaded", () => {
    // INPUTS
    const searchForm = document.getElementById("searchForm");
    const tipoMueble = document.getElementById("tipoMuebleFilter");
    const filtro = document.getElementById("filtroFilter");
    const ordenCriterio = document.getElementById("ordenCriterioFilter");
    const orden = document.getElementById("ordenFilter");
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
        // const extraFields = document.getElementById("extraFields");
        const containerExtraField = document.getElementById(
            "containerExtraField"
        );
        containerExtraField.innerHTML = "";
        containerExtraField.innerHTML = `
        <input id="tipoMueble"  name="tipoMueble" value="${tipoMueble.value}" type="text" hidden>
        <input id="filtro" name="filtro" type="text" value="${filtro.value}" hidden>
        <input id="ordenCriterio" name="ordenCriterio" value="${ordenCriterio.value}" type="text" hidden>
        <input id="orden" name="orden" value="${orden.value}" type="text" hidden>`;

        searchForm.submit();
    }
});
