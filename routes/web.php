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

// Route::get('/', function () {
//     //沒有控制器的寫法

//     $data = ['name' => 'tad', 'say' => '嗨！'];
//     return view('welcome', $data);

//     // return view('welcome')
//     //     ->with('name', 'stu1')
//     //     ->with('say', '嗨！');

// });

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::pattern('id', '[0-9]+');
Route::pattern('exam', '[0-9]+');

Route::get('/', 'ExamController@index')->name('index');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home'); //有控制器的寫法

Route::get('/', 'ExamController@index')->name('exam.index');
Route::get('/home', 'ExamController@index')->name('home'); //登入完會看到的畫面
Route::get('/exam', 'ExamController@index')->name('exam.index'); //指定打網址  localhost/exam   會導至首頁
//Route::get('/exam/{id}', 'ExamController@show')->name('exam.show')->where('id', '[0-9]+'); //限定id只能是數字
Route::get('/exam/{exam}', 'ExamController@show')->name('exam.show');
Route::get('/exam/{exam}/edit', 'ExamController@edit')->name('exam.edit');
Route::patch('/exam/{exam}', 'ExamController@update')->name('exam.update');
// Route::get('/exam/create', function () {
//     //建立測驗的路由
//     return view('exam.create');
// })->name('exam.create');

Route::get('/exam/create', 'ExamController@create')->name('exam.create');
Route::post('/exam', 'ExamController@store')->name('exam.store');
Route::post('/topic', 'TopicController@store')->name('exam.topic');
