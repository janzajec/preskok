<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function showPosts(Request $request)
    {

        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $sale_date = $request->input('sale_date');

        $posts = Post::paginate(5);
        if (Request()->ajax()) {
            return Response()->json(
                view('posts', array('posts' => $posts)
                )->render());
        }

        return view('blog', array('posts' => $posts));
    }
}
