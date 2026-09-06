<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PeriodeScolaire extends Model
{
    use HasFactory;

    protected $table = 'periodes_scolaires';

    protected $fillable = [
        'annee_scolaire_id',
        'nom',
        'code',
        'date_debut',
        'date_fin',
        'active',
        'description',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'active' => 'boolean',
    ];

    public function anneeScolaire(): BelongsTo
    {
        return $this->belongsTo(
            AnneeScolaire::class
        );
    }
}
