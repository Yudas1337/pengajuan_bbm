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
            $table->foreignUuid('group_id')->constrained();
            $table->string('receiver_type', 100)->nullable();
            $table->char('national_identity_number', 16)->unique()->nullable();
            $table->string('name', 150)->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->enum('gender', ['Perempuan', 'Laki-laki'])->nullable();
            $table->string('birth_place', 100)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('profession', 100);
            $table->string('province', 100)->nullable();
            $table->string('regency', 100)->nullable();
            $table->string('district', 100)->nullable();
            $table->string('village', 100)->nullable();
            $table->text('address')->nullable();
            $table->enum('status', ['Valid', 'Draft', 'Perubahan', 'Tidak Valid', 'Final', 'Ditutup'])->nullable();
            $table->text('barcode')->nullable();
            $table->softDeletes();
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
