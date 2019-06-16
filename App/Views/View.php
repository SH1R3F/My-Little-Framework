<?php 
namespace App\Views;

use Twig\Environment;

class View
{
    protected $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function make($view, $data)
    {
        return $this->twig->render($view, $data);
    }

    public function render($response, $view, $data = [])
    {
        $response->getBody()->write(
            $this->make($view, $data)
        );
        return $response;
    }

    public function share($data)
    {
        foreach ($data as $key => $value) {
            $this->twig->addGlobal($key, $value);
        }
    }

}