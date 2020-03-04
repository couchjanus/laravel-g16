<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Spatie\Searchable\Search;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::where('status', 2)->with('user')->with('categories')->orderBy('updated_at', 'desc')->simplePaginate(7);

        return view('posts.index', ['title'=>'Hello there! It’s a Blog!', 'posts' => $posts]);
    }

    public function show($slug)
    {
        if (is_numeric($slug)) {
            $post = Post::findOrFail($slug);
            return Redirect::to(route('blog.show', $post->slug), 301);
        }
        $post = Post::whereSlug($slug)->with('user')->with('categories')->with('comments')->firstOrFail();
        $post->update(['visits' => $post->visits+1]);
        return view('posts.show',compact('post'));
    }

    public function search(Request $request)
    {
        $searchResults = (new Search())
            ->registerModel(Post::class, 'title')
            ->registerModel(Category::class, 'name')
            ->perform($request->input('query'));

        $title = 'Serach Results';

        return view('posts.search', compact('searchResults', 'title'));
    }
}
