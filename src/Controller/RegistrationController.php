<?php

namespace App\Controller;

use App\Entity\Confirmation;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\UserAuthenticator;
use App\Service\RandomCodeGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use App\Service\Mailer;

class RegistrationController extends AbstractController
{
    public function register(Mailer $mailer, Request $request, UserPasswordEncoderInterface $passwordEncoder,
                             GuardAuthenticatorHandler $guardHandler, UserAuthenticator $authenticator): Response
    {
        if ($this->getUser())
        {
            $this->redirectToRoute('feed_page');
        }
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->setRoles([User::roleUser]);
            $user->setUserPic($this->getParameter('default_userpic'));
            $user->setIsActivated(false);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);

            $confirmationCode = (new RandomCodeGenerator)->GetRandomCode(64);
            $confirmation = new Confirmation($user, $confirmationCode, 1, 1, 1);
            $entityManager->persist($confirmation);
            $entityManager->flush();

            $mailer->sendConfirmation($user, $confirmationCode);

            $request->request->add(['reg' => true]);
            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView()
        ]);
    }

}
