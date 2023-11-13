@props(["name"])

<form id="searchForm" name="searchForm" method="GET" action="/search">
    <input id="name" name="name" value='{{isset($name)?$name:""}}' class="py-1 pl-2 rounded-lg border-gray-200" placeholder="Buscar producto">

    <div id="containerExtraField" class="invisible hidden">

    </div>
</form>
<!--  -->