<?php

namespace App\Repositories\Comment;

use Illuminate\Http\Request;
use App\Models\Product;

interface ICommentRepository {

    public function storeNewComment(request $request);
    public function replyComment(request $request);
    public function saveComment($comment, product $product);
}
