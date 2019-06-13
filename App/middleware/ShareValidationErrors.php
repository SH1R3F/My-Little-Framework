<?php 

namespace App\middleware;

use App\Views\View;
use App\Sessions\SessionInterface;

class ShareValidationErrors
{
    protected $view;
    protected $session;

    public function __construct(View $view, SessionInterface $session)
    {
        $this->view = $view;
        $this->session = $session;
    }

    public function __invoke($request, $response, callable $next)
    {
        $this->view->share([
            'errors' => $this->session->get('errors', []),
            'old' => $this->session->get('old', [])
        ]);
        return $next($request, $response);
    }
}