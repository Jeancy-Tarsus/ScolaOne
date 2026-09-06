<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('annee_scolaire_id')
                ->constrained('annees_scolaires')
                ->restrictOnDelete();

            $table->foreignId('groupe_id')
                ->constrained('groupes')
                ->restrictOnDelete();

            $table->foreignId('salle_id')
                ->nullable()
                ->constrained('salles')
                ->restrictOnDelete();

            $table->string('nom');
            $table->string('code', 30);

            $table->integer('effectif_max')->default(40);

            $table->text('description')->nullable();

            $table->enum('statut', [
                'ouverte',
                'fermee',
                'suspendue'
            ])->default('ouverte');

            $table->timestamps();

            $table->unique([
                'annee_scolaire_id',
                'groupe_id'
            ]);

            $table->unique([
                'annee_scolaire_id',
                'code'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
