<?php

namespace App\Http\Controllers;

use App\Test;
use App\Topic;
use Illuminate\Http\Request;

class TestController extends Controller
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
    public function store(Request $request)
    {
        //
        $content = collect($request->ans)->toJson();
        $score   = 0;
        foreach ($request->ans as $topic_id => $ans) {
            $topic = Topic::find($topic_id);
            $score += ($topic->ans == $ans) ? 20 : 0; //考5題,每答題一題+20分
        }

        $test = Test::create([
            'content' => $content,
            'user_id' => $request->user_id,
            'exam_id' => $request->exam_id,
            'score'   => $score,
        ]);
        return redirect()->route('test.show', $test->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //$test即為Test的資料物件，由於有設定關聯，所以，會一併抓出$test->exam及$test->user的資料
    public function show(Test $test)
    {
        //秀出考試結果
        $topics  = json_decode($test->content, true); //考試者的填答做成json格式存入content中,並將json資料轉回陣列
        $content = [];
        $i       = 0;
        foreach ($topics as $topic_id => $ans) {
            $content[$i]['topic'] = Topic::find($topic_id);
            $content[$i]['ans']   = $ans; //把使用者的作答一併存入$content陣列中，以便待會比對是否作答正確
            $i++;

        }
        return view('exam.test', compact('test', 'content'));
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
