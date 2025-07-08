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
    Schema::create('fournisseurs', function (Blueprint $table) {
        $table->id();
        $table->string('nom_societe');
        $table->string('email')->nullable();
        $table->string('telephone')->nullable();
        $table->string('categorie')->nullable();
        
        // Adresses
        $table->string('adresse_nom')->nullable();
        $table->string('adresse_rue')->nullable();
        $table->string('adresse_cp')->nullable();
        $table->string('adresse_ville')->nullable();
        $table->boolean('adresse_facturation')->default(false);
        $table->boolean('adresse_livraison')->default(false);
        $table->boolean('adresse_devis')->default(false);

        // Contacts
        $table->string('contact_nom')->nullable();
        $table->string('contact_email')->nullable();
        $table->string('contact_telephone')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseurs');
    }
};
