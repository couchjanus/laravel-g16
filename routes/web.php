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
        Route::get('invitations', 'InvitationsController@index')->name('showInvitations');
        Route::post('invite/{id}', 'InvitationsController@sendInvite')
        ->name('send.invite');
});

Route::get('/blog', 'BlogController@index')->name('blog.index'); 
Route::get('blog/{slug}', 'BlogController@show')->name('blog.show');

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', function () {
    return redirect('profile');
});

Route::middleware('auth')
    ->middleware('verified')
    ->prefix('profile')
    ->as('profile.')
	->group(function () {
        Route::get('', 'ProfileController@index')
            ->name('home');
        Route::get('info', 'ProfileController@info')
            ->name('info');
        Route::put('store', 'ProfileController@store')
            ->name('store');
});

Route::get('register/request', 'Auth\RegisterController@requestInvitation')->name('requestInvitation');

Route::post('invitations', 'InvitationController@store')->middleware('guest')->name('storeInvitation');


Auth::routes();
// Auth::routes(['verify' => true]);

// Route::get('reminder', function () {
//     return new \App\Mail\Reminder();
// })->name('reminder');

// Route::get('reminder', function () {
//     return new App\Mail\Reminder('Blah уже скоро!');
// })->name('reminder');

// Route::post('reminder', function (\Illuminate\Http\Request $request) {
//     dd($request);
//     // return redirect()->back();    
// })->name('reminder');

// Route::post('reminder', function (\Illuminate\Http\Request $request, \Illuminate\Mail\Mailer $mailer) {
//     $mailer->to($request->email)->send(new \App\Mail\Reminder($request->event));
//     return redirect()->back();    
// })->name('reminder');


// Route::get('invite', function () {
//     return (new App\Mail\InvitationMail())->render();
// });

Route::get('invite', function () {
    $url = 'Your Invite Link';
    return (new App\Mail\InvitationMail($url))->render();
});

// Route::get('invite', function () {
//     $url = 'http://google.com';
//     return (new App\Mail\InvitationMail($url))->render();
// });


// Еще какие-то маршруты....

Route::fallback(function() {
    return "Oops… How you've trapped here?";
});
