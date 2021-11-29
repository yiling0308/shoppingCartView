<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_information', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid')->notnull()->unique()->comment('會員編號');
            $table->tinyInteger('sex')->nullable()->comment('性別 (女:0, 男:1)');
            $table->date('birthday')->nullable()->comment('生日');
            $table->string('phone')->unique()->nullable()->comment('手機號碼');
            $table->string('county')->nullable()->comment('縣市');
            $table->string('district')->nullable()->comment('地區');
            $table->string('address')->nullable()->comment('住址');
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
        Schema::dropIfExists('member_information');
    }
}
