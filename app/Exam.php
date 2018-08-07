<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    // 設定哪些欄位可以使用 fillable
    protected $fillable = [
        'title', 'user_id', 'enable',
    ];
    //把enable欄位  轉換成布林值(0或1)
    protected $casts = [
        'enable' => 'boolean',
    ];
}
