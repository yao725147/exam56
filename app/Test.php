<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    //考試

    protected $fillable = [
        'content', 'user_id', 'exam_id', 'score',
    ];

    public function exam()
    {
        return $this->belongsTo('App\Exam'); //一個考試屬於某個測驗
    }

    public function user()
    {
        return $this->belongsTo('App\User'); //一個考試屬於某個人
    }
}
