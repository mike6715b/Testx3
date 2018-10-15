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
Route::group(['middleware' => 'web'], function () {
    //ROOT
    Route::get('/', function () {
        return view('login');
    });

//LOGIN/LOGOUT
    Route::post('login', [
        'as' => 'login',
        'uses' => 'LoginController@login',
    ]);
    Route::get('login', function () {
        return view('login');
    });
});


Route::group(['middleware' => ['web', 'auth']], function () {

//MAINMENU
    Route::get('mainmenu', [
        'as' => 'mainmenu',
        'uses' => 'PagesController@mainmenu',
    ]);
//Exam
    Route::get('mainmenu/exam', [
        'as' => 'mainmenu.exam',
        'uses' => 'PagesController@exam'
    ]);
    Route::get('mainmenu/examlist', [
        'as' => 'mainmenu.examlist',
        'uses' => 'PagesController@examlist',
    ]);
    Route::get('mainmenu/examresult', [
        'as' => 'mainmenu.examresult',
        'uses' => 'PagesController@examresult'
    ]);
    Route::get('examgen', [
        'as' => 'examgen',
        'uses' => 'ExamController@examgen'
    ]);

//Add stud/teach
    Route::get('mainmenu/studadd', [
        'as' => 'mainmenu.studadd',
        'uses' => 'PagesController@studadd',
    ]);
    Route::get('mainmenu/classadd', [
        'as' => 'mainmenu.classadd',
        'uses' => 'PagesController@classadd',
    ]);
    Route::get('mainmenu/studlist', [
        'as' => 'mainmenu.studlist',
        'uses' => 'PagesController@studlist',
    ]);
    Route::get('mainmenu/teachadd', [
        'as' => 'mainmenu.teachadd',
        'uses' => 'PagesController@teachadd',
    ]);
    Route::get('mainmenu/teachlist', [
        'as' => 'mainmenu.teachlist',
        'uses' => 'PagesController@teachlist',
    ]);

//Subject
    Route::get('mainmenu/subjadd', [
        'as' => 'mainmenu.subjadd',
        'uses' => 'PagesController@subjadd'
    ]);
    Route::get('mainmenu/subjlist', [
        'as' => 'mainmenu.subjlist',
        'uses' => 'PagesController@subjlist',
    ]);

//Fields
    Route::get('mainmenu/fieldadd', [
        'as' => 'mainmenu.fieldadd',
        'uses' => 'PagesController@fieldadd',
    ]);
    Route::get('mainmenu/fieldquesadd', [
        'as' => 'mainmenu.fieldquesadd',
        'uses' => 'PagesController@fieldquesadd',
    ]);
    Route::get('mainmenu/fieldlist', [
        'as' => 'mainmenu.fieldlist',
        'uses' => 'PagesController@fieldlist',
    ]);
    Route::get('showques', [
        'uses' => 'PagesController@showques'
    ]);

    Route::get('logout', [
        'as' => 'logout',
        'uses' => 'LoginController@logout',
    ]);
//UserTransaction
    Route::post('classadd', [
       'uses' => 'UserTransactionController@classadd'
    ]);

    Route::post('studadd', [
        'uses' => 'UserTransactionController@studadd'
    ]);

    Route::post('teachadd', [
        'uses' => 'UserTransactionController@teachadd'
    ]);

    Route::post('subjadd', [
        'uses' => 'UserTransactionController@subjadd'
    ]);
    Route::post('fieldadd', [
        'uses' => 'UserTransactionController@fieldadd'
    ]);
    Route::post('fieldquesadd', [
        'uses' => 'UserTransactionController@fieldquesadd'
    ]);

//Exam
    Route::post('examcreate', [
        'uses' => 'ExamController@examcreate',
    ]);
    Route::post('examcheck', [
        'uses' => 'ExamController@examcheck',
    ]);

//Ajax
    Route::get('ajaxGetFields', [
        'uses' => 'UserTransactionController@ajaxGetFields'
    ]);
    Route::get('ajaxGetClasses', [
        'uses' => 'UserTransactionController@ajaxGetClasses'
    ]);
});


Route::get('/db', function () {
   echo "Null!";
});
