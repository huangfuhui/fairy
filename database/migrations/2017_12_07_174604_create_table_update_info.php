<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUpdateInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('update_info', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('book_id')->comment('书籍ID');
            $table->string('update_tag', 10)->comment('更新标志');
            $table->string('address')->comment('更新地址');
            $table->string('backup_address_a')->nullable()->comment('备用地址A');
            $table->string('backup_address_b')->nullable()->comment('备用地址B');
            $table->timestamps();
        });

        DB::statement("alter table update_info comment '更新信息表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('update_info');
    }
}
