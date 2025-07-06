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
        Schema::create('departements', function (Blueprint $table) {
            $table->id(); // Champ ID auto-incrémenté
            $table->string('name')->unique(); // Champ pour le nom du département
            $table->text('description')->nullable(); // Champ optionnel pour une description
            $table->timestamps(); // Champs pour les timestamps (created_at et updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departements');
    }
};

