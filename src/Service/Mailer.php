<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;


class Mailer
{
    /**
     * @var Mailer
     */
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendConfirmation(User $user)
    {
        $email = new TemplatedEmail();
        $email
            ->from('noreply@newsportal.com')
            ->to($user->getEmail())
            ->subject('Registration confirmation')
            ->htmlTemplate('registration/confirm.html.twig')
            ->context([
                'user' => $user
            ]);
        $this->mailer->send($email);
    }
}