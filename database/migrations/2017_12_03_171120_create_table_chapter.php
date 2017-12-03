<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableChapter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapter', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('book_id')->comment('书籍ID');
            $table->string('name')->comment('章节名');
            $table->string('content_id')->nullable()->comment('内容ID');
            $table->timestamps();
        });

        DB::statement("alter table chapter comment '章节信息'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chapter');
    }
}
