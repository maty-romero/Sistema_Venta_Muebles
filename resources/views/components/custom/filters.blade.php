@props(["tipoMueble","filtro","ordenCriterio","orden"])



<h1 class="text-6xl pb-6 font-medium ">Productos</h1>
<div id="extraFields" class="flex justify-between align-middle gap-6   divide-x filter-container flex-row py-6 px-20 bg-white rounded-xl  ">
    Filtrando por:

    <div class="flex flex-row align-middle justify-center">
        <p class="pl-8"> Tipo producto:</p>
        <select name="tipoMuebleFilter" id="tipoMuebleFilter" class="filter-no-style text-[#848484]">
            <option value="1" {{isset($tipoMueble) && $tipoMueble==="1" ?"selected":""}}>Exterior</option>
            <option value="2" {{isset($tipoMueble) && $tipoMueble==="2" ?"selected":""}}>Interior</option>
        </select>
    </div>

    <div class="flex flex-row align-middle justify-center">
        <p class="pl-8">Mostrando:</p>
        <select name="filtroFilter" id="filtroFilter" class="filter-no-style text-[#848484]">
            <option value="todo" {{ isset($filtro) && $filtro==="todo" ?"selected":""}}>Todo</option>
            <option value="productos" {{ isset($filtro) && $filtro==="productos" ?"selected":""}}>Productos</option>
            <option value="combos" {{ isset($filtro) && $filtro==="combos" ?"selected":""}}>Combos</option>
        </select>
    </div>
    <div class="flex flex-row align-middle justify-center">
        <p class="pl-8"> Ordenando por:</p>
        <select name="ordenCriterioFilter" id="ordenCriterioFilter" class="filter-no-style text-[#848484]">

            <option value="nombre_producto" {{ isset($ordenCriterio) && $ordenCriterio==="nombre_producto"
                ?"selected":""}}>
                Nombre
            </option>
            <option value="precio_producto" {{ isset($ordenCriterio) && $ordenCriterio==="precio_producto"
                ?"selected":""}}>
                Precio
            </option>
        </select>
    </div>
    <div class="flex flex-row align-middle justify-center pl-8">
        <select name="ordenFilter" id="ordenFilter" class="filter-no-style">
            <option value="asc" {{ isset($orden) && $orden==="asd" ?"selected":""}}>Asc</option>
            <option value="desc" {{ isset($orden) && $orden==="desc" ?"selected":""}}>Desc</option>
        </select>
    </div>
</div>