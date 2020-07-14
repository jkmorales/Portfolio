<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->bigIncrements('pkSolicitud');
            $table->integer('monto');
            $table->string('observaciones',256)->nullable();
            $table->integer('fkUser')->default(1);
            $table->integer('fkFirma');
            $table->integer('fkOt');
            $table->integer('fkRecordStatus')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();
/*
            $table->foreign('fkRecordStatus')->references('pkRecordStatus')->on('record_status');
            $table->foreign('fkUser')->references('id')->on('user');
            $table->foreign('fkFirma')->references('pkFirma')->on('firmas');
            $table->foreign('fkOt')->references('pkOt')->on('ordenes_trabajo');
*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitudes');
    }
}
