<!-- component -->
<section class="text-gray-700 body-font overflow-hidden bg-white shadow-[0_2px_4px_-0px_rgba(0,0,0,0.25)]">
      <div class="container mx-auto flex flex-wrap">
        <div class="container mx-auto flex flex-wrap w-1/2">
          <img alt="ecommerce" class="lg:w-3/4 mx-auto object-cover border-0 object-center rounded border border-gray-200" src="https://www.whitmorerarebooks.com/pictures/medium/2465.jpg">
        </div>
        <div class="lg:w-1/2 w-full lg:px-10 lg:py-16 py-6 px-5 lg:mt-0 bg-[#5690FF]">
          <h1 class="text-gray-900 text-3xl title-font font-medium mb-4 text-white">{{$producto->nombre_producto}}</h1>
          <p class="title-font font-medium text-2xl text-gray-900 mb-4 text-white">${{$producto->precio_producto}}</p>
          <p class="leading-relaxed flex mt-6 items-center pb-5 border-b-2 border-gray-200 mb-4 text-white">{{$producto->descripcion}}</p>
          <div class="flex-col">
            <p class="title-font font-medium text-2xl text-gray-900 mb-2 text-white">Cantidad</p>
            <input type='text' class='flex mr-auto mb-3 h-8 w-56'>
            <button class="flex mr-auto justify-center text-black bg-slate-50 border-0 w-56 py-2 px-6 focus:outline-none hover:bg-red-600">Agregar al carrito</button>
          </div>
        </div>
      </div>
  </section>