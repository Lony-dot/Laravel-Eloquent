<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/where', function (User $user) {
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

    dd($users);
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
