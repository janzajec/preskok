<?php

namespace App\Http\Controllers;

use App\Post;

class PostsController extends Controller
{
    public function showPosts()
    {
        $posts = Post::paginate(5);
        if (Request()->ajax()) {
            return Response()->json(
                view('posts', array('posts' => $posts)
                )->render());
        }

        return view('blog', array('posts' => $posts));
    }
}
