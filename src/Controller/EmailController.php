<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;

class EmailController extends AbstractController
{
    #[Route('/email/send', name: 'test_email')]
    public function index(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('tikkenn@yandex.ru')
            ->to('tikken23@gmail.com')
            ->subject('Nice to meet you')
            ->text('Ya ya!');

        $mailer->send($email);

        $response = new Response('ok');
        return $response;
    }
}
