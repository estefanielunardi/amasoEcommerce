<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Comment\ICommentRepository;
use App\Repositories\Product\IProductRepository;

class CommentController extends Controller
{
    private ICommentRepository $commentRepo;
    private IProductRepository $producRepo;

    public function __construct(IProductRepository $producRepo, ICommentRepository $commentRepo)
    {
        $this->commentRepo  = $commentRepo;
        $this->producRepo  = $producRepo;
    }
    public function store(Request $request)
    {
        $comment = $this->commentRepo->storeNewComment($request);
        $product = $this->producRepo->findProduct($request->product_id);

        $this->commentRepo->saveComment($comment, $product);

        return back();
    }

    public function replyStore(Request $request)
    {
        $reply = $this->commentRepo->replyComment($request);
        $product = $this->producRepo->findProduct($request->product_id);

        $this->commentRepo->saveComment($reply, $product);

        return back();
    }

}
