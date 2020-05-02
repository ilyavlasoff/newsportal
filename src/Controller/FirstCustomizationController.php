<?php

namespace App\Controller;

use App\Form\FirstCustomizationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

class FirstCustomizationController extends AbstractController
{
    public function customize(Request $request, SluggerInterface $slugger)
    {
        $form = $this->createForm(FirstCustomizationFormType::class);
        $form->handleRequest($request);
        $user = $this->getUser();
        if ($user && $form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $description = $form->get('description')->getData();
            if ($description)
            {
                $user->setDescription(htmlspecialchars(strip_tags($description)));
            }
            $pictureFile = $form->get('userPic')->getData();
            if ($pictureFile)
            {
                $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$pictureFile->guessExtension();
                try {
                    $pictureFile->move(
                        $this->getParameter('user_media_path'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $user->setUserPic($newFilename);
            }
            $manager->flush();
            return new RedirectResponse($this->generateUrl('feed_page'));
        }
        return $this->render('pages/profile_customize.html.twig', [
            'user' => $this->getUser(),
            'customizationForm' => $form->createView()
        ]);
    }
}