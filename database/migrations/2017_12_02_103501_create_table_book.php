<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('书名');
            $table->unsignedInteger('author_id')->comment('作者ID');
            $table->string('profile', 1000)->nullable()->comment('书籍简介');
            $table->string('cover')->nullable()->comment('封面URL');
            $table->unsignedTinyInteger('type_id')->comment('书籍类型ID');
            $table->unsignedTinyInteger('status')->default(0)->comment('书籍状态，(0：连载，1：完结)');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement("alter table book comment '书籍信息'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book');
    }
}
