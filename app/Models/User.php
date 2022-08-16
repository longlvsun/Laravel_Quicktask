<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'is_admin',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function booted()
    {
        static::addGlobalScope('active', function(Builder $query) {
            $query->where('is_active', true);
        });
    }

    public function scopeAdmin(Builder $query)
    {
        $query->where('is_admin', true);
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'owner_id');
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn($val, $attr) => $attr['first_name'] . ' ' . $attr['last_name'],
        );
    }

    protected function username(): Attribute
    {
        return Attribute::make(
            set: fn($val) => Str::slug($val, '-'),
        );
    }
}
