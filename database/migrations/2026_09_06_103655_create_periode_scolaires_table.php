<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('periodes_scolaires', function (Blueprint $table) {
            $table->id();

            $table->foreignId('annee_scolaire_id')
                ->constrained('annees_scolaires')
                ->cascadeOnDelete();

            $table->string('code', 20);
            $table->string('nom');

            $table->date('date_debut');
            $table->date('date_fin');

            $table->boolean('active')->default(false);

            $table->text('description')->nullable();

            $table->timestamps();

            $table->unique([
                'annee_scolaire_id',
                'code'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('periodes_scolaires');
    }
};
