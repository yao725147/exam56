{{-- 繼承自layouts/app.blade.php 視圖 --}}
@extends('layouts.app')
{{-- 用來定義一個樣板變數content，及其對應值 --}}
@section('content')
    {{-- container是bootstrap的用法,它是一個容器 --}}
        <h1>隨機題庫系統</h1>

        <div class="list-group">      

            @forelse($exams as $exam)
                
                {{-- <a href="#" class="list-group-item list-group-item-action">{{ $exam->title }}</a> --}}
                <a  href="exam/{{ $exam->id }}" class="list-group-item list-group-item-action">
                    {{ $exam->updated_at->format('Y年m月d日')}}
                    {{ $exam->title }}
                </a>
            @empty
                <div class="alert alert-danger">
                    尚無任何測驗
                </div>
            @endforelse
            
        </div>    
@endsection

{{-- 
@section('my_menu')
    <li><a class="nav-link" href="/home">新增題庫</a></li>
    @parent
@stop --}}

