<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::where('status', 2)->with('user')->orderBy('updated_at', 'desc')->simplePaginate(7);

        // $posts->each(function($post) {
        //     $post->comments = $post->getThreadedComments();
        // });

        return view('posts.index', ['title'=>'Hello there! It’s a Blog!', 'posts' => $posts]);
    }

    public function show($slug)
    {
        if (is_numeric($slug)) {
            $post = Post::findOrFail($slug);
            return Redirect::to(route('blog.show', $post->slug), 301);
        }
        $post = Post::whereSlug($slug)->with('user')->with('categories')->with('comments')->firstOrFail();

        // dd($post);

        $post->update(['visits' => $post->visits+1]);
        return view('posts.show',compact('post'));
    }
}
