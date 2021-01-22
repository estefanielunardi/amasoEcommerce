<x-app-layout>
    <section class="flex flex-col m-10">
        <h1 class="title pb-8">Únete a nosotros</h1>
        <h2 class="pb-8 text-white text-xl font-serif"><span class="beigeAmasoBg my-4  p-1">&nbsp;¿Quieres formar parte del equipo&nbsp;&nbsp; &nbsp;&nbsp;de productores amasó? &nbsp; </span></h2>
        <p class="greenAmaso">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Non consequatur sequi vel maxime magni enim, facere, nisi illum eum aperiam labore amet aliquam.</p>
    </section>
    <section class="flex flex-col m-10">
        <div class="max-w-4xl">
            <form action="" >
            
                <div class="flex flex-col my-4 text-xl greenAmaso">
                    <label for="nombre" class="font-serif">Nombre y apellidos.</label>
                    <input type="text" id="name" name="name" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10">
                </div>
                <div class="flex flex-col my-4 text-xl greenAmaso">
                    <label for="image" class="font-serif">Imagen de perfil.</label>
                    <input type="text" id="image" name="image" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10">
                </div>
                <div class="flex flex-col my-4 text-xl greenAmaso">
                    <label for="localidad" class="font-serif">Localidad.</label>
                    <input type="text" id="location" name="location" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10">
                </div>
                <div class="flex flex-col my-4 text-xl greenAmaso">
                    <label for="correo" class="font-serif">Email.</label>
                    <input type="text" id="email" name="email" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10">
                </div>
                <div class="flex flex-col my-4 text-xl greenAmaso">
                    <label for="contrseña" class="font-serif">Contraseña.</label>
                    <input type="text" id="password" name="password" class="w-100 border-solid border-2 borderGreen rounded shadow-md h-10">
                </div>
                <div class="flex flex-col my-4 text-xl greenAmaso">
                    <label for="description" class="font-serif">Cuéntanos algo sobre ti.</label>
                    <textarea rows="5" cols="80" id="description" name="description" class="w-100 border-solid border-2 borderGreen rounded shadow-md">
                    </textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class=" beigeAmasoBg font-serif text-white text-2xl mt-4 px-12 py-4  rounded-xl shadow-md">enviar</button>
                </div>
            </form>
        </div>
    </section>






</x-app-layout>