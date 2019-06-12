<?php 

namespace App\Exceptions;

class Handler
{
    protected $exception;
    public function __construct(\Exception $exception)
    {
        $this->exception = $exception;
    }

    public function respond()
    {
        $exception = (new \ReflectionClass($this->exception))->getShortName();
        die($exception);
    }
}