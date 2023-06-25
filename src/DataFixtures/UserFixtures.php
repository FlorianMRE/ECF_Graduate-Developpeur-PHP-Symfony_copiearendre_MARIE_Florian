<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    )
    {
    }

    public function load(ObjectManager $manager): void
    {

        $admin = new User();
        $admin->setGender('male')
            ->setEmail('V.Parrot@gmail.com')
            ->setFirstname('Vincent')
            ->setLastname('Parrot')
            ->setPhoneTel('0606060606')
            ->setPassword('Qwerty!!123')
            ->setRoles(["ROLE_ADMIN", "ROLE_USER"])
        ;
        $plaintextPassword = $admin->getPassword();

        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            $plaintextPassword
        );

        $admin->setCreatedAt(new \DateTimeImmutable());

        $admin->setPassword($hashedPassword);

        $manager->persist($admin);

        $moderator = new User();

        $moderator->setGender('female')
            ->setEmail('Stephanie.plart@gmail.com')
            ->setFirstname('Stéphanie')
            ->setLastname('Plart')
            ->setPhoneTel('0707070707')
            ->setPassword('Qwerty!!123')
            ->setRoles(["ROLE_MODERATOR", "ROLE_USER"])
        ;
        $plaintextPassword = $moderator->getPassword();

        $hashedPassword = $this->passwordHasher->hashPassword(
            $moderator,
            $plaintextPassword
        );

        $moderator->setCreatedAt(new \DateTimeImmutable());

        $moderator->setPassword($hashedPassword);

        $manager->persist($moderator);



        $manager->flush();

    }
}