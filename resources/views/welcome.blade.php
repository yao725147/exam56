{{-- 繼承自layouts/app.blade.php 視圖 --}}
@extends('layouts.app')
{{-- 用來定義一個樣板變數content，及其對應值 --}}
@section('content')
    {{-- container是bootstrap的用法,它是一個容器 --}}
        <h1>隨機題庫系統</h1>
@endsection

{{-- 
@section('my_menu')
    <li><a class="nav-link" href="/home">新增題庫</a></li>
    @parent
@stop --}}