<?php

namespace App\Services;

use App\Entity\ContactMail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class ContactMailService
{
    public function __construct(
        private MailerInterface $mailer,
        private EntityManagerInterface $em,
    )
    {
    }

    public function sendEmail(
        ContactMail $contactMail,
        bool $product = true
    ): void
    {

        $email = (new TemplatedEmail())
            ->from('garage-parrot-site@garage-parrot.flo-le-codeur.fr')
            ->to('garage-parrot-site@garage-parrot.flo-le-codeur.fr');
        if ($product) {
            $email->subject('Message pour ' . $contactMail->getProduct()->getTitle())
            ->htmlTemplate('emailTemplate/contactEmail.html.twig');
        } else {
            $email->subject('Message de ' . $contactMail->getEmail())
            ->htmlTemplate('emailTemplate/contactEmailWithoutProduct.html.twig');
        };


            $email->context([
                'contactEmail' => $contactMail,
            ]);

        $this->mailer->send($email);

        $contactMail->setCreatedAt(new \DateTimeImmutable());

        $this->em->persist($contactMail);
        $this->em->flush();
    }
}