<?php

namespace App\Repositories\Comment;

use App\Repositories\Comment\ICommentRepository;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Product;

class CommentRepository implements ICommentRepository
{
    public function storeNewComment(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->comment;
        $comment->user()->associate($request->user());
        return $comment;
    }

    public function replyComment(request $request) 
    {
        $reply = new Comment;
        $reply->body = $request->comment;
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->comment_id;
        return $reply;
    }

    public function saveComment($comment, product $product) 
    {
        $product->comments()->save($comment);
    }

}