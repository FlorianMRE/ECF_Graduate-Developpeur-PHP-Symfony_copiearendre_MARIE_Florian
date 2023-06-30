<?php

namespace App\DataFixtures;

use App\Entity\Opinion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OpinionsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $allOpinions = [
            [
                'email' => 'test@gmail.com',
                'lastname' => 'Marie',
                'firstname' => '',
                'comment' => 'Très bon garage avec une équipe au top',
                'note' => 9,
                'published' => true,
            ],
            [
                'email' => 'test2@gmail.com',
                'lastname' => 'Nevel',
                'firstname' => 'Patricia',
                'comment' => 'Bon Garage avec des prestations très bien réalisées',
                'note' => 6,
                'published' => true,
            ],
            [
                'email' => 'test3@gmail.com',
                'lastname' => 'Patrick',
                'firstname' => 'Patrick',
                'comment' => 'Toujours un plaisir de venir dans ce temple de la mécanique, toujours de bon conseil et avec le sourire. Je recommande fortement',
                'note' => 10,
                'published' => true,
            ],
            [
                'email' => 'test4@gmail.com',
                'lastname' => 'Galy',
                'firstname' => 'Marc',
                'comment' => 'Service de qualité avec de bons prix.',
                'note' => 8,
            ],
            [
                'email' => 'test5@gmail.com',
                'lastname' => 'Pach',
                'firstname' => 'Sylvain',
                'comment' => 'Voiture venue en panne et retrouvée en très bon état, de plus la réparation à était rapide et efficace. Un rand merci à toute l\'équipe',
                'note' => 8,
            ],
            [
                'email' => 'test6@gmail.com',
                'lastname' => 'Dipse',
                'firstname' => 'Robert',
                'comment' => 'Petit garage avec des bonne prestations.',
                'note' => 7,
            ],
        ];

        foreach ($allOpinions as $opinionItem) {
            $opinion = new Opinion();
            $opinion->setEmail($opinionItem['email'])
                ->setLastname($opinionItem['lastname'])
                ->setFirstname($opinionItem['firstname'])
                ->setComment($opinionItem['comment'])
                ->setNote($opinionItem['note'])
            ;

            $opinion->setCreatedAt(new \DateTimeImmutable());

            if (isset($opinionItem['published'])   && !is_null($opinionItem['published']) && $opinionItem['published'] === true) {
                $opinion->setPublishedAt(new \DateTimeImmutable());
            }

         $manager->persist($opinion);

        }

        $manager->flush();
    }
}
