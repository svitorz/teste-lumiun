<?php

namespace App\Models;

use App\Traits\DomainTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Domain extends Model
{
    use DomainTrait;

    protected $fillable = ['name','user_id','category_id'];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
