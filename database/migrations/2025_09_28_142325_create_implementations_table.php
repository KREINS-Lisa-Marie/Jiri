<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('implementations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained();
            $table->unsignedInteger('homework_id');
            /* $table->smallInteger('points')->nullable(); */

            $table->foreign('homework_id')
                ->references('id')
                ->on('homeworks');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('implementations');
    }
};
