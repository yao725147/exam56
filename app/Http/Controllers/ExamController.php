<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Http\Requests\ExamRequest;
use App\Topic; //使用我們自製的 ExamRequest
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // $exams = Exam::all();        //Exam是eloquent model, all()是取得所有資料

        // $exams = Exam::where('enable', 1)->get(); //只列出有啟用測驗的項目

        //驗證是否有權限,有權限的人,秀出所有測驗
        //Auth::check()                     檢查是否已經登入？
        //Auth::user()->can('建立測驗')      是否有權限編修?
        if (Auth::check() and Auth::user()->can('建立測驗')) {
            $exams = Exam::orderBy('created_at', 'desc') //按照建立測驗日期 （desc由大至小,由最近至遠)
                ->paginate(3);
        } else {
            //沒權限的人,只列出測驗有啟用的項目
            $exams = Exam::where('enable', 1)
                ->orderBy('created_at', 'desc') //按照建立測驗日期 （desc由大至小,由最近至遠)
                ->paginate(3);

        }

        //dd($exams);
        return view('exam.index', compact('exams'));
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

    // public function show($id)
    // {
    //     //
    //     $exam = Exam::find($id);
    //     return view('exam.show', compact('exam'));
    // }

    //路由模型綁定 (黑魔法)
    public function show(Exam $exam)
    {
        //
        //$exam = Exam::find($id);

        // $topics = Topic::where('exam_id', $exam->id)->get();
        // // dd($topics);
        // return view('exam.show', compact('exam', 'topics'));

        return view('exam.show', compact('exam'));

        // return view('exam.show', compact('exam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //編輯測驗
        return view('exam.create', compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExamRequest $request, Exam $exam)
    {
        //更新測驗
        $exam->update($request->all()); //更新測驗
        return redirect()->route('exam.show', $exam->id); //轉回原本的測驗頁面
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //----- 直接刪除 ------//
    // public function destroy(Exam $exam)
    // {
    //     //刪除測驗
    //     $exam->delete();
    //     return redirect()->route('exam.index');
    // }

    //----- 確認後刪除 ------//
    public function destroy(Exam $exam)
    {
        //刪除測驗
        $exam->delete();
    }

}
