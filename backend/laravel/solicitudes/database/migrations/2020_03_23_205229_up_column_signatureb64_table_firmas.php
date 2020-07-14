<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpColumnSignatureb64TableFirmas extends Migration
{
    /**
     * Run the migrations.
     * longText
     * @return void
     */
    public function up()
    {
        Schema::table('firmas',function(Blueprint $table){
            $table->longText('signature_b64', 8192)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('firmas',function(Blueprint $table){
            $table->dropColumn('signature_b64', 8192)->change();
        });
    }
}
