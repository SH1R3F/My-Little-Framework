<?php

namespace App\Exceptions;

class ValidationException extends \Exception
{

    protected $errors;
    protected $request;

    public function __construct($request, array $errors)
    {
        $this->errors  = $errors;
        $this->request = $request;
    }

    public function getPath()
    {
        return $this->request->getUri()->getPath();
    }

    public function getOldInputs()
    {
        return $this->request->getParsedBody();
    }

    public function getErrors()
    {
        return $this->errors;
    }

}