<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firmas', function (Blueprint $table) {
            $table->bigIncrements('pkFirmas');
            $table->string('file_path', 100)->default('');
            $table->string('file_name', 100)->default('');
            $table->string('file_ext', 25)->default('');
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
        Schema::dropIfExists('firmas');
    }
}
