<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    // 設定哪些欄位可以使用 fillable
    protected $fillable = [
        'topic', 'exam_id', 'opt1', 'opt2', 'opt3', 'opt4', 'ans',
    ];

}
