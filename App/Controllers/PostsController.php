<?php 

namespace App\Controllers;

use App\Views\View;
use App\Models\Post;

class PostsController
{

    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function index($request, $response)
    {
        $posts = Post::paginate(2);
        return $this->view->render($response, 'posts.twig', compact('posts'));
    }

}