<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use App\Models\Role;
use App\Models\Team;
use Filament\Facades\Filament;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Collection;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\HasTenants;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements FilamentUser, HasTenants
{
     use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'password' => 'hashed',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasAnyRole(['admin','busines-owner', 'super-admin']);
    }
     public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }
    public function getTenants(Panel $panel): Collection
    {
        return $this->teams;
    }
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
    public function canAccessTenant(Model $tenant): bool
    {
        return $this->teams->contains($tenant);
    }
    public function team()
    {
        return $return = $this->teams()->where('team_id', Filament::getTenant()->id);
    }
}
