<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'organisation_id',
        'nom',
        'code',
        'email',
        'telephone',
        'adresse',
        'ville',
        'pays',
        'description',
        'statut',
    ];

    protected $casts = [
        'statut' => 'boolean',
    ];

    /**
     * Un site appartient à une organisation.
     */
    public function organisation(): BelongsTo
    {
        return $this->belongsTo(
            Organisation::class
        );
    }
}
