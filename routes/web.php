<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
    $sampleArray = ['one', 'two', 'three'];
    dump($sampleArray);
    return 'Test Dump Server';
});


Route::get('/api', function() {
    dump(request()->all());
    return ['some'=> 'output'];
});


Route::post('/contacts', function() {
    dump(request()->all());    
});

Route::match(array('GET', 'POST'), '/contact', function()
{
    // dump('Hello World');
    // dump(request()->all()); 
    dump(request()); 
});

// Route::get('/blog', function()
// {
// //    return 'Hello Blog';
//    return view('blog');
// });

Route::get('/blog/show', function() {
    if (view()->exists('blog/show')) {
        return view('blog/show');
    }
});

Route::get('/blog/create', function() {
    return view('blog/create', ['name' => 'Hey U Janus! Whatsapp?', 'title' => 'Create New Post', 'fooUrl'=>'heyYou']);
});


// Route::get('/blog', 'BlogController@index')->name('blog');

Route::match(['get', 'post'], '/foobar', function () {
    return 'Hello FooBar!';
});

Route::any('foomar', function () {
    return 'Hello Foomar!';
});


Route::get('hello-bar', function () {
    return 'Hello Bar!';
})->name('bar');
 
Route::get('hello-barz', [function () {
    return 'Hello Bar!';
}, 'as' => 'barz']);

Route::get('barab', [function () {return 'Hello Bar!';}, 'as' => 'barz']);

Route::get('/hey', function () {
    return view('hello');
});

Route::get('/greeting', function () {
    return view('greeting', ['name' => 'Couch Janus']);
});

Route::get('/ole', function() {
    return view('hello.greeting', ['name' => 'Janus']);
});

Route::get('/oleole', function() {
    return view('hello/greeting', ['name' => 'Ole Janus']);
});

Route::get('/heyYou', function() {
    if (view()->exists('hello/greeting')) {
        return view('hello/greeting', ['name' => 'Hey U Janus! Whatsapp?']);
    }
});

Route::get('/test-controller', 'TestController@index')->name('tdd');

// Route::get('about', 'AboutController@index');
// Route::get('about', 'AboutController')->name('about');
// Route::get('contact-us', 'ContactController@index')->name('contact');

// // Route::get('admin', 'Admin\DashboardController@index');
// Route::get('dashboard', ['uses' => 'Admin\DashboardController@index', 'as' => 'admin']);

// Route::get('blog', ['uses' => 'PostController@index', 'as' => 'blog']);

// Route::get('blog/create', ['uses' => 'PostController@create', 'as' => 'create']);

// Route::post('blog/create', ['uses' => 'PostController@store', 'as' => 'store']);

// Route::get('blog/{id}', 
// ['uses' => 'PostController@show', 'as' => 'show']);

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
       // Handles the path /admin
     });
     Route::get('users', function () {
       // Handles the path /admin/users
      });
});

// Route::group(['prefix' => 'blog'], function () {
//     Route::get('/', 'BlogController@index');
//     Route::get('show', 'BlogController@show');
//     Route::get('create', 'BlogController@create');
// });

// Route::group(['namespace' => 'Admin'], function () {
//     Route::group(['prefix' => 'admin'], function () {
//         Route::get('/', 'DashboardController'); 	 
//     });
// });

// Route::namespace('Admin')
// 	->prefix('admin')
// 	->group(function () {
//     	Route::resource('users', 'UsersController');
// });

Route::group(['as' => 'blog.', 'prefix' => 'blog'], function () {	 
    Route::group(['as' => 'comments.', 'prefix' => 'comments'], function () {	 
        // you can use by in helper like route('blog.comments.list')          	 
        Route::get('{id}', function () { 
            // 
        })->name('list'); 
    });
});

// Route::namespace('Admin')
//     ->prefix('admin')
//     ->as('admin.')
// 	->group(function () {
//         Route::get('/', 'DashboardController'); 	 
//     	Route::resource('users', 'UsersController');
// });

// Еще какие-то маршруты....

Route::fallback(function() {
    return "Oops… How you've trapped here?";
});
