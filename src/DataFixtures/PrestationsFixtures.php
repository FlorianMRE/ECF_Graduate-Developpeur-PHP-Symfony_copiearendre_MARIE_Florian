<?php

namespace App\DataFixtures;

use App\Entity\Prestations;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PrestationsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $allPrestations = [
            [
                'title' => 'Vidange',
                'description' => 'Vidange complète de votre véhicule avec remise de certificat de réalisation et remise des différents fluides. Environ une 1/2 journé de travail'
            ],
            [
                'title' => 'Entretien',
                'description' => 'Entretien des différenst consommables et autres, parties mécaniques et roulements de votre véhicule. Environ 1 journée de travail'
            ],
            [
                'title' => 'Remplacement de courroie',
                'description' => 'Remplacement de courroie accessoire ou courroie de distribution, autant courroie que chaîne. Environ 1 journée de travail'
            ],
            [
                'title' => 'Remplacement des bougies',
                'description' => 'Remplacement des bougies, les quatres ou celles que vous voulez . Environ 1 journée de travail'
            ],
            [
                'title' => 'Nettoyage complet véhicule',
                'description' => 'Nettoyage complet de votre véhicule, de fond en comble, autant à l\'intérieur qu\' l\'extérieur, avec nos produits spécifiques ou les votres si vous le souhaitez, environ 1/2 journée'
            ],
            [
                'title' => 'Remplacement des pneus',
                'description' => 'Remplacements des pneus, les quatres d\'un coup ou alors possibilitée de chamgement que d\'un train de pneus, pour en savoir plus sur nos différents pneus vous pouvez venir sur site ou appeler pour savoir les marques et tailles disponibles. Environ 1/2 journée de travail'
            ],
            [
                'title' => 'Remplacement des plaquettes de frein',
                'description' => 'Remplacements des plaquettes de frein, pour les marques, vous pouvez appeler ou vous rendre sur site pour les découvrir. Environ 1 journée de travail'
            ],
        ];


        foreach ($allPrestations as $item) {
            $prestation = new Prestations();
            $prestation->setTitle($item['title'])->setDescription($item['description']);
            $manager->persist($prestation);
        }

        $manager->flush();
    }
}
