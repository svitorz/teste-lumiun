<?php

namespace App\Models;

use App\Traits\DomainTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Domain extends Model
{

    protected $fillable = ['name','user_id','category_id'];

    public function validateDomains(string $avaliableDomain): bool
    {
        //checkdnsrr verifica se o domínio realmente existe, e preg_match utiliza regex para validar a string.
        return checkdnsrr($avaliableDomain, 'A')
            &&
            preg_match('/(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]/', $avaliableDomain);
    }



    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
