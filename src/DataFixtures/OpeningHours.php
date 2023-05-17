<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OpeningHours extends Fixture
{
    const weekFiveDays = [
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
    ];

    public function load(ObjectManager $manager): void
    {

        foreach (self::weekFiveDays as $day) {
            $openingHours = new \App\Entity\OpeningHours();
            $openingHours->setWeekDay($day);
            $openingHours->setAmOpen('0845');
            $openingHours->setAmClose(1200);
            $openingHours->setPmOpen(1400);
            $openingHours->setPmClose(1800);
            $openingHours->setCloseDay(false);

            $manager->persist($openingHours);
        }

        $openingHours = new \App\Entity\OpeningHours();
        $openingHours->setWeekDay('saturday');
        $openingHours->setAmOpen('0845');
        $openingHours->setAmClose(1200);
        $openingHours->setPmOpen(null);
        $openingHours->setPmClose(null);
        $openingHours->setCloseDay(false);

        $manager->persist($openingHours);

        $openingHours = new \App\Entity\OpeningHours();
        $openingHours->setWeekDay('sunday');
        $openingHours->setAmOpen(null);
        $openingHours->setAmClose(null);
        $openingHours->setPmOpen(null);
        $openingHours->setPmClose(null);
        $openingHours->setCloseDay(true);

        $manager->persist($openingHours);

        $manager->flush();

    }
}
