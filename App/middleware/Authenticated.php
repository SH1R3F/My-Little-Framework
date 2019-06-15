<?php 

namespace App\middleware;

use App\Auth\Auth;
use League\Route\RouteCollection;

class Authenticated
{

    private $auth;
    private $route;

    public function __construct(Auth $auth, RouteCollection $route)
    {
        $this->auth  = $auth;
        $this->route = $route;
    }

    public function __invoke($request, $response, callable $next)
    {
        
        if (!$this->auth->check()) {
            return redirect($this->route->getNamedRoute('auth.login')->getPath());
        }

        return $next($request, $response);
    }
}