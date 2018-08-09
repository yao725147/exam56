<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest; //使用我們自製的 TopicRequest
use App\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopicRequest $request)
    {
        //儲存題目
        //有用到Topic,記得最上方要有  use App\Topic;
        $topic = Topic::create($request->all()); //記得要至  /專案/app/Topic.php 設定哪些欄位可以使用 fillable)
        return redirect()->route('exam.show', $topic->exam_id); //新增完轉向show.blade.php列出來

        //批量賦值 第三種做法 (最簡單)  </專案/app/Exam.php 設定哪些欄位可以使用 fillable)>
        // Exam::create($request->all());
        // return redirect()->route('exam.index');

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
    public function edit(Topic $topic)
    {
        //
        //編輯題目  <<注意,這裡和測驗不同>>

        $exam = $topic->exam; //昨日model有設關聯,所以可以這樣用
        return view('exam.show', compact('exam', 'topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        //更新題目
        $topic->update($request->all());
        return redirect()->route('exam.show', $topic->exam_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect()->route('exam.show', $topic->exam_id);
    }

    // 當我們沒有使用路由模型綁定時，也可以用靜態方法的destroy()也可以，但此例我們需要抓出exam_id的值，故用destroy()也沒比較省事，因此底下參考一下即可。

    // public function destroy($id)
    // {
    //     Topic::destroy($id);
    //     return redirect()->route('exam.show', $id);
    // }
}
