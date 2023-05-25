<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{

    const type = [
        'scooter',
        'moto',
        'voiture',
        'camionnette',
        'camion',
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::type as $productstype) {
            $type = new Type();
            $type->setType($productstype);
            $manager->persist($type);
        }

        $manager->flush();
    }
}
