{{-- 繼承自layouts/app.blade.php 視圖 --}}
@extends('layouts.app')
{{-- 用來定義一個樣板變數content，及其對應值 --}}
@section('content')
    {{-- container是bootstrap的用法,它是一個容器 --}}
        <h1>
            {{$exam->title}}
            @can('建立測驗')  
                <a href="{{ route('exam.edit',$exam->id)}}" class="btn btn-warning">編輯測驗</a>
            @endcan
        </h1>
        <div class="text-center">
            發佈於 {{$exam->created_at->format("Y年m月d日 H:i:s")}} / 最後更新： {{$exam->updated_at->format("Y年m月d日 H:i:s")}}
        </div>

        {{-- 建立測驗題目 --}}
        @can('建立測驗')  
            @if(isset($topic))
            {{-- //編輯測驗題目 --}}
            {{ bs()->openForm('patch', "/topic/{$topic->id}", ['model' => $topic]) }}   
            @else
            {{-- //建立測驗題目 --}}
            {{ bs()->openForm('post', '/topic') }}  
            @endif
                {{ bs()->formGroup()
                        ->label('題目內容', false, 'text-sm-right')  //標籤名稱
                        ->control(bs()->textarea('topic')->placeholder('請輸入題目內容'))  //輸入元件
                        ->showAsRow() }}
                {{ bs()->formGroup()
                        ->label('選項1', false, 'text-sm-right')
                        ->control(bs()->text('opt1')->placeholder('輸入選項1'))
                        ->showAsRow() }}
                {{ bs()->formGroup()
                        ->label('選項2', false, 'text-sm-right')
                        ->control(bs()->text('opt2')->placeholder('輸入選項2'))
                        ->showAsRow() }}
                {{ bs()->formGroup()
                        ->label('選項3', false, 'text-sm-right')
                        ->control(bs()->text('opt3')->placeholder('輸入選項3'))
                        ->showAsRow() }}
                {{ bs()->formGroup()
                        ->label('選項4', false, 'text-sm-right')
                        ->control(bs()->text('opt4')->placeholder('輸入選項4'))
                        ->showAsRow() }}
                {{-- {{ bs()->formGroup()
                        ->label('正確解答', false, 'text-sm-right')
                        ->control(bs()->select('ans',[1=>1, 2=>2, 3=>3, 4=>4])->placeholder('請設定正確解答'))
                        ->showAsRow() }} --}}
                {{ bs()->formGroup()
                    ->label('正確解答', false, 'text-sm-right')
                    ->control(bs()->radioGroup('ans', [1=>'1', 2=>'2',3=>'3', 4=>'4'])
                        //->selectedOption(1)
                        ->inline()->addRadioClass(['my-1', 'mx-3']))  //my-1 距離上方1個單位  mx-3 距離左邊3個單位
                    ->showAsRow() }}                        
                {{ bs()->hidden('exam_id', $exam->id) }}
                {{ bs()->formGroup()
                        ->label('')
                        ->control(bs()->submit('儲存'))
                        ->showAsRow() }}
            {{ bs()->closeForm() }}
        @endcan



        <dl>
            {{-- $key是陣列的索引值 --}}
            {{-- @forelse ($topics as $key => $topic)  --}}
            @forelse ($exam->topics as $key => $topic) 
            <dt class="h3">
                
                @can('建立測驗')
                    <a href="{{route('topic.edit', $topic->id)}}" class="btn btn-warning">編輯題目</a>
                    （{{$topic->ans}}）
                @endcan
                {{-- {{ bs()->badge()->text($key+1) }} --}}
                <span class="badge badge-success">{{$key+1}}</span>
                {{$topic->topic}}
                
            </dt>
            <dd class="opt">
                {{ bs()->radioGroup("ans[$topic->id]", [
                        1=>"<span class='opt'>&#10102; $topic->opt1</span>",
                        2=>"<span class='opt'>&#10103; $topic->opt2</span>",
                        3=>"<span class='opt'>&#10104; $topic->opt3</span>",
                        4=>"<span class='opt'>&#10105; $topic->opt4</span>"
                    ])->selectedOption((Auth::user() and Auth::user()->can('建立測驗'))?$topic->ans:0) 
                    //有登入,且有建立測驗權限的人,會把答案標註出來
                    //->inline()  //inline()是排在同一行,意即"橫排"  ,若要"直排",就把inline()這行拿掉
                    ->addRadioClass(['mx-3']) }}
            </dd>
        @empty
            <div class="alert alert-danger">尚無任何題目</div>
        @endforelse
        </dl>


@endsection


