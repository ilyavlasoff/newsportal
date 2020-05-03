<?php

namespace App\Controller;

use App\Entity\AuthorRequests;
use App\Form\AuthorRequestsFormType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthorRequestController extends AbstractController
{
    public function create(Request $request)
    {
        $authorRequest = new AuthorRequests();
        $form = $this->createForm(AuthorRequestsFormType::class, $authorRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($authorRequest);
            $manager->flush();
            return new RedirectResponse($this->generateUrl('feed_page'));
        }
        return $this->render('/pages/author_request.html.twig', [
            'requestForm' => $form->createView()
        ]);
    }
}