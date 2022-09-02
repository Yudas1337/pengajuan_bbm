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
        Schema::create('submission_receivers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('receiver_id')->constrained();
            $table->foreignUuid('submission_id')->constrained();
            $table->integer('quota');
            $table->boolean('status')->default(0);
            $table->foreignUuid('validated_by')->constrained('users');
            $table->timestamp('validated_at')->nullable();
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
        Schema::dropIfExists('submission_receivers');
    }
};
