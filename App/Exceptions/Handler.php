<?php 

namespace App\Exceptions;

use App\Sessions\SessionInterface;

class Handler
{
    protected $exception;
    protected $session;

    public function __construct(\Exception $exception, SessionInterface $session){
        $this->exception = $exception;
        $this->session = $session;
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

    public function unhandledException(\Exception $exception)
    {
        die($exception->getMessage());
    }
}