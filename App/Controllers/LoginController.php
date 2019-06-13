<?php 

namespace App\Controllers;

use App\Auth\Auth;
use App\Views\View;
use App\Controllers\Controller;
use League\Route\RouteCollection;

class LoginController extends Controller
{

    protected $view;
    protected $auth;
    protected $route;

    public function __construct(View $view, Auth $auth, RouteCollection $route)
    {
        $this->view = $view;
        $this->auth = $auth;
        $this->route = $route;
    }

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

        $attempt = $this->auth->attempt($data['email'], $data['password']);

        if (!$attempt) {
            die("Failed");
        }

        return redirect($this->route->getNamedRoute('dashboard')->getPath());

    }

}