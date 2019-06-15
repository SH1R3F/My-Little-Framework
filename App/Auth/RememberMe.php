<?php 

namespace App\Auth;

class RememberMe
{

    public function validateToken($hash, $token)
    {
        return $hash === hash('sha256', $token);
    }

    public function separate($cookie)
    {
        return explode('|', $cookie);
    }

    public function cookieValue($identifier, $token)
    {
        return $identifier . '|' . $token;
    }

    public function generate()
    {
        return [$this->generateIdentifier(), $this->generateToken()];
    }

    public function generateIdentifier()
    {
        return bin2hex(random_bytes(32));
    }

    public function generateToken()
    {
        return bin2hex(random_bytes(32));
    }



}