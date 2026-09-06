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
        Schema::create('groupes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('niveau_id')
                ->constrained('niveaux')
                ->restrictOnDelete();

            $table->string('nom');
            $table->string('code', 20);

            $table->integer('ordre')->default(1);

            $table->integer('capacite')->default(40);

            $table->text('description')->nullable();

            $table->boolean('statut')->default(true);

            $table->timestamps();

            $table->unique([
                'niveau_id',
                'code'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groupes');
    }
};
