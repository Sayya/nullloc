<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Note;
use App\File;

class BoardController extends Controller
{

    public function index(Request $request)
    {
        $posts = Post::join('users', 'users.id', '=', 'posts.user_id')
            ->select(['posts.*', 'users.name'])
            ->where('posts.note_id', null)
            ->orderBy('posts.updated_at', 'desc')
            ->get();

        foreach ($posts as $post)
        {
            $post->count = Note::where('notes.post_id', $post->id)->count();
        }

        $notes = Note::join('users', 'users.id', '=', 'notes.created_user_id')
            ->join('posts', 'posts.id', '=', 'notes.post_id')
            ->select(['notes.*', 'users.name', 'posts.content'])
            ->orderBy('notes.updated_at', 'desc')
            ->get();

        foreach ($notes as $note)
        {
            $note->count = Post::where('posts.note_id', $note->id)->count();
        }

        $files = File::join('users', 'users.id', '=', 'files.created_user_id')
            ->select(['files.*', 'users.name'])
            ->where('files.open_scope', 1)
            ->orderBy('files.updated_at', 'desc')
            ->get();

        $myfiles = File::select(['files.*'])
            ->where('files.open_scope', 0)
            ->where('files.created_user_id', $request->user()->id)
            ->orderBy('files.updated_at', 'desc')
            ->get();

        return view('board', [
            'posts' => $posts,
            'notes' => $notes,
            'files' => $files,
            'myfiles' => $myfiles,
        ]);
    }
}
