<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['value'];

    public function domains(): HasMany
    {
        return $this->hasMany(Domain::class);
    }
}
