<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id'); // タスクID
            $table->string('name'); // タスク名
            $table->dateTime('deadline')->nullable(); // 期限日
            $table->string('status'); // 状態
            $table->unsignedBigInteger('habit_id'); // 習慣ID
            $table->unsignedBigInteger('cate_id'); // カテゴリーID
            $table->unsignedBigInteger('user_id'); // ユーザーID
            $table->timestamps();

            // $table->foreign('habit_id')->references('id')->on('habits');
            // $table->foreign('cate_id')->references('id')->on('cates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
