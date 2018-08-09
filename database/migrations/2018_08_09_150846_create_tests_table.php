<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content'); //紀錄此測驗的題目編號及答案
            $table->unsignedInteger('exam_id'); //對應的測驗編號
            $table->foreign('exam_id')->references('id')->on('exams');
            $table->unsignedInteger('user_id'); //學生編號
            $table->foreign('user_id')->references('id')->on('users'); //得分
            $table->unsignedTinyInteger('score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
