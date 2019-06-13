<?php

namespace App\Hashing;

use App\Hashing\HasherInterface;

class BcryptHasher implements HasherInterface
{

    public function create($plain)
    {
        return password_hash($plain, PASSWORD_BCRYPT, $this->options());
    }

    public function check($plain, $hash){
        return password_verify($plain, $hash);
    }

    public function needsRehash($hash){
        return password_needs_rehash($hash, PASSWORD_BCRYPT, $this->options());
    }

    private function options()
    {
        return [
            'cost' => 12
        ];
    }
    
}