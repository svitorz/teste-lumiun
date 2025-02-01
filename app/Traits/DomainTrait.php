<?php

namespace App\Traits;

trait DomainTrait {
    public function validateDomains(string $avaliableDomain): bool
    {
        //checkdnsrr verifica se o domínio realmente existe, e preg_match utiliza regex para validar a string.
        return checkdnsrr($avaliableDomain, 'A')
            &&
            preg_match('/(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]/', $avaliableDomain);
    }
}
