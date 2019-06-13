<?php 

namespace App\middleware;

use Exception;
use App\Auth\Auth;

class Authenticate
{

    private $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function __invoke($request, $response, $next)
    {

        // check if user is in session
        if ($this->auth->hasUserInSession()) {
            try{
                $this->auth->setUserFromSession();
            } catch (Exception $e) {
                // Log out
                die('Err');
            }
        }

        return $next($request, $response);
    }
}