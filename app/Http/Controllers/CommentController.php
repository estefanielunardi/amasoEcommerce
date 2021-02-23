<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Product; 

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->comment;
        $comment->user()->associate($request->user());
        $product = Product::find($request->product_id);
        $product->comments()->save($comment);
        return back();
    }

    public function replyStore(Request $request)
    {
        $reply = new Comment();
        $reply->body = $request->comment;
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->comment_id;
        $product = Product::find($request->product_id);

        $product->comments()->save($reply);

        return back();
    }

}
