<?php

use Illuminate\Http\{Request, Response};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {

    Route::get(
        'post/{id}/comments',
        function ($id) {
            return response()->json(['comments'=>\App\Post::find($id)->comments->all()], Response::HTTP_OK);
        }
    );

    Route::post(
        '/comment',
        function (Request $request) {
            $user = \App\User::find($request->user_id);
            $post = \App\Post::find($request->post_id);
            $post->comment($request->comment, $user);
            return response()->json('ok');
        }
    );
    
});



