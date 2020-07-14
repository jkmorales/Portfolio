<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes_trabajo', function (Blueprint $table) {
            $table->bigIncrements('pkOt');
            $table->string('ot',50)->default('666666');
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
        Schema::dropIfExists('ordenes_trabajo');
    }
}
