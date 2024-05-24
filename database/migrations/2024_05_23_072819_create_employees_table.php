<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('position_id');
            $table->unsignedBigInteger('workplace_id');
            $table->timestamps();

            $table->foreign('position_id')
            ->references('id')
            ->on('positions')
            ->onDelete('cascade');

            $table->foreign('workplace_id')
            ->references('id')
            ->on('workplaces')
            ->onDelete('cascade');

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
