
    @for ($i = 1; $i <= $rating->ratting; $i++)
        <img src="{{URL::to('/image/star-solid.svg')}}" alt="star-solid" width="12" class="mr-2">
    @endfor
    @for ($i = 1; $i <= (5 -$rating->ratting); $i++)
        <img src="{{URL::to('/image/star-regular.svg')}}" alt="star-empty" width="12" class="mr-2">
    @endfor
