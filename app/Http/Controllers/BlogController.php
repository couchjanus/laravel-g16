<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    // public function index()
    // {
    //     $posts = Post::simplePaginate(7);
    //     return view('blog.index', ['title'=>'Hello there! It’s a Blog!', 'posts' => $posts]);
    // }

    public function index()
    {
        $posts = Post::where('status', 2)->with('user')->orderBy('updated_at', 'desc')->simplePaginate(7);
        return view('blog.index', ['title'=>'Hello there! It’s a Blog!', 'posts' => $posts]);
    }


    public function show($slug)
    {
        if (is_numeric($slug)) {
            // Get post for slug.
            $post = Post::findOrFail($slug);
            return Redirect::to(route('blog.show', $post->slug), 301);
            // 301 редирект со старой страницы, на новую.   
        }
        // Get post for slug.
        $post = Post::whereSlug($slug)->with('user')->with('categories')->firstOrFail();
        
        $post->update(['visits' => $post->visits+1]);
        return view('blog.show',compact('post'));
    }

}
