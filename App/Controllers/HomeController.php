<?php 
namespace App\Controllers;

use App\Views\View;
use App\Controllers\Controller;
use App\Sessions\SessionInterface;

class HomeController extends Controller
{
 
    protected $view;
    protected $session;

    public function __construct(View $view, SessionInterface $session)
    {
        $this->view = $view;
        $this->session = $session;
    }

    public function index($request, $response)
    {
        return $this->view->render($response, 'home.twig', ['name' => 'Mahmoud']);
    }

    public function dashboard($request, $response)
    {
        return $this->view->render($response, 'dashboard.twig', [
            'userid' => $this->session->get('id')
        ]);
    }

}