{{-- 測驗題目 --}}
<dl>
        {{-- $key是陣列的索引值 --}}
        {{-- @forelse ($topics as $key => $topic)  --}}
        @forelse ($exam->topics as $key => $topic) 
        <dt class="h3">
            
            @can('建立測驗')
            {{-- 刪除測驗題目 --}}
            {{-- <form action="{{route('topic.destroy', $topic->id)}}"  method="post" style="display:inline">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">刪除題目</button>
            </form>  --}}
            
            <button type="button" class="btn btn-danger btn-del-topic" data-id="{{ $topic->id }}">刪除</button>

                <a href="{{route('topic.edit', $topic->id)}}" class="btn btn-warning">編輯題目</a>
                （{{$topic->ans}}）
            @endcan
            {{-- {{ bs()->badge()->text($key+1) }} --}}
            <span class="badge badge-success">{{$key+1}}</span>
            {{$topic->topic}}
            
        </dt>
        <dd class="opt">
            {{ bs()->hidden("ans[$topic->id]",0)}}  {{--設一個隱藏欄位,給答案預設值 0,避免學生都未填答,json檔會沒資料--}}
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