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

        Route::get('users/trashed', 'UserController@trashed')->name('users.trashed');
        Route::post('users/restore/{id}', 'UserController@restore')->name('users.restore');
        Route::delete('users/force/{id}', 'UserController@force')->name('users.force');

        Route::post('changeStatus', 'UserController@changeUserStatus');

        Route::resource('users', 'UserController');
        Route::resource('posts', 'PostController');
        Route::resource('tags', 'TagController');
});

Route::get('/blog', 'BlogController@index')->name('blog.index'); 

Route::get('blog/{slug}', 'BlogController@show')->name('blog.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Еще какие-то маршруты....

Route::fallback(function() {
    return "Oops… How you've trapped here?";
});
