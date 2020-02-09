<?php

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('Admin')
    ->prefix('admin')
    ->as('admin.')
	->group(function () {
        Route::get('', 'DashboardController')->name('index'); 	 
        Route::resource('categories', 'CategoryController');
    	Route::resource('users', 'UserController');
});

Route::get('/blog', 'BlogController@index')->name('blog.index'); 

Route::get('/blog/{post}', 'BlogController@show')->name('blog.show'); 

// Еще какие-то маршруты....

Route::fallback(function() {
    return "Oops… How you've trapped here?";
});