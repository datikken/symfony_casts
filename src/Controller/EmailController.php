<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class EmailController extends AbstractController
{
    #[Route('/email/send', name: 'test_email')]
    public function index(MailerInterface $mailer): Response
    {
        $email = (new TemplatedEmail())
            ->from('tikkenn@yandex.ru')
            ->to('tikken23@gmail.com')
            ->subject('Nice to meet you')
            ->htmlTemplate('email/index.html.twig');

        $mailer->send($email);

        $response = new Response('ok');
        return $response;
    }
}
