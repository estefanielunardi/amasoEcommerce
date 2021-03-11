<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Repositories\Product\ProductRepository;

class CommentController extends Controller
{
    private ProductRepository $producRepo;

    public function __construct()
    {
        $this->producRepo  = new ProductRepository;
    }
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->comment;
        $comment->user()->associate($request->user());
        $product = $this->producRepo->findProduct($request->product_id);
        $product->comments()->save($comment);
        return back();
    }

    public function replyStore(Request $request)
    {
        $reply = new Comment;
        $reply->body = $request->comment;
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->comment_id;
        $product = $this->producRepo->findProduct($request->product_id);

        $product->comments()->save($reply);

        return back();
    }

}
