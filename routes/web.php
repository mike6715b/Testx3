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
    if (Auth::check()) {
        return redirect()->route('mainmenu');
    } else {
        return view('login');
    }
});

Route::post('login', [
    'as' => 'login',
    'uses' => 'LoginController@login',
]);
Route::get('login', function () {
    return view('login');
});
Route::get('logout', [
    'as' => 'logout',
    'uses' => 'LoginController@logout',
]);
Route::get('mainmenu', [
    'as' => 'mainmenu',
    'uses' => 'PagesController@mainmenu',
]);

/*
Route::get('/db', function () {
   \Illuminate\Support\Facades\DB::table('users')->insert(
       [
           [
               'user_name' => 'Bruno Rehak',
               'user_uid' => 'bruno.rehak',
               'user_email' => 'bruno.rehak@gmail.com',
               'user_pwd' => \Illuminate\Support\Facades\Hash::make('delta0690.'),
               'user_class' => 'admin',
           ]
       ]
   );
   echo "User added!";
});
*/


