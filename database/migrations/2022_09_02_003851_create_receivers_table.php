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
            $table->char('national_identity_number', 16)->nullable();
            $table->string('name', 150);
            $table->string('phone_number', 15);
            $table->enum('gender', ['Perempuan', 'Laki-laki']);
            $table->string('birth_place', 100)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('profession', 100);
            $table->char('province_id', 20);
            $table->char('regency_id', 20);
            $table->char('district_id', 20);
            $table->char('village_id', 20);
            $table->text('address');
            $table->enum('status', ['Valid', 'Draft']);
            $table->string('equipment_type', 100);
            $table->date('valid_from')->nullable();
            $table->date('valid_until')->nullable();
            $table->string('fuel_type', 100);
            $table->integer('total_equipment');
            $table->text('barcode')->nullable();
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('regency_id')->references('id')->on('regencies');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('village_id')->references('id')->on('villages');
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
