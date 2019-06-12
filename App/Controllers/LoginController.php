<?php 

namespace App\Controllers;

use App\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm($request, $response)
    {
        return $this->view->render($response, 'auth/login.twig');
    }

    public function authenticate($request, $response)
    {
        $data = $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        die(print_r($data));
    }

}