<?php 

namespace App\Security;

use App\Sessions\SessionInterface;

class Csrf
{

    private $session;
    private $persistToken = true;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function token()
    {
        if (!$this->tokenNeedsToBeGenerated()) {
            return $this->getTokenFromSession();
        }

        $this->session->set(
            $this->key(),
            $token = bin2hex(random_bytes(32))
        );

        return $token;
    }

    private function getTokenFromSession()
    {
        return $this->session->get($this->key());
    }

    private function tokenNeedsToBeGenerated()
    {
        if (!$this->session->exists($this->key())) {
            return true;
        }

        return !$this->shouldPersistToken();

    }

    private function shouldPersistToken()
    {
        return $this->persistToken;
    }

    public function key()
    {
        return 'csrf_token';
    }
}