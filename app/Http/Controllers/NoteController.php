<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Note;

class NoteController extends Controller
{

    public function index(Request $request, $post_id)
    {
        $notes = Note::join('users', 'users.id', '=', 'notes.created_user_id')
            ->select(['notes.*', 'users.name'])
            ->where('notes.post_id', $post_id)
            ->orderBy('notes.updated_at', 'desc')
            ->get();

        foreach ($notes as $note)
        {
            $note->count = Post::where('posts.note_id', $note->id)->count();
        }

        $post = Post::join('users', 'users.id', '=', 'posts.user_id')
            ->select(['posts.*', 'users.name'])
            ->where('posts.id', $post_id)
            ->first();

        return view('note', [
            'notes' => $notes,
            'post' => $post,
        ]);
    }

    public function save(Request $request, $post_id)
    {
        $validator = $request->validate([
        ]);

        $note = new note;
        $note->title= $request->title;
        $note->post_id = $post_id;
        $note->created_user_id = $request->user()->id;
        $note->updated_user_id = $request->user()->id;
        $note->save();

        return redirect('/'.$post_id.'/note');
    }

    public function open(Request $request, $post_id, $note_id)
    {
        $post = Post::join('users', 'users.id', '=', 'posts.user_id')
            ->select(['posts.*', 'users.name'])
            ->where('posts.id', $post_id)
            ->first();

        $note = Note::join('users', 'users.id', '=', 'notes.created_user_id')
            ->select(['notes.*', 'users.name'])
            ->where('notes.id', $note_id)
            ->first();

        $note_posts = Post::join('users', 'users.id', '=', 'posts.user_id')
            ->select(['posts.*', 'users.name'])
            ->where('posts.note_id', $note_id)
            ->orderBy('posts.updated_at', 'asc')
            ->get();

        return view('note_open', [
            'post' => $post,
            'note' => $note,
            'note_posts' => $note_posts,
        ]);
    }
}