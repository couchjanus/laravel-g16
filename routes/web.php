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
});

Route::get('/blog', 'BlogController@index')->name('blog.index'); 

Route::get('/blog/{post}', 'BlogController@show')->name('blog.show'); 

// Еще какие-то маршруты....

Route::fallback(function() {
    return "Oops… How you've trapped here?";
});