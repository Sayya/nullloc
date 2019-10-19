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

        $comments = Comment::leftJoin('posts', 'posts.id', '=', 'comments.post_id')
            ->leftJoin('users', 'users.id', '=', 'posts.user_id')
            ->leftJoin('notes', 'notes.id', '=', 'posts.note_id')
            ->select(['comments.*', 
                'posts.content as post_content', 
                'posts.created_at as post_created_at', 
                'users.name as user_name', 
                'notes.title as note_title', 
                'notes.id as note_id'])
            ->where('comments.file_id', $file_id)
            ->orderBy('comments.sort_no', 'asc')
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

        $comments = Comment::leftJoin('posts', 'posts.id', '=', 'comments.post_id')
            ->leftJoin('users', 'users.id', '=', 'posts.user_id')
            ->leftJoin('notes', 'notes.id', '=', 'posts.note_id')
            ->select(['comments.*', 
                'posts.content as post_content', 
                'posts.created_at as post_created_at', 
                'users.name as user_name', 
                'notes.title as note_title', 
                'notes.id as note_id'])
            ->where('comments.file_id', $file_id)
            ->orderBy('comments.sort_no', 'asc')
            ->get();

        return view('file.edit', [
            'file' => $file,
            'comments' => $comments,
        ]);
    }

    public function draw(Request $request, $file_id)
    {
        return view('file.draw', [
            'file_id' => $file_id,
        ]);
    }

    public function draw_save(Request $request, $file_id)
    {
        return view('file.draw', [
            'file_id' => $file_id,
        ]);
    }

    public function pubed(Request $request, $file_id)
    {
        $file = File::where('files.id', $file_id)
            ->orderBy('files.updated_at', 'desc')
            ->first();
        $file->open_scope = 1;
        $file->save();
        return redirect('/file/'.$file_id);
    }

    public function update(Request $request, $file_id)
    {
        $validator = $request->validate([
        ]);

        $comments = Comment::where('comments.file_id', $file_id)
            ->get();

        foreach ($comments as $comment)
        {
            if (! empty($request["comment".$comment->id]))
            {
                $comment->content = $request["comment".$comment->id];
                $comment->sort_no = $request["sort".$comment->id];
                $comment->save();
            }
            else
            {
                $comment->delete();
            }
        }

        return redirect('/file/'.$file_id);
    }

    public function del(Request $request, $file_id)
    {
        return redirect('/file/'.$file_id);
    }
}
