<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMobileNameIdToMobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mobiles', function (Blueprint $table) {
           $table->unsignedBigInteger('mobile_name_id')->nullable()->after('id');

        $table->foreign('mobile_name_id')->references('id')->on('mobile_names')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mobiles', function (Blueprint $table) {
             $table->dropForeign(['mobile_name_id']);
        $table->dropColumn('mobile_name_id');
        });
    }
}
