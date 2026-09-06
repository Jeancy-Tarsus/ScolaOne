<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'code',
        'email',
        'telephone',
        'adresse',
        'logo',
        'description',
        'statut',
    ];

    protected $casts = [
        'statut' => 'boolean',
    ];

    /**
     * Utilisateurs appartenant à cette organisation.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'organisation_user'
        )->withPivot('role_id')
            ->withTimestamps();
    }

    public function sites(): HasMany
    {
        return $this->hasMany(Site::class);
    }


    public function anneesScolaires(): HasMany
    {
        return $this->hasMany(AnneeScolaire::class);
    }
}
