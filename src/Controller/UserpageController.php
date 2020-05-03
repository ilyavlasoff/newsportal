<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserpageController extends AbstractController
{
    public function display(Request $request, $id)
    {
        $manager = $this->getDoctrine()->getManager();
        $repos = $manager->getRepository(User::class);
        $user = $repos->find($id);
        if (!$user)
        {
            throw new NotFoundHttpException();
        }
        return $this->render('/pages/user_page.html.twig', [
            'user' => $user
        ]);
    }
}