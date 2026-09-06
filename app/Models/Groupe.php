<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Groupe extends Model
{
    use HasFactory;

    protected $fillable = [
        'niveau_id',
        'nom',
        'code',
        'ordre',
        'capacite',
        'description',
        'statut',
    ];

    protected $casts = [
        'ordre' => 'integer',
        'capacite' => 'integer',
        'statut' => 'boolean',
    ];

    public function niveau(): BelongsTo
    {
        return $this->belongsTo(Niveau::class);
    }
}
