<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lenses', function (Blueprint $table) {
            $table->id();
            $table->string('power_type');
            $table->string('name');
            $table->string('price');
            $table->string('discount')->nullable();
            $table->string('warranty_period')->nullable();
            $table->string('thickeness')->nullable();
            $table->string('power_range')->nullable();
            $table->string('blue_light_blocker')->nullable();
            $table->string('anit_scratch_coating')->nullable();
            $table->string('b_anti_glare_coating')->nullable();
            $table->string('b_anti_reflective_coating')->nullable();
            $table->string('uv_protection')->nullable();
            $table->string('water_dust_replellent')->nullable();
            $table->string('brekage_crack_resistance')->nullable();
            $table->text('descrption')->nullable();
            $table->bigInteger('icon')->nullable();
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('lenses');
    }
}
