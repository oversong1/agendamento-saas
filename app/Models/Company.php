<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'phone',
        'logo',
        'business_type',
        'plan',
        'is_active',
    ];

    // Relacionamento: uma empresa tem muitos usuários (donos/atendentes)
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    // Relacionamento: uma empresa tem muitos profissionais
    public function professionals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Professional::class);
    }

    // Relacionamento: uma empresa tem muitos serviços
    public function services(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Service::class);
    }
}
