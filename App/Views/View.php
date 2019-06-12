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

    public function render($response, $view, $data = [])
    {
        $response->getBody()->write(
            $this->twig->render($view, $data)
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