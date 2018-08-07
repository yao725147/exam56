<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Http\Requests\ExamRequest; //使用我們自製的 ExamRequest
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //回傳welcome.blad.php view
        // return view('welcome');
        return view('exam.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //回傳exam下的create.blade.php的view回去
        return view('exam.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamRequest $request)
    {
        //-----------
        //接收建立測驗
        //-----------
        //dd($request); //把送過來的表單列出來

        //表單驗證
        // $this->validate($request, [
        //     'title' => 'required|min:2|max:191',
        // ], [
        //     'required' => '「:attribute」為必填欄位',
        //     'min'      => '「:attribute」至少要 :min 個字',
        //     'max'      => '「:attribute」最多只能 :max 個字',
        // ]);

        //批量賦值 第一種做法
        // $exam          = new Exam;
        // $exam->title   = $request->title;
        // $exam->user_id = $request->user_id;
        // $exam->enable  = $request->enable;
        // $exam->save();

        //批量賦值 第二種做法 ,且需要至model指定可用的欄位 (接著到 /專案/app/Exam.php 設定哪些欄位可以使用 fillable)
        // Exam::create([
        //     'title'   => $request->title,
        //     'user_id' => $request->user_id,
        //     'enable'  => $request->enable,
        // ]);

        //批量賦值 第三種做法 (最簡單)  </專案/app/Exam.php 設定哪些欄位可以使用 fillable)>
        Exam::create($request->all());
        return redirect()->route('exam.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
