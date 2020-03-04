<?php

namespace App\Http\Controllers;

use App\{Category, Post};
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $posts = Category::find($category->id)->posts()->get();
        return view('posts.category', compact('category', 'posts'));
    }
   
}
