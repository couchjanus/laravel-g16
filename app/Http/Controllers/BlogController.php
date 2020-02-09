<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('blog.index', ['title'=>'Hello there! It’s a Blog!', 'posts' => $posts]);
    }

    public function show(Post $post)
    {
        return view('blog.show',compact('post'));
    }

}
