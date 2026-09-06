<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cycles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('organisation_id')
                ->constrained('organisations')
                ->cascadeOnDelete();

            $table->string('nom');
            $table->string('code', 20);

            $table->text('description')->nullable();

            $table->boolean('statut')->default(true);

            $table->timestamps();

            // Un même code ne peut pas être utilisé
            // deux fois dans la même organisation.
            $table->unique([
                'organisation_id',
                'code'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cycles');
    }
};
