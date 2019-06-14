<?php 

namespace App\middleware;

use App\Security\Csrf;
use App\Exceptions\CsrfTokenException;

class CsrfGuard
{

    private $csrf;
    
    public function __construct(Csrf $csrf)
    {
        $this->csrf = $csrf;
    }

    public function __invoke($request, $response, callable $next)
    {

        if (!$this->requestRequiresProtection($request)) {

            return $next($request, $response);

        }

        // Check if the token is valid 
        if (!$this->csrf->tokenIsValid($this->getTokenFromRequest($request))) {
            throw new CsrfTokenException;
        }

        return $next($request, $response);

    }

    private function requestRequiresProtection($request)
    {
        return in_array($request->getMethod(), ['POST', 'DELETE', 'PATCH', 'PUT']);
    }

    private function getTokenFromRequest($request)
    {
        return $request->getParsedBody()[$this->csrf->key()] ?? null;
    }

}