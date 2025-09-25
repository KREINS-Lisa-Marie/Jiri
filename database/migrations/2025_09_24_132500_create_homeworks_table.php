<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('homeworks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained();
            $table->foreignId('jiri_id')->constrained();


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homeworks');
    }
};
