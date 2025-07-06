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
        Schema::create('absences', function (Blueprint $table) {
            $table->id(); // Champ ID auto-incrémenté
            $table->foreignId('employe_id')->constrained()->onDelete('cascade'); // Clé étrangère vers la table employes
            $table->date('date_absence'); // Champ pour la date d'absence
            $table->string('motif'); // Champ pour le motif de l'absence
            $table->string('status')->default('justifiée'); // Champ pour le statut de l'absence (ex: justifiée, non justifiée)
            $table->timestamps(); // Champs pour les timestamps (created_at et updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};
