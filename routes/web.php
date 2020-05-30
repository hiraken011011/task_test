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
    return view('auth/login');
});

// トップページ
Route::get('/home', 'TaskController@index')->name('tasks.index');

Route::get('cates/index', 'CateController@index');

// タスク
Route::group(['prefix' => 'tasks', 'middleware' => 'auth'], function(){
    Route::get('index', 'TaskController@index')->name('tasks.index');
    Route::get('create', 'TaskController@create')->name('tasks.create');
    Route::post('store', 'TaskController@store')->name('tasks.store');
    Route::get('edit/{id}', 'TaskController@edit')->name('tasks.edit');
    Route::post('update/{id}', 'TaskController@update')->name('tasks.update');
    Route::post('destroy/{id}', 'TaskController@destroy')->name('tasks.destroy');    
});

// 既習慣
Route::group(['prefix' => 'habits', 'middleware' => 'auth'], function(){
    Route::get('index', 'HabitController@index')->name('habits.index');
    Route::get('create', 'HabitController@create')->name('habits.create');
    Route::post('store', 'HabitController@store')->name('habits.store');
    Route::get('edit/{id}', 'HabitController@edit')->name('habits.edit');
    Route::post('update/{id}', 'HabitController@update')->name('habits.update');
    Route::post('destroy/{id}', 'HabitController@destroy')->name('habits.destroy');
});

// カテゴリー
Route::group(['prefix' => 'cates', 'middleware' => 'auth'], function(){
    Route::get('index', 'CateController@index')->name('cates.index');
    Route::get('create', 'CateController@create')->name('cates.create');
    Route::post('store', 'CateController@store')->name('cates.store');
    Route::get('edit/{id}', 'CateController@edit')->name('cates.edit');
    Route::post('update/{id}', 'CateController@update')->name('cates.update');
    Route::post('destroy/{id}', 'CateController@destroy')->name('cates.destroy');
});



Auth::routes(); // 認証：ログインしたら