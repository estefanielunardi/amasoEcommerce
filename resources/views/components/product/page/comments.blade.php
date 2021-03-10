@foreach ($comments as $comment)
<div class="py-5">
    <p class="font-bold">{{ $comment->user->name }}</p>
    @foreach ($comment->user->rattings as $rating)
        @if($rating->product_id === $product->id)
        <div class="flex flex-row items-baseline mt-2">
            <x-product.page.ratings :rating=$rating/>
        </div>
        @endif
    @endforeach
    <p class="py-2">{{ $comment->body }}</p>
    <div class="flex flex row">
        <p class="text-xs greenAmaso">{{ $comment->created_at }}</p>
        <button onClick="openReply('{{$comment->id}}')" class="text-xs beigeAmaso font-bold pl-7">Responder</button>
        <button onClick="showReplies('.replies{{$comment->id}}')" class="text-xs beigeAmaso font-bold pl-7">Ver respuestas</button>
    </div>
</div>
<p id="message.replies{{$comment->id}}" class='message text-xs greenAmaso p-2'> Aun no hay respuestas a este comentario</p>

@foreach ($replies as $reply)
@if($reply->parent_id === $comment->id)
<div class="displayNone replies{{$comment->id}} py-5 pl-20">
    <p class="font-bold">{{ $reply->user->name }}</p>
    @foreach ($reply->user->rattings as $rating)
        @if($rating->product_id === $product->id)
        <div class="flex flex-row items-baseline mt-2">
            <x-product.page.ratings :rating=$rating/>
        </div>
        @endif
    @endforeach
    <p class="py-2">{{ $reply->body }}</p>
    <div class="flex flex row">
        <p class="text-xs greenAmaso">{{ $reply->created_at }}</p>
    </div>
</div>
@endif
@endforeach

<form method="POST" id="{{$comment->id}}" class=" pl-20 reply items-end min-w-full" action="{{ route('replyAdd') }}">
    @method('POST')
    @csrf
    <div class="flex flex-col text-xl greenAmaso w-2/3">
        <input type="text" class="m-w-full border-solid border-2 borderGreen rounded shadow-md h-10" name="comment" required autocomplete="comment" autofocus>
        <input type="hidden" name="product_id" value="{{ $product->id }}" />
        <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
    </div>
    <div class="pl-3 flex justify-center">
        <input type="submit" class="w-28 h-10 beigeAmasoBg font-serif text-white text-xl  rounded-md shadow-md" value="Responder" />
    </div>
</form>
@endforeach
{!! $comments->links() !!}

<form method="POST" class="items-end min-w-full" action="{{ route('commentAdd') }}">
    @method('POST')
    @csrf
    <div class=" pt-10 flex flex-col text-xl greenAmaso w-full lg:w-1/3">
        <label for="nombre" class="font-serif pb-3">{{ __('Escribe un comentario') }}</label>
        <textarea type="text" id="nombre" class=" min-w-full border-solid border-2 borderGreen rounded shadow-md h-20" name="comment" required autocomplete="comment"></textarea>
        <input type="hidden" name="product_id" value="{{ $product->id }}" />
        <div class="pl-3 pt-2 flex justify-end">
            <button type="submit" class="w-20 h-10 beigeAmasoBg font-serif text-white text-xl  rounded-md shadow-md">{{ __('enviar') }}</button>
        </div>
    </div>
</form>

<script>
    function openReply(id) {
        let reply = document.getElementById(id);
        reply.style.display === "none" ? reply.style.display = "flex" : reply.style.display = "none";
    }

    function showReplies(id) {
        let replies = Array.from(document.querySelectorAll(id));
        let message = document.getElementById('message' + id);
        if (replies.length == 0) {
            message.style.display === "none" ? message.style.display = "block" : message.style.display = "none"
        } else {
            replies.forEach(reply =>
                reply.style.display === "none" ? reply.style.display = "block" : reply.style.display = "none")
        }
    }
</script>