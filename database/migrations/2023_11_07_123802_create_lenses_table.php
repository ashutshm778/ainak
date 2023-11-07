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
            $table->string('discount');
            $table->string('warranty_period');
            $table->string('thickeness');
            $table->string('power_range');
            $table->string('blue_light_blocker');
            $table->string('anit_scratch_coating');
            $table->string('b_anti_glare_coating');
            $table->string('b_anti_reflective_coating');
            $table->string('uv_protection');
            $table->string('water_dust_replellent');
            $table->string('brekage_crack_resistance');
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
