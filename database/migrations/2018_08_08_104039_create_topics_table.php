<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('topic'); //題目
            $table->unsignedInteger('exam_id');
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade'); //綁定exam資料表的id(測驗id),onDelete('cascade') 是一個約束條件，也就是當測驗刪除時，連同題目也一併刪除之意。 詳情：https://laravel-china.org/docs/laravel/5.6/migrations/1400#499c95
            $table->string('opt1'); //選項1
            $table->string('opt2'); //選項2
            $table->string('opt3'); //選項3
            $table->string('opt4'); //選項4
            $table->unsignedTinyInteger('ans'); //正確答案
            $table->timestamps(); //時間戳記
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
}
