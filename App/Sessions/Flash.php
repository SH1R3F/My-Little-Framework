<?php 

namespace App\Sessions;

use App\Sessions\SessionInterface;

class Flash
{
    private $session;
    private $messages;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;

        // Load all into cache
        $this->loadAllIntoCache();

        // Clear All
        $this->clear();

    }

    public function now($key, $value)
    {
        $this->session->set('flash', array_merge(
            $this->session->get('flash') ?? [],
            [
                $key => $value
            ]
        ));
    }

    public function has($key)
    {
        return isset($this->messages[$key]);
    }

    public function get($key)
    {
        if ($this->has($key)) {
            return $this->messages[$key];
        }
    }

    private function getAll()
    {
        return $this->session->get('flash');
    }

    private function clear()
    {
        $this->session->clear('flash');
    }

    private function loadAllIntoCache()
    {
        $this->messages = $this->getAll();
    }

}