<?php 

namespace App\middleware;

use App\Sessions\SessionInterface;

class ClearValidationErrors
{

    protected $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function __invoke($request, $response, callable $next)
    {
        $next = $next($request, $response);
        $this->session->clear('errors', 'old');
        return $next;
    }

}