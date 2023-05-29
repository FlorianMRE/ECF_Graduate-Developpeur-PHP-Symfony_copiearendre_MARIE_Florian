<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\DateTime;

class OpeningHoursFixtures extends Fixture
{
    const weekFiveDays = [
        'lundi',
        'mardi',
        'mercredi',
        'jeudi',
        'vendredi',
    ];

    public function load(ObjectManager $manager): void
    {

        foreach (self::weekFiveDays as $day) {
            $openingHours = new \App\Entity\OpeningHours();
            $openingHours->setWeekDay($day);
            $openingHours->setAmOpen(new \DateTimeImmutable(date('H:i', mktime(8,45))));
            $openingHours->setAmClose(new \DateTimeImmutable(date('H:i', mktime(12,00))));
            $openingHours->setPmOpen(new \DateTimeImmutable(date('H:i', mktime(14,00))));
            $openingHours->setPmClose(new \DateTimeImmutable(date('H:i', mktime(18,00))));
            $openingHours->setCloseDay(false);

            $manager->persist($openingHours);
        }

        $openingHours = new \App\Entity\OpeningHours();
        $openingHours->setWeekDay('samedi');
        $openingHours->setAmOpen(new \DateTimeImmutable(date('H:i', mktime(8,45))));
        $openingHours->setAmClose(new \DateTimeImmutable(date('H:i', mktime(12,00))));
        $openingHours->setPmOpen(null);
        $openingHours->setPmClose(null);
        $openingHours->setCloseDay(false);

        $manager->persist($openingHours);

        $openingHours = new \App\Entity\OpeningHours();
        $openingHours->setWeekDay('dimanche');
        $openingHours->setAmOpen(null);
        $openingHours->setAmClose(null);
        $openingHours->setPmOpen(null);
        $openingHours->setPmClose(null);
        $openingHours->setCloseDay(true);

        $manager->persist($openingHours);

        $manager->flush();

    }
}
