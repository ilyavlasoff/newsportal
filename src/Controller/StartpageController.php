<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StartpageController extends AbstractController
{
    public function display()
    {
        return $this->render('pages/feed.html.twig');
    }
}