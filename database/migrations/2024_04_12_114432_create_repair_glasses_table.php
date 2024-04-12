<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairGlassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_glasses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('house_no')->nullable();
            $table->string('pincode')->nullable();
            $table->string('district')->nullable();
            $table->string('state')->nullable();
            $table->string('landmark')->nullable();
            $table->string('left_eye_lense')->nullable();
            $table->string('power_left')->nullable();
            $table->string('right_eye_lense')->nullable();
            $table->string('power_right')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repair_glasses');
    }
}
