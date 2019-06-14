<?php 

namespace App\Exceptions;

use App\Views\View;
use App\Sessions\SessionInterface;
use Psr\Http\Message\ResponseInterface;

class Handler
{
    protected $exception;
    protected $session;
    protected $response;
    protected $view;

    public function __construct(\Exception $exception, SessionInterface $session, ResponseInterface $response, View $view){
        $this->exception = $exception;
        $this->session = $session;
        $this->response = $response;
        $this->view = $view;
    }

    public function respond()
    {
        $exception = (new \ReflectionClass($this->exception))->getShortName();

        if (method_exists($this, $method = 'handle' . $exception)) {
            return $this->$method($this->exception);
        }
        return $this->unhandledException($this->exception);
    }

    public function handleValidationException(\Exception $exception)
    {
        $this->session->set([
            'errors' => $exception->getErrors(),
            'old'    => $exception->getOldInputs()
        ]);
        return redirect($exception->getPath());
    }

    public function handleCsrfTokenException(\Exception $exception)
    {
        return $this->view->render($this->response, 'errors/csrf.twig');
    }

    public function unhandledException(\Exception $exception)
    {
        throw $exception;
    }
}