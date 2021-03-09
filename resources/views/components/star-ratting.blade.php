
<div class="estrellas flex">
    @php
        echo "<p class='hidden' id='midRate'>" . $midRate . "</p>"
    @endphp
    
    <form action="{{ route('productRatting', $product->id) }}" method="POST" id="starForm">
        @method('POST')    
        @csrf
        <div class="rate">
            <input type="radio" id="star5" name="ratting" value="5" class="vote"  onclick="castVote(this);"/>
            <label for="star5" title="text">5 stars</label>
            <input type="radio" id="star4" name="ratting" value="4" class="vote"  onclick="castVote(this);"/>
            <label for="star4" title="text">4 stars</label>
            <input type="radio" id="star3" name="ratting" value="3" class="vote"  onclick="castVote(this);"/>
            <label for="star3" title="text">3 stars</label>
            <input type="radio" id="star2" name="ratting" value="2" class="vote"  onclick="castVote(this);"/>
            <label for="star2" title="text">2 stars</label>
            <input type="radio" id="star1" name="ratting" value="1" class="vote"  onclick="castVote(this);"/>
            <label for="star1" title="text">1 star</label>
        </div>
    </form>
   
</div>
<div class="flex flex-row">
    @if ($votesCount == 0)
            <p class="greenAmaso text-md"> Aún no hay valoraciones.</p>
    @elseif($votesCount == 1)
            <p class="greenAmaso text-sm ">( {{$votesCount}} valoración )</p>
    @else
            <p class="greenAmaso text-sm ">( {{$votesCount}} valoraciones )</p>
    @endif
</div>

<script>
    const midRate = document.getElementById('midRate').innerHTML;

    if (midRate != 0) {
        const inputId = "star" + midRate;
        console.log(midRate);
        document.getElementById(inputId).checked = true;
    }

    const starForm = document.getElementById('starForm');
    function castVote(input){
        console.log('We are here!');
        starForm.submit(input.value);
    }
</script>


{{-- document.getElementById("checkbox").checked = true; --}}


{{-- {{URL::to('/image/star-solid.svg')}} --}}

{{-- <div>
    <h2 class="block text-md greenAmaso mt-1 mb-2">Valoración de los usuarios:</h2>
    @if (isset($midRate))
    <div class="flex flex-row justify-start items-baseline mb-2">
        <div class="flex flex-row items-baseline">
        @for ($i = 1; $i <= $midRate; $i++)
        <img src="{{URL::to('/image/star-solid.svg')}}" alt="star-solid" width="25" class="mr-4">
        @endfor
        @for ($i = 1; $i <= $emptyStars; $i++)
            <img src="{{URL::to('/image/star-regular.svg')}}" alt="star-empty" width="25" class="mr-4">
        @endfor
    </div>
    </div>
    <p class="italics eko text-sm greenAmaso mb-4">( {{$votesCount}} valoraciones )</p>
    @else
    <p id="productRatting" class="mt-2 mb-8 ">Aún no hay valoraciones.</p>   
    @endif
    @auth
        @if(auth()->id() != $product->artisans->user_id)
            <div>  
                <form action="{{ route('productRatting', $product->id) }}" method="POST"> 
                    @method('POST')    
                    @csrf
                        <select name="ratting" id="ratting">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    <button type="submit" value="submit" class="greenLightBg  rounded-xl p-1 text-white">Valorar</button>
                </form>
            </div>
        @endif
    @endauth --}}

    <style>
        *{
        margin: 0;
        padding: 0;
    }
    .rate {
        float: left;
        height: 46px;  
    }
    .rate:not(:checked) > input {
        position:absolute;
        top:-9999px;
    }
    .rate:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
        margin-right: 8px;
    }
    .rate:not(:checked) > label:before {
        content: '★ ';
    }
    .rate > input:checked ~ label {
        color: #ffc700;    
    }
    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        color: #deb217;  
    }
    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label {
        color: #c59b08;
    }
    
    </style>