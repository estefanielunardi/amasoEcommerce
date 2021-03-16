
<div class="estrellas flex">
    @php
        echo "<p class='hidden' id='midRate'>" . $midRate . "</p>"
    @endphp
    @auth
        @if(auth()->id() != $product->artisans->user_id)
        <form action="{{ route('productRatting', $product->id) }}" method="POST" id="starForm">
            @method('POST')    
            @csrf
            <div class="rate mt-4w">
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
        @endif
        @if(auth()->id() == $product->artisans->user_id)
            @if ($votesCount != 0)
                <div class="flex flex-row items-baseline mt-4">
                    @for ($i = 1; $i <= $midRate; $i++)
                    <img src="{{URL::to('/image/star-solid.svg')}}" alt="star-solid" width="25" class="mr-3">
                    @endfor
                    @for ($i = 1; $i <= (5 -$midRate); $i++)
                        <img src="{{URL::to('/image/star-regular.svg')}}" alt="star-empty" width="25" class="mr-3">
                    @endfor
                </div>
            @endif
        @endif
    @endauth
    @guest
        @if ($votesCount != 0)
        <div class="flex flex-row items-baseline mt-4">
            @for ($i = 1; $i <= $midRate; $i++)
            <img src="{{URL::to('/image/star-solid.svg')}}" alt="star-solid" width="25" class="mr-3">
            @endfor
            @for ($i = 1; $i <= (5 -$midRate); $i++)
                <img src="{{URL::to('/image/star-regular.svg')}}" alt="star-empty" width="25" class="mr-3">
            @endfor
        </div>
        @endif
    @endguest
</div>


<div class="flex flex-row mt-2">
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
        document.getElementById(inputId).checked = true;
    }

    const starForm = document.getElementById('starForm');
    function castVote(input){
        starForm.submit(input.value);
    }
</script>


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
    color:#DAB162;    
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


