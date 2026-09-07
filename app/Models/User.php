<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * Attributs pouvant être remplis en masse.
     */
    protected $fillable = [
        'organisation_id',
        'site_id',
        'name',
        'email',
        'password',
        'statut',
    ];

    /**
     * Attributs cachés.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'statut' => 'boolean',
        ];
    }

    /**
     * Organisation à laquelle appartient l'utilisateur.
     */
    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
    }

    /**
     * Site auquel appartient l'utilisateur.
     */
    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}
