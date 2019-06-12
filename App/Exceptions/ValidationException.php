<?php

namespace App\Exceptions;

class ValidationException extends \Exception
{

    protected $errors;

    public function __construct(array $errors)
    {
        $this->errors = $errors;
    }

    public function getPath()
    {
        //
    }

    public function getErrors()
    {
        return $this->errors;
    }

}