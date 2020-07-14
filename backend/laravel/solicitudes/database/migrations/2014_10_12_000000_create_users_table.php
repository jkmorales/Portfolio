<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50);
            $table->string('paterno',50);
            $table->string('materno',50)->default('');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',200);
            $table->integer('fkPerfil')->unsigned()->default(1);
            $table->integer('fkRecordStatus')->unsigned()->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            //$table->foreign('fkPerfil')->references('pkPerfil')->on('perfiles');
            //$table->foreign('fkRecordStatus')->references('pkRecordStatus')->on('record_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
