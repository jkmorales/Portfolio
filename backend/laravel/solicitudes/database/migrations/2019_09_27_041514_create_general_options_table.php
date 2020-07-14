<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opciones_generales', function (Blueprint $table) {
            $table->bigIncrements('pkOpcionesGenerales');
            $table->string('opcionGeneral', 100)->default('');
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
        Schema::dropIfExists('opciones_generales');
    }
}
