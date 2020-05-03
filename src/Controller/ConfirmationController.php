<?php

namespace App\Controller;
use App\Entity\Confirmation;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ConfirmationController extends AbstractController
{
    public function create(Request $request, $user, $code)
    {
        $manager = $this->getDoctrine()->getManager();
        $actualConfirms = $manager->getRepository(Confirmation::class)->findOneBy(['forUser' => $user, 'key' => $code]);
        if (!$actualConfirms)
        {
            return $this->render('registration/confirmation_result.html.twig', [
                'success' => false,
                'message' => 'Activation code was used already or was expired'
            ]);
        }

        $storedUser = $manager->getRepository(User::class)->find($user);
        if ($storedUser)
        {
            $storedUser->setIsActivated(true);
            $manager->remove($actualConfirms);
            $manager->flush();
            return $this->render('registration/confirmation_result.html.twig', [
                'success' => true,
                'user' => $storedUser
            ]);
        }
        return $this->render('registration/success_confirmation.html.twig', [
            'success' => false,
            'message' => 'User was not found'
        ]);
    }
}