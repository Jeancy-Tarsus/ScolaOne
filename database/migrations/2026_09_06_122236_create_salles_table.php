<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('site_id')
                ->constrained('sites')
                ->restrictOnDelete();

            $table->string('nom');
            $table->string('code', 20);

            $table->integer('capacite')->default(40);

            $table->string('type')->nullable();

            $table->string('batiment')->nullable();
            $table->string('etage')->nullable();

            $table->text('description')->nullable();

            $table->enum('statut', [
                'disponible',
                'maintenance',
                'indisponible'
            ])->default('disponible');

            $table->timestamps();

            $table->unique([
                'site_id',
                'code'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salles');
    }
};
