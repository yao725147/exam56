{{-- 繼承自layouts/app.blade.php 視圖 --}}
@extends('layouts.app')
{{-- 用來定義一個樣板變數content，及其對應值 --}}
@section('content')
    {{-- container是bootstrap的用法,它是一個容器 --}}
        <h1>{{$exam->title}}</h1>
        <div class="text-center">
            發佈於 {{$exam->created_at->format("Y年m月d日 H:i:s")}} / 最後更新： {{$exam->updated_at->format("Y年m月d日 H:i:s")}}
        </div>


@endsection


