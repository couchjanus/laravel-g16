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

// Еще какие-то маршруты....

Route::fallback(function() {
    return "Oops… How you've trapped here?";
});