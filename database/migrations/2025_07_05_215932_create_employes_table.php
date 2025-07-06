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
        Schema::create('employes', function (Blueprint $table) {
            $table->id(); // Champ ID auto-incrémenté
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Clé étrangère vers la table users
            $table->foreignId('departement_id')->constrained()->onDelete('cascade'); // Clé étrangère vers la table departements
            $table->date('date_embauche'); // Champ pour la date d'embauche
            $table->string('poste'); // Champ pour le poste de l'employé
            $table->decimal('salaire', 10, 2); // Champ pour le salaire
            $table->timestamps(); // Champs pour les timestamps (created_at et updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
