window.addEventListener("DOMContentLoaded", () => {
    const ordenamiento = document.getElementById("ordenamiento");
    const direccionOrden = document.getElementById("direccion_orden");

    ordenamiento.addEventListener("change", handleSelectChange);
    direccionOrden.addEventListener("change", handleSelectChange);

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
        searchForm.submit();
    }
});
