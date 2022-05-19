<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracking_data', function (Blueprint $table) {
            $table->id();
            $table->double('latitude');
            $table->double('longitude');
            $table->double('altitude');
            $table->double('bearing');
            $table->double('velocity');
            $table->double('gir_x')->default(0);
            $table->double('gir_y')->default(0);
            $table->double('gir_z')->default(0);
            $table->double('acel_x')->default(0);
            $table->double('acel_y')->default(0);
            $table->double('acel_z')->default(0);
            $table->foreignId('rsu_id')->constrained('rsus');
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
        Schema::dropIfExists('tracking_data');
    }
};
