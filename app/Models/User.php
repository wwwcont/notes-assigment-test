<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }
}
