<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Note;
use App\File;

class SearchController extends Controller
{

    public function search(Request $request)
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
            ->orderBy('files.updated_at', 'desc')
            ->get();

        return view('board', [
            'is_search' => true,
            'posts' => $posts,
            'notes' => $notes,
            'files' => $files,
        ]);
    }

    public function note_index(Request $request, $post_id)
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

        return view('note.board', [
            'is_search' => true,
            'notes' => $notes,
            'post' => $post,
        ]);
    }

    public function note_open(Request $request, $post_id, $note_id)
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

        foreach ($note_posts as $note_post)
        {
            $note_post->count = Note::where('notes.post_id', $note_post->id)->count();
        }

        return view('note.open', [
            'is_search' => true,
            'post' => $post,
            'note' => $note,
            'note_posts' => $note_posts,
        ]);
    }
}
