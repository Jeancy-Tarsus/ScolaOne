<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();

            $table->foreignId('organisation_id')
                ->constrained('organisations')
                ->cascadeOnDelete();
                
            $table->string('code');
            $table->string('nom');

            $table->string('email')->nullable();
            $table->string('telephone')->nullable();

            $table->text('adresse')->nullable();

            $table->string('ville')->nullable();
            $table->string('pays')->default('République du Congo');

            $table->text('description')->nullable();

            $table->boolean('statut')->default(true);

            $table->timestamps();

            $table->unique(['organisation_id', 'code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
