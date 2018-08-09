{{-- 繼承自layouts/app.blade.php 視圖 --}}
@extends('layouts.app')
{{-- 用來定義一個樣板變數content，及其對應值 --}}
@section('content')
    {{-- container是bootstrap的用法,它是一個容器 --}}
        <h1>
            {{$exam->title}}            
            @can('建立測驗')
                {{-- 刪除測驗 --}}
                {{-- <form action="{{route('exam.destroy', $exam->id)}}"  method="post" style="display:inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">刪除測驗</button>
                </form>      --}}

                <button type="button" class="btn btn-danger btn-del-exam" data-id="{{ $exam->id }}">刪除測驗</button>
                <a href="{{ route('exam.edit',$exam->id)}}" class="btn btn-warning">編輯測驗</a>
            @endcan
        </h1>
        <div class="text-center">
                {{ $exam->user->name }} ({{ $exam->user->email }}) 發佈於 {{$exam->created_at->format("Y年m月d日 H:i:s")}} / 最後更新： {{$exam->updated_at->format("Y年m月d日 H:i:s")}}
        </div>

        {{-- 建立測驗題目 --}}
        @can('建立測驗')  

            @include('exam.form')

        @endcan


        {{-- 測驗題目列表 --}}

        @if(Auth::check('建立測驗') || Auth::check('進行測驗'))
            @can('進行測驗')
                {{ bs()->openForm('post', '/test') }}
                    @include('exam.topic')
                    {{ bs()->hidden('user_id', Auth::id()) }}
                    {{ bs()->hidden('exam_id', $exam->id) }}
                    <div class="text-center my-5">
                        {{ bs()->submit('寫完送出') }}
                    </div>
                {{ bs()->closeForm() }}
            @else
                {{-- 題目列表 --}}
                @include('exam.topic')  
            @endcan
        @else
            @component('bs::alert', ['type' => 'info'])
                共 {{ $exam->topics->count() }} 題
            @endcomponent
        @endif


@endsection

@section('scriptsAfterJs')
    <script>
        $(document).ready(function() {
            // 刪除題目 按鈕點擊事件 (確認後才刪除題目)
            $('.btn-del-topic').click(function() {
                // 獲取按鈕上 data-id 屬性的值，也就是編號
                var id = $(this).data('id');  //line 16 有一個data_id,在這邊就是 data('id')
                // 調用 sweetalert
                swal({
                    title: "確定要刪除題目嗎？",
                    text: "刪除後該題目就消失救不回來囉！",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "是！含淚刪除！",
                    cancelButtonText: "不...別刪",
                }).then((result) => {
                    if (result.value) {
                        swal("OK！刪掉題目惹！", "該題目已經隨風而逝了...", "success");
                        // 調用刪除介面，用 id 來拼接出請求的 url
                        axios.delete('/topic/' + id).then(function () {
                            location.reload();
                        });
                    }
                });
            });

            // 刪除測驗 按鈕點擊事件 (確認後才刪除測驗)
            $('.btn-del-exam').click(function() {
                // 獲取按鈕上 data-id 屬性的值，也就是編號
                var id = $(this).data('id');
                // 調用 sweetalert
                swal({
                    title: "確定要刪除測驗嗎？",
                    text: "刪除後該測驗連同所有題目就消失救不回來囉！",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "是！含淚刪除！",
                    cancelButtonText: "不...別刪",
                }).then((result) => {
                    if (result.value) {
                        swal("OK！刪掉測驗惹！", "該測驗所有資料已經隨風而逝了...", "success");
                        // 調用刪除介面，用 id 來拼接出請求的 url
                        axios.delete('/exam/' + id).then(function () {
                            location.href='/exam'; //刪完後,連回首頁
                        });
                    }
                });
            });
        });
    </script>
@endsection


