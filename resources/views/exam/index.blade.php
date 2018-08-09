{{-- 繼承自layouts/app.blade.php 視圖 --}}
@extends('layouts.app')
{{-- 用來定義一個樣板變數content，及其對應值 --}}
@section('content')
    {{-- container是bootstrap的用法,它是一個容器 --}}
        <h1>隨機題庫系統 <small>（共 {{$exams->total()}} 筆資料）</small></h1>

        <div class="list-group">      

            @forelse($exams as $exam)

                {{-- <a href="#" class="list-group-item list-group-item-action">{{ $exam->title }}</a> --}}
                <a  href="exam/{{ $exam->id }}" class="list-group-item list-group-item-action">
                    @if($exam->enable!=1)               
                        {{ bs()->badge('danger')->text('未啟用') }}
                        {{-- <span class="badge badge-danger">未啟用</span> --}}
                    @endif
                    {{ $exam->updated_at->format('Y年m月d日')}}
                    {{ $exam->title }}
                </a>
            @empty
                <div class="alert alert-danger">
                    尚無任何測驗
                </div>
            @endforelse
            
        </div>   
        
        {{-- 加入分頁 my-3 ~  my-5 超過6就失效--}}
        <div class="my-3">   
            {{ $exams->links() }}
        </div>
@endsection

{{-- 
@section('my_menu')
    <li><a class="nav-link" href="/home">新增題庫</a></li>
    @parent
@stop --}}

