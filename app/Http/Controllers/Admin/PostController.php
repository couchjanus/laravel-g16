<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\{Post, Category, Tag};
use App\Enums\PostEnumStatusType;

use Illuminate\Http\Request;
use Auth;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Image;

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

        // $this->validate($request, [
        //     'title' => 'required',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        $post = Post::firstOrCreate([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
            'user_id' => Auth::id() ?? 1,
            // 'cover_path' => $this->uploadCover($request->file("cover")),
            'cover_path' => $this->uploadImage($request->file("cover")),
            'visits' => 0
        ]);

        $post->categories()->sync((array)$request->input('categories'));  
        $post->tags()->sync((array)$request->input('tags'));  
        return redirect()->route('admin.posts.index');
    }

    private function uploadCover(UploadedFile $file) : string
    {
        $filename = time() . "." . $file->getClientOriginalExtension();
        $file->storeAs("public/covers", $filename);
        return asset("storage/covers/". $filename);
    }

    public function uploadImage(UploadedFile $file) : string
    {
        $filename = time() . "." . $file->getClientOriginalExtension();
        $img = Image::make($file);
        $img->resize(520, 250, function ($constraint) {
            $constraint->aspectRatio();
        })->save(storage_path('app/public/covers')."/".$filename);
        return asset("storage/covers/". $filename);
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
        
        $data = ['title' => $request->title, 'content'=>$request->content, 'status'=>$request->status, 'user_id'=>Auth::id() ?? 1];

        if($request->file("cover")) {
            Storage::delete("public/covers/" . $post->cover);
            $data += ["cover_path" => $this->uploadCover($request->file("cover"))]; 
        } else {
            $data += ["cover_path" => $post->cover_path]; 
        }

        $post->update($data);

        $post->tags()->sync((array)$request->input('tags'));
        $post->categories()->sync((array)$request->input('categories')); 

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
        Storage::delete("public/covers/{$post->cover}");
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
