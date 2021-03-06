<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    // 設定哪些欄位可以使用 fillable
    protected $fillable = [
        'title', 'user_id', 'enable',
    ];
    //把enable欄位  轉換成布林值(原本的資料庫資料型態是tinyint)
    protected $casts = [
        'enable' => 'boolean',
    ];

    public function topics()
    {
        return $this->hasMany('App\Topic'); //一個測驗有很多個題目
    }

    public function tests()
    {
        return $this->hasMany('App\Test'); //一個測驗卷可能有很多考試
    }
    public function user()
    {
        return $this->belongsTo('App\User'); //這個考試是由誰發佈
    }
}
