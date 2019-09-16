<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Locus;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::join('users', 'users.id', '=', 'posts.user_id')
            ->select(['posts.*', 'users.name'])
            ->orderBy('posts.created_at', 'desc')
            ->get();
        foreach ($posts as $post)
        {
            $post->icon = count(Locus::where('locuses.post_id', $post->id)->get());
        }
        return view('posts', [
            'posts' => $posts,
        ]);
    }

    public function save(Request $request)
    {
        $validator = $request->validate([
            'content' => 'required|max:255',
        ]);

        $post = new Post;
        $post->content = $request->content;
        $post->user_id = $request->user()->id;
        $post->save();

        return redirect('/');
    }
}
