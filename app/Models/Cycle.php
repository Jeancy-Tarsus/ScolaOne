<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cycle extends Model
{
    use HasFactory;

    protected $fillable = [
        'organisation_id',
        'nom',
        'code',
        'description',
        'statut',
    ];

    protected $casts = [
        'statut' => 'boolean',
    ];

    /**
     * Organisation à laquelle appartient le cycle.
     */
    public function organisation(): BelongsTo
    {
        return $this->belongsTo(
            Organisation::class
        );
    }

    public function niveaux(): HasMany
    {
        return $this->hasMany(Niveau::class);
    }
}
