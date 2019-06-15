<?php 

namespace App\middleware;

use App\Auth\Auth;
use League\Route\RouteCollection;

class Guest
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
        
        if ($this->auth->check()) {
            return redirect($this->route->getNamedRoute('home')->getPath());
        }

        return $next($request, $response);
    }
}