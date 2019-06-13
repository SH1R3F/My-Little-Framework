<?php 
namespace App\Controllers;

use App\Auth\Auth;
use App\Views\View;
use App\Controllers\Controller;
use App\Sessions\SessionInterface;

class HomeController extends Controller
{
 
    protected $view;
    protected $session;

    public function __construct(View $view, SessionInterface $session, Auth $auth)
    {
        $this->view = $view;
        $this->session = $session;
        $this->auth = $auth;
    }

    public function index($request, $response)
    {
        return $this->view->render($response, 'home.twig', [
            'user' => $this->auth->user()
        ]);
    }

    public function dashboard($request, $response)
    {
        return $this->view->render($response, 'dashboard.twig', [
            'userid' => $this->session->get('id')
        ]);
    }

}