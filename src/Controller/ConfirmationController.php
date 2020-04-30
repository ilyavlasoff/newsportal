<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ConfirmationController extends AbstractController
{
    public function create(Request $request)
    {
        return $this->render('registration/success_confirmation.html.twig', [

        ]);
    }
}