<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSignatureb64TableFirmas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('firmas', function (Blueprint $table) {
            $table->string('siganture_b64', 8192)->default('')->after('fkRecordStatus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('firmas', function (Blueprint $table) {
            $table->dropColumn('siganture_b64');
        });
    }
}
