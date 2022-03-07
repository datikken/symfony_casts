<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;

class Mailer
{
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendBasicEmail($email)
    {
        $this->mailer->send($email);

        $response = new Response("Email has been sent");
        return $response;
    }
}