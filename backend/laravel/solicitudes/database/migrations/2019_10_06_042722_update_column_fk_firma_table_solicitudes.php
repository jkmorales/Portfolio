<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnFkFirmaTableSolicitudes extends Migration
{
    public function up()
    {
        Schema::table('solicitudes',function(Blueprint $table){
            $table->integer('fkFirma')->nullable()->change();
        });

        Schema::table('solicitudes',function(Blueprint $table){
            $table->integer('fkRecordStatus')->unsigned()->default(4)->change();
        });
    }

    public function down()
    {
        Schema::table('solicitudes', function (Blueprint $table){
            $table->dropColumn('fkFirma');
        });

        Schema::table('solicitudes', function (Blueprint $table){
            $table->dropColumn('fkRecordStatus');
        });
    }
}
