<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use App\Comment;

class FileController extends Controller
{

    public function index(Request $request)
    {
        $files = File::join('users', 'users.id', '=', 'files.created_user_id')
            ->select(['files.*', 'users.name'])
            ->where('files.created_user_id', $request->user()->id)
            ->orderBy('files.updated_at', 'desc')
            ->get();

        return view('file.board', [
            'files' => $files,
        ]);
    }

    public function save(Request $request)
    {
        $validator = $request->validate([
        ]);

        $file = new File;
        if (empty($request->title))
        {
            $file->title = "新しいまとめ";
        }
        else
        {
            $file->title= $request->title;
        }
        $file->created_user_id = $request->user()->id;
        $file->updated_user_id = $request->user()->id;
        $file->save();

        return redirect('/file/'.$file->id);
    }

    public function open(Request $request, $file_id)
    {
        $file = File::join('users', 'users.id', '=', 'files.created_user_id')
            ->select(['files.*', 'users.name'])
            ->where('files.id', $file_id)
            ->orderBy('files.updated_at', 'desc')
            ->first();

        $comments = Comment::join('posts', 'posts.id', '=', 'comments.post_id')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->select(['comments.*', 'posts.content as post_content', 'posts.created_at as post_created_at', 'users.name'])
            ->orderBy('comments.updated_at', 'desc')
            ->get();

        return view('file.open', [
            'file' => $file,
            'comments' => $comments,
        ]);
    }

    public function edit(Request $request, $file_id)
    {
        $file = File::join('users', 'users.id', '=', 'files.created_user_id')
            ->select(['files.*', 'users.name'])
            ->where('files.id', $file_id)
            ->orderBy('files.updated_at', 'desc')
            ->first();

        $comments = Comment::join('posts', 'posts.id', '=', 'comments.post_id')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->select(['comments.*', 'posts.content as post_content', 'users.name'])
            ->orderBy('comments.updated_at', 'desc')
            ->get();

        return view('file.edit', [
            'files' => $files,
            'comments' => $comments,
        ]);
    }

    public function del(Request $request, $file_id)
    {
        return redirect('/file/'.$file_id);
    }
}
