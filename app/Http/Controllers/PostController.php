<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Note;

class PostController extends Controller
{

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
        else
        {
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
