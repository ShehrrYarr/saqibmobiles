<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobiles', function (Blueprint $table) {
            $table->id();
            $table->string('mobile_name');
            $table->string('imei_number');
            $table->enum('sim_lock', ['J.V', 'PTA', 'Non-PTA']);
            $table->string('color');
            $table->string('storage');
            $table->decimal('cost_price', 12, 2);
            $table->decimal('selling_price', 12, 2);
            $table->string('customer_name')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('original_owner_id')->nullable();
            $table->string('battery_health')->nullable();

            $table->timestamps();
            $table->enum('availability', ['Available', 'Sold'])->default('Available');
            $table->timestamp('sold_at')->nullable();
            $table->boolean('is_transfer')->default(false);
            $table->enum('is_approve', ['Approved', 'Not_Approved'])->default('Not_Approved');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('original_owner_id')->references('id')->on('users')->onDelete('set null');
    });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobiles');
    }
}
