<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfiles', function (Blueprint $table) {
            $table->bigIncrements('pkPerfil');
            $table->string('perfil',50);
            $table->integer('fkRecordStatus')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('perfiles');
    }
}
