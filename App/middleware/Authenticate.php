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
                // user does not exist in database log me out and redirect to log in page
                die("I'm Gonna log you out");
            }
        }

        return $next($request, $response);
    }
}