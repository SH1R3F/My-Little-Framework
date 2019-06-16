<?php 

namespace App\Views;

class ViewPaginatorFactory
{

    protected $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function make($view, $data = [])
    {
        $this->rendered = $this->view->make($view, $data);
        return $this;
    }

    public function render()
    {
        return $this->rendered;
    }

}