<?php 

namespace App\Controllers\Auth;

use App\Auth\Auth;
use App\Views\View;
use App\Models\User;
use App\Controllers\Controller;
use App\Hashing\HasherInterface;
use League\Route\RouteCollection;

class RegisterController extends Controller
{

    protected $view;
    protected $hasher;
    protected $auth;
    protected $route;

    public function __construct(View $view, HasherInterface $hasher, Auth $auth, RouteCollection $route)
    {

        $this->view = $view;
        $this->hasher = $hasher;
        $this->auth = $auth;
        $this->route = $route;
        
    }

    public function showRegisterationForm($request, $response)
    {

        return $this->view->render($response, 'auth/register.twig');

    }


    public function register($request, $response)
    {
        $data = $this->validateRegistration($request);

        $this->createUser($data);
        
        if (!$this->auth->attempt($data['email'], $data['password'])) {
            return redirect($this->route->getNamedRoute('auth.login')->getPath());
        }

        return redirect($this->route->getNamedRoute('home')->getPath());

    }

    private function validateRegistration($request){
        return $this->validate($request, [
            'name' => ['required'],
            'email' => ['required', 'email', ['exists', User::class]],
            'password' => ['required', ['lengthMin', 8]],
            'password_confirmation' => ['required', ['equals', 'password']]
        ]);
    }

    private function createUser($data)
    {
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $this->hasher->create($data['password'])
        ]);
    }

}