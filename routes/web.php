<?php

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('Admin')
    ->prefix('admin')
    ->as('admin.')
	->group(function () {
        Route::get('', 'DashboardController')->name('index'); 	 
        
        Route::get('categories/trashed', 'CategoryController@trashed')->name('categories.trashed');
        Route::post('categories/restore/{id}', 'CategoryController@restore')->name('categories.restore');
        Route::delete('categories/force/{id}', 'CategoryController@force')->name('categories.force');
        Route::resource('categories', 'CategoryController');
        Route::resource('users', 'UserController');
        Route::resource('posts', 'PostController');
        Route::resource('tags', 'TagController');
});

Route::get('/blog', 'BlogController@index')->name('blog.index'); 

// Route::get('/blog/{post}', 'BlogController@show')->name('blog.show'); 
Route::get('blog/{slug}', 'BlogController@show')->name('blog.show');


Route::get('posts-by-status', function () {
    $user = \App\User::find(2);
    $posts = $user->posts()->get();
    $posts = $user->posts->where('status', 1)->all();
    foreach ($posts as $post) {
        dump($post);
    }
});

Route::get('/get-by-user', function () {
    $posts = App\Post::where('status', 2)
    ->with('user')
    ->get();
    dump($posts);
});
 
 

// Еще какие-то маршруты....

Route::fallback(function() {
    return "Oops… How you've trapped here?";
});