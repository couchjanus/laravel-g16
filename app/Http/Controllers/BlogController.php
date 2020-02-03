<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BlogController extends Controller
{
    public function index()
    {
        // $posts = DB::select('select * from posts');
        // return $posts;

        $posts = DB::table('posts')->get();
        return view('blog.index', ['posts' => $posts, 'title'=>'Hello there! It’s a Blog!']);
        
        // $posts = DB::table('posts')
        //        ->orderBy('id', 'desc')
        //        ->get();
        // $title = 'Hello there! It’s a Blog!';
        // return view('blog.index', compact('posts', 'title'));
    }


    public function show($id)
    {
        // $post = DB::select("select * from posts where id = :id", ['id' => $id]);
        
        $post = DB::table('posts')->where('id', $id)->first();

        return view('blog.show', ['post' => $post]);
    }


    public function getLatestPost()
    {
        $title = 'Latest Blog Post';
        $posts = DB::table('posts')->orderBy('id', 'desc')->get();
        return view('blog.index', compact('posts', 'title'));
    }

    public function latestPost() {
        $post = DB::table('posts')
                ->latest()
                // Можно передать имя столбца для сортировки по нему:
                // ->latest('title')
                ->first();
        return view('blog.show', ['post' => $post]);
    }

    public function oldestPost()  {
        $post = DB::table('posts')
            ->oldest()
            // ->oldest('title')
            ->first();
        return view('blog.show', ['post' => $post]);
    }

    public function getPosts()
    {
        $title = 'Latest Blog Post';

        // $posts = DB::table('posts')
        // ->where('id', '>=', 100)
        // ->get();

        // $posts = DB::table('posts')
        //     ->where('id', '<>', 100)
        //     ->get();

        // $posts = DB::table('posts')
        //     ->where('title', 'like', 'T%')
        //     ->get();

        // $posts = DB::table('posts')->where([
        //     ['published', '=', true],
        //     ['id', '>', '10'],
        // ])->get();
        
        // В функцию where также можно передать массив условий:
        // $posts = DB::table('posts')
        //            ->where('id', '>', 50)
        //            ->orWhere('published', true)
        //            ->get();
        
        // Метод whereBetween проверяет, что значение столбца находится в указанном интервале:
        // $posts = DB::table('posts')
        //    ->whereBetween('id', [19, 30])->get();
 
        // Метод whereNotBetween проверяет, что значение столбца находится вне указанного интервала:
        // $posts = DB::table('posts')
        //     ->whereNotBetween('id', [50, 90])
        //     ->get();
        
        // Метод whereIn проверяет, что значение столбца содержится в данном массиве:

        // $posts = DB::table('posts')
        //         ->whereIn('category_id', [1, 2, 3])
        //         ->get();

        // Метод whereNotIn проверяет, что значение столбца не содержится в данном массиве:
        // $posts = DB::table('posts')
        //    ->whereNotIn('category_id', [1, 2, 3])
        //    ->get();

        // Метод whereNull проверяет, что значение столбца равно NULL:
        // $posts = DB::table('posts')
        //    ->whereNull('updated_at')
        //    ->get();

        // Метод whereNotNull проверяет, что значение столбца не равно NULL:

        // $posts = DB::table('posts')
        //            ->whereNotNull('updated_at')
        //            ->get();
        
        // Метод whereDate служит для сравнения значения столбца с датой:
        // $posts = DB::table('posts')
        //    ->whereDate('created_at', '2019-09-16')
        //    ->get();

        // Метод whereMonth служит для сравнения значения столбца с месяцем в году:
        // $posts = DB::table('posts')
        //    ->whereMonth('created_at', '09')
        //    ->get();

        // Метод whereDay служит для сравнения значения столбца с днём месяца:
        // $posts = DB::table('posts')
        //            ->whereDay('created_at', '16')
        //            ->get();
        
        // Метод whereYear служит для сравнения значения столбца с указанным годом:
        // $posts = DB::table('posts')
        //    ->whereYear('created_at', '2019')
        //    ->get();

        // Для проверки на совпадение двух столбцов можно использовать метод whereColumn:
        // $posts = DB::table('posts')
        //     ->whereColumn('updated_at', '>', 'created_at')
        //     ->get();

        return view('blog.index', compact('posts', 'title'));
    }

    // Для ограничения числа возвращаемых результатов из запроса используются метод take:
    public function takeLatestPosts()
    {
        $title = 'Latest Blog Post';
        $posts = DB::table('posts')->orderBy('id', 'desc')->take(5)->get();
        return view('blog.index', compact('posts', 'title'));
    }
    // Для пропуска заданного числа результатов в запросе используются метод skip:

    public function skipAndGetLatestPosts() 
    {
        $title = 'Latest Blog Post';
        $posts = DB::table('posts')->orderBy('id', 'desc')->skip(10)->take(5)->get();
        return view('blog.index', compact('posts', 'title'));
    }
    
    // Можно использовать методы limit и offset:

    public function getLimitLatestPosts()
    {
        $title = 'Latest Blog Post';
        $posts = DB::table('posts')
                ->offset(10)
                ->limit(5)
                ->get();
        return view('blog.index', compact('posts', 'title'));
    }

    public function getPostsWithCategory()
    {
        $title = 'Latest Blog Post';
        $posts = DB::table('posts')
                ->join('categories', 'categories.id', '=', 'posts.category_id')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->select('posts.*', 'categories.name', 'users.name As username')
                ->get();
        return view('blog.list', compact('posts', 'title'));
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        DB::table('posts')->insert(
            ['title' => $request['title'], 'votes' => 10, 'content' => $request['content'],  'category_id' => 1]
        );
    }

    public function edit($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();
        return view('blog.edit', ['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        DB::table('posts')
              ->where('id', $id)
              ->update(['title' => $request['title'], 'votes' => 10, 'content' => $request['content'],  'category_id' => 1]);
    }
}
