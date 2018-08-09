            {{-- 編輯測驗 --}}
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