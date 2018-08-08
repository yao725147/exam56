{{-- 繼承自layouts/app.blade.php 視圖 --}}
@extends('layouts.app')
{{-- 用來定義一個樣板變數content，及其對應值 --}}
@section('content')
    {{-- container是bootstrap的用法,它是一個容器 --}}
        <h1>{{$exam->title}}</h1>
        <div class="text-center">
            發佈於 {{$exam->created_at->format("Y年m月d日 H:i:s")}} / 最後更新： {{$exam->updated_at->format("Y年m月d日 H:i:s")}}
        </div>

        {{-- 建立測驗題目 --}}
        @can('建立測驗')  
            {{ bs()->openForm('post', '/topic') }}
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
                        ->selectedOption(1)
                        ->inline()->addRadioClass(['my-1', 'mx-3']))  //my-1 距離上方1個單位  mx-3 距離左邊3個單位
                    ->showAsRow() }}                        
                {{ bs()->hidden('exam_id', $exam->id) }}
                {{ bs()->formGroup()
                        ->label('')
                        ->control(bs()->submit('儲存'))
                        ->showAsRow() }}
            {{ bs()->closeForm() }}
        @endcan


@endsection


