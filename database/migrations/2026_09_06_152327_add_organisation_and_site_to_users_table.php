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
        Schema::table('users', function (Blueprint $table) {

            $table->foreignId('organisation_id')
                ->nullable()
                ->after('id')
                ->constrained('organisations')
                ->restrictOnDelete();

            $table->foreignId('site_id')
                ->nullable()
                ->after('organisation_id')
                ->constrained('sites')
                ->restrictOnDelete();

            $table->boolean('statut')
                ->default(true)
                ->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropForeign(['organisation_id']);
            $table->dropForeign(['site_id']);

            $table->dropColumn([
                'organisation_id',
                'site_id',
                'statut',
            ]);
        });
    }
};
