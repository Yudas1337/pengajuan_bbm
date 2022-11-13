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
        Schema::create('submissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('group_id')->nullable()->constrained();
            $table->foreignUuid('district_id')->nullable()->constrained();
            $table->foreignUuid('village_id')->nullable()->constrained();
            $table->foreignUuid('station_id')->nullable()->constrained();
            $table->string('receiver_type', 100)->nullable();
            $table->text('letter_file')->nullable();
            $table->text('letter_verification')->nullable();
            $table->text('excel_file')->nullable();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->boolean('status')->default(0);
            $table->foreignUuid('created_by')->nullable()->constrained('users');
            $table->foreignUuid('validated_by_penyuluh')->nullable()->constrained('users');
            $table->foreignUuid('validated_by_petugas')->nullable()->constrained('users');
            $table->foreignUuid('validated_by_kepala_dinas')->nullable()->constrained('users');
            $table->text('approval_message')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('submissions');
    }
};
