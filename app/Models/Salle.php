<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Salle extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'nom',
        'code',
        'capacite',
        'type',
        'batiment',
        'etage',
        'description',
        'statut',
    ];

    protected $casts = [
        'capacite' => 'integer',
    ];

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}
