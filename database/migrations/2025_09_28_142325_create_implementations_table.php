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
            //dabord déclarer colonne
            /* $table->smallInteger('points')->nullable(); */

            $table->foreign('homework_id')
                ->references('id')
                ->on('homeworks');
            // puis donner caracteristique d'etre clé étrangère: seulement quand laravel sait pas faire pluriel pour tables soi-même
            //donner role à colonne
            //foreignId fait les 2 "tapes en une fois mais ça marche pas pour cet erreur là

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('implementations');
    }
};
