<?php 

namespace App\Controllers;

use App\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm($request, $response)
    {
        return $this->view->render($response, 'auth/login.twig');
    }   
}