<?php 

namespace App\middleware;

use App\Auth\Auth;

class AuthenticateFromCookies
{

    private $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;        
    }

    public function __invoke($request, $response, callable $next)
    {

        if ($this->auth->check()) {
            return $next($request, $response);
        }

        if ($this->auth->isRemembered()) {
            $this->auth->setUserFromCookies();
        }

        return $next($request, $response);
    }

}