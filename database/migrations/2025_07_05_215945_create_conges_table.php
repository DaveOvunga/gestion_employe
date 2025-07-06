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
        Schema::create('conges', function (Blueprint $table) {
            $table->id(); // Champ ID auto-incrémenté
            $table->foreignId('employe_id')->constrained()->onDelete('cascade'); // Clé étrangère vers la table employes
            $table->date('date_debut'); // Champ pour la date de début du congé
            $table->date('date_fin'); // Champ pour la date de fin du congé
            $table->string('type_conge'); // Champ pour le type de congé (ex: annuel, maladie)
            $table->string('status')->default('en attente'); // Champ pour le statut du congé (ex: approuvé, rejeté)
            $table->timestamps(); // Champs pour les timestamps (created_at et updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};
