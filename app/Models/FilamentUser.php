<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilamentUser extends Model
{
    use HasFactory;

    protected $table = 'filament_users';

    protected $primaryKey = 'id';

    public function role()
    {
        return $this->belongsToMany(Role::class, 'role');
    }
}
