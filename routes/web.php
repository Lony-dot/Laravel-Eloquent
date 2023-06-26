<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

Route::get('/accessor', function () {
    $post = Post::first();

    return $post->title_and_body;

});

Route::get('/delete', function () {
    $post = Post::where('id', 1)->first();

    if(!$post)
        return 'Post Not Found';
    dd($post->delete());

});

Route::get('/update', function(Request $request) {
    if (!$post = Post::find(1))
        return 'Post Not Found';

    // $post->title = 'Título atualizado';
    // $post->save();
    $post->update($request->all());

    dd(Post::find(1));

});

//maneira mais prática recebendo um array com todos os dados inseridos no banco de dados
Route::get('/insert2', function (Request $request) {
    $post = Post::create($request->all());

    dd($post);

    $posts = Post::get();

    return $posts;
});

Route::get('/insert', function (Post $post, Request $request) {
    $post->user_id = 1;
    $post->title = 'Primeiro Post ' . Str::random(10);
    $post->body = 'Conteúdo do post';
    $post->date = date('Y-m-d');
    $post->save();

    $posts = Post::get();

    return $posts;
});


Route::get('/orderby', function () {
    $users = User::orderBy('name', 'ASC')->get();

    return $users;
});

Route::get('/pagination', function () {
    $filter = request('filter');
    $totalPage = request('paginate', 10);
    $users = User::where('name', 'LIKE', "%{$filter}%")->paginate($totalPage);

    //return  $users;
});

Route::get('/where', function (User $user) {
    //User $user é a mesma coisa que criar um New User e jogar na variável $user
    $filter = 'a';
    //$user = $user->where('email', '=', 'kris78@example.com')->first();
    //$user = $user->where('email', 'kris78@example.com')->first();
    //$users = $user->where('name', 'LIKE', "%{$filter}%")->get();
    // $users = $user->where('name', 'LIKE', "%{$filter}%")
    //                 ->orWhere('name', 'Carlos')
    //                 ->get();
    $users = $user->where('name', 'LIKE', "%{$filter}%")
                    ->orWhere(function ($query) use ($filter) {
                        $query->where('name', '<>', 'Carlos');
                        $query->where('name', '=', $filter);
                    })
                    ->toSql();

    //dd($users);
});

Route::get('/select', function (){
    //$users = User::all();
    //$users = User::where('id', 10)->get();
    //$user = User::where('id', 10)->first();
    //$user = User::first();
    //$user = User::find(101);
    //$user = User::findOrFail(request('id'));
    //$user = User::where('name', request('name'))->firstOrFail();
    //$user = User::firstWhere('name', request('name'));
});

Route::get('/', function () {
    return view('welcome');
});
