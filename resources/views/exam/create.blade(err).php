@extends('layouts.app')
@section('content')
    <h1>{{ __('Create Exam') }}</h1>

    @can('建立測驗')
    {{ bs()->openForm('post', '/exam')}}

    {{ bs()->formGroup()
        ->label('測驗標題', false, 'text-sm-right')
        ->control(bs()->text('title')->placeholder('請填入測驗標題'))
        ->showAsRow() }}

    {{ bs()->formGroup()
        ->label('是否用', false, 'text-sm-right')
        ->control(bs()->text('title')->placeholder('請填入測驗標題'))
        ->showAsRow() }}


        {{ bs()->text('title')->placeholder('請填入測驗標題') }}
        {{ bs()->select('enable', ['1' => '開啟', '0' => '關閉'], '1') }}
        {{ bs()->checkbox('enable1')->description('啟用測驗')->checked() }}
        {{ bs()->radioGroup('enable2', [1 => '啟用', 0 => '關閉'])
            ->selectedOption(1)
            ->inline()
            ->radioDisabled()
            ->addRadioClass(['bg-light', 'my-3']) }}

        {{ bs()->submit('儲存')}}

    {{ bs()->closeForm() }}
    @else
    @component('bs::alert', ['type' => 'danger'])
        @slot('heading')
        沒有操作的權限
        @endslot

        <p>請先登入,或有相關權限者才可建立測驗!</p>
    @endcomponent

    {{-- <div class="alert-danger">
        <h3>沒有操作的權限</h3>
        <p>請先登入,或有相關權限者才可建立測驗!</p>
    </div> --}}
    @endcan
@endsection
