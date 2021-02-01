<div>
        <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
             <button data-action="decrement" class="counter greenLightBg beigeLight h-full w-20 rounded-l-2xl cursor-pointer outline-none">
                    <span class="m-auto text-2xl font-thin">−</span>
            </button>
            <input type="number"  method="post" class="counter border-transparent outline-none focus:outline-none text-center w-12 greenAmasoBg font-semibold text-md   md:text-basecursor-default flex items-center text-white  outline-none" name="custom-input-number" value="0"></input>
                <button data-action="increment" action="{{route('cartAddProduct')}}" class="counter  greenLightBg  beigeLight  h-full w-20 rounded-r-2xl cursor-pointer outline-none">
                    <span class="m-auto text-2xl font-thin">+</span>
                </button>
        </div>



        @push('scripts')
            <script>
                function decrement(e) {
                    const btn = e.target.parentNode.parentElement.querySelector(
                        'button[data-action="decrement"]'
                    );
                    const target = btn.nextElementSibling;
                    let value = Number(target.value);
                    value--;
                    target.value = value;
                }

                function increment(e) {
                    const btn = e.target.parentNode.parentElement.querySelector(
                        'button[data-action="decrement"]'
                    );
                    const target = btn.nextElementSibling;
                    let value = Number(target.value);
                    value++;
                    target.value = value;
                }

                const decrementButtons = document.querySelectorAll(
                    `button[data-action="decrement"]`
                );

                const incrementButtons = document.querySelectorAll(
                    `button[data-action="increment"]`
                );

                decrementButtons.forEach(btn => {
                    btn.addEventListener("click", decrement);
                });

                incrementButtons.forEach(btn => {
                    btn.addEventListener("click", increment);
                });
            </script>

            @endpush

</div>