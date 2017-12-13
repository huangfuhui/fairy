<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableClickRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('click_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('book_id')->comment('书籍ID');
            $table->string('click')->comment('点击次数');
            $table->timestamps();

            $table->index('click');
        });

        DB::statement("alter table click_record comment '书籍点击记录'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('click_record');
    }
}
