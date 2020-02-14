<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\{Post, Category, Tag};
use App\Enums\PostEnumStatusType;

use Illuminate\Http\Request;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate();
        $title = 'Posts Management';
        return view('admin.posts.index', compact('posts', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add New Post";
        $categories = Category::get()->pluck('name', 'id');
        $tags = Tag::get()->pluck('name', 'id');
        $status = PostEnumStatusType::toSelectArray();
        return view('admin.posts.create', compact('title'))
            ->withStatus($status)->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = Post::firstOrCreate([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'user_id' => Auth::id() ?? 1
        ]);

        $post->tags()->sync((array)$request->input('tags'));  
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('name', 'id'); 
        $status = PostEnumStatusType::toSelectArray();
        $tags = Tag::get()->pluck('name', 'id');
        return view('admin.posts.edit')->withPost($post)->withStatus($status)->withCategories($categories)->withTags($tags)->withTitle('Posts management');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->update(['title' => $request->title, 'content'=>$request->content, 'status'=>$request->status, 'category_id'=>$request->category_id, 'user_id'=>Auth::id() ?? 1]);
        $post->tags()->sync((array)$request->input('tag'));
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
