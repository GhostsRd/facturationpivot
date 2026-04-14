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
        Schema::create('audit_versements', function (Blueprint $table) {
            $table->id();
            $table->string('type_action');
            $table->bigInteger('date_operation')->nullable();
            $table->bigInteger('num_versement');
            $table->bigInteger('num_compte');
            $table->string('nom_client');
            $table->bigInteger('ancien_montant');
            $table->bigInteger('nouveau_montant');
            $table->string('utilisateur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_versements');
    }
};
