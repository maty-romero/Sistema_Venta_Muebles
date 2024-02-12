window.addEventListener("DOMContentLoaded", () => {
    const searchForm = document.getElementById("searchForm");
    const ordenamiento = document.getElementById("ordenamiento");
    const direccionOrden = document.getElementById("direccion_orden");
    const discontinuado = document.getElementById("discontinuado");

    ordenamiento.addEventListener("change", handleSelectChange);
    direccionOrden.addEventListener("change", handleSelectChange);
    discontinuado.addEventListener("change", handleSelectChange);

    searchForm.addEventListener("onSubmit", function (event) {
        event.preventDefault();
        searchForm.submit();
    });

    searchForm.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
            searchForm.submit();
        }
    });

    function handleSelectChange() {
        console.log("Cambio!");
        searchForm.submit();
    }
});
