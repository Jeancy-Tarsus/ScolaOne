<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Niveau extends Model
{
    use HasFactory;

    protected $fillable = [
        'cycle_id',
        'nom',
        'code',
        'ordre',
        'description',
        'statut',
    ];

    protected $casts = [
        'ordre' => 'integer',
        'statut' => 'boolean',
    ];

    public function cycle(): BelongsTo
    {
        return $this->belongsTo(Cycle::class);
    }
}
