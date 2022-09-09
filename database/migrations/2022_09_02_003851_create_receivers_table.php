<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receivers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('receiver_type', 100);
            $table->char('national_identity_number', 16);
            $table->string('name', 150);
            $table->text('address');
            $table->string('phone_number', 15);
            $table->string('equipment_type', 100);
            $table->string('fuel_type', 100);
            $table->integer('total_equipment');
            $table->text('barcode')->nullable();
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
        Schema::dropIfExists('receivers');
    }
};
