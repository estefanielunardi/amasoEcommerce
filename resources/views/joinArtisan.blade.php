<x-app-layout>
    <section class="flex flex-col m-10">
        <h1 class="title pb-8">Únete a nosotros</h1>
        <h2 class="pb-8 text-white text-xl font-serif"><span class="beigeAmasoBg my-4  p-1">&nbsp;¿Quieres formar parte del equipo&nbsp;&nbsp; &nbsp;&nbsp;de productores amasó? &nbsp; </span></h2>
        <p class="greenAmaso">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Non consequatur sequi vel maxime magni enim, facere, nisi illum eum aperiam labore amet aliquam.</p>
    </section>
    <section class="flex flex-col m-10">
        <div class="max-w-4xl">
            <form action="">
                <div class="flex flex-col my-4 text-xl greenAmaso">
                    <label for="nombre" class="font-serif">Nombre y apellidos.</label>
                    <input type="text" id="nombre" class="w-100 border-solid border-2 border-green-500 rounded shadow-md h-10">
                </div>
                <div class="flex flex-col my-4 text-xl greenAmaso">
                    <label for="localidad" class="font-serif">Localidad.</label>
                    <input type="text" id="localidad" class="w-100 border-solid border-2 border-green-500 rounded shadow-md h-10">
                </div>
                <div class="flex flex-col my-4 text-xl greenAmaso">
                    <label for="correo" class="font-serif">Email.</label>
                    <input type="text" id="correo" class="w-100 border-solid border-2 border-green-500 rounded shadow-md h-10">
                </div>
                <div class="flex flex-col my-4 text-xl greenAmaso">
                    <label for="contrseña" class="font-serif">Contraseña.</label>
                    <input type="text" id="contraseña" class="w-100 border-solid border-2 border-green-500 rounded shadow-md h-10">
                </div>
                <div class="flex flex-col my-4 text-xl greenAmaso">
                    <label for="sobreTi" class="font-serif">Cunetanos algo sobre ti.</label>
                    <textarea rows="5" cols="80" id="sobreTi" class="w-100 border-solid border-2 border-green-500 rounded shadow-md">
                    </textarea>
                </div>
                <div class="flex flex-col my-4 text-xl greenAmaso">
                    <button class="w-100  border-green-500 rounded shadow-md h-10 flex flex-row justify-center align-middle" ><svg class="h-6 w-auto" id="Capa_1"  viewBox="0 0 18 18"><defs><style>.cls-1{fill:none;stroke:#81a78c;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style></defs><path class="cls-1" d="M281.64,198.36v1a3,3,0,0,0,.88,2.12,3,3,0,0,0,2.12.88h10a3,3,0,0,0,3-3v-1m-4-8-4-4m0,0-4,4m4-4v12" transform="translate(-280.64 -185.36)"/></svg>Añade tu certificado.</button>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class=" beigeAmasoBg font-serif text-white text-2xl mt-4 px-12 py-4  rounded-xl shadow-md">enviar</button>
                </div>
            </form>
        </div>
    </section>






</x-app-layout>