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

    public function sendConfirmation(User $user, String $code)
    {
        $email = new TemplatedEmail();
        $email
            ->from('tatiyanabelkina@mail.ru')
            ->to($user->getEmail())
            ->subject('Registration confirmation')
            ->htmlTemplate('pages/confirm.html.twig')
            ->context([
                'user' => $user,
                'code' => $code
            ]);
        $this->mailer->send($email);
    }
}