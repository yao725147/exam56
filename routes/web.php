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
    //沒有控制器的寫法

    $data = ['name' => 'tad', 'say' => '嗨！'];
    return view('welcome', $data);

    // return view('welcome')
    //     ->with('name', 'stu1')
    //     ->with('say', '嗨！');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home'); //有控制器的寫法
Route::get('/exam', 'ExamController@index')->name('welcome'); //指定打網址  localhost/exam   會導至首頁

// Route::get('/exam/create', function () {
//     //建立測驗的路由
//     return view('exam.create');
// })->name('exam.create');

Route::get('/exam/create', 'ExamController@create')->name('exam.create');
