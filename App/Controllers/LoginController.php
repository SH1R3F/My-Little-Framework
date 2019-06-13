<?php 

namespace App\Controllers;

use App\Auth\Auth;
use App\Views\View;
use App\Sessions\Flash;
use App\Controllers\Controller;
use League\Route\RouteCollection;

class LoginController extends Controller
{

    protected $view;
    protected $auth;
    protected $route;
    protected $flash;

    public function __construct(View $view, Auth $auth, RouteCollection $route, Flash $flash)
    {
        $this->view = $view;
        $this->auth = $auth;
        $this->route = $route;
        $this->flash = $flash;
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
            $this->flash->now('error', "Invalid credentials! We cannot log you in.");
            return redirect($request->getUri()->getPath());
        }

        return redirect($this->route->getNamedRoute('home')->getPath());

    }

}