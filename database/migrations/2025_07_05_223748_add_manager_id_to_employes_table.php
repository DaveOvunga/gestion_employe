<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('employes', function (Blueprint $table) {
            $table->foreignId('manager_id')->nullable()->constrained('users')->onDelete('set null'); // Ajoute la colonne manager_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('employes', function (Blueprint $table) {
            $table->dropForeign(['manager_id']); // Supprime la contrainte de clé étrangère
            $table->dropColumn('manager_id'); // Supprime la colonne manager_id
        });
    }
};
