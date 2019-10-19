<?php

namespace App\Http\Controllers;
use App\Post;
use App\File;
use App\Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function save(Request $request, $post_id)
    {
        $validator = $request->validate([
            //'content' => 'required|max:255',
        ]);

        $comment = new Comment;
        if (empty($request->content))
        {
            $comment->content = "新しいコメント";
        }
        else
        {
            $comment->content = $request->content;
        }
        $comment->file_id = $request->file_id;
        if ($post_id !== "nopost")
        {
            $comment->post_id = $post_id;
        }
        $comment->user_id = $request->user()->id;
        $sort_no = Comment::where('comments.file_id', $request->file_id)
            ->where('comments.user_id', $request->user()->id)
            ->max('comments.sort_no') + 1;
        if (is_null($sort_no))
        {
            $comment->sort_no = 1;
        }
        else
        {
            $comment->sort_no = $sort_no;
        }
        $comment->save();

        return redirect()->back();
    }
}
