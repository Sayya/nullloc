<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Note;

class PostController extends Controller
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

        return view('posts', [
            'posts' => $posts,
            'notes' => $notes,
        ]);
    }

    public function save(Request $request, $note_id=null)
    {
        $validator = $request->validate([
            'content' => 'required|max:255',
        ]);

        $post = new Post;
        $post->content = $request->content;
        $post->note_id = $note_id;
        $post->user_id = $request->user()->id;
        $post->save();

        if (is_null($note_id))
        {
            return redirect('/');
        }
        else {
            $note = Note::select('notes.*')
                ->where('notes.id', $note_id)
                ->first();

            $note->updated_user_id = $request->user()->id;
            $note->updated_at = $post->updated_at;
            $note->save();

            return redirect('/'.$note->post_id.'/note/'.$note_id);
        }
    }
}
