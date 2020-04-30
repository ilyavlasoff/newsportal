<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthorRequestController extends AbstractController
{
    public function create(Request $request)
    {
        return $this->render('/pages/author_request.html.twig');
    }
}