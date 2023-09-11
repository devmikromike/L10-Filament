<?php

namespace App\Models;

use Filament\Facades\Filament;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as Roles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Roles
{
    use HasFactory, HasRoles;

    public function team()
    {
        return $return = $this->teams()->where('team_id', Filament::getTenant()->id);
    }
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }
}
