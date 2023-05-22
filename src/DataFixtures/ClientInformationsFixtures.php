<?php

namespace App\DataFixtures;

use App\Entity\ClientInformations;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClientInformationsFixtures extends Fixture
{
    const clientInformations = [
        'tel' => '0520103465',
        'history' => 'Le garage V. Parrot vous accueil depuis plus de 15 ans à Toulouse avec la touche de professionnalisme qu\'il faut pour votre véhicule',
        'description' => 'Le garage vous propose différent types de prestations qui vont de la simple vidange à la pose d\'un covering particulier, en passant bien sûr par le contrôle technique ou les différentes réparations. Toutes ces prestations sont effectuer avec le sourire et un accueil inchangé depuis la création de ce lieu de vie automobile',
        'address_number' => 10,
        'address_street' => 'Rue de la nation',
        'address_zipcode' => 31000,
        'address_city' => 'Toulouse',
        'client_lastname' => 'Parrot',
        'enterprise_name' => 'Garage V. Parrot',
        'siret_number' => 42894526500018,
    ];


    public function load(ObjectManager $manager): void
    {
         $clientInformations = new ClientInformations();

         $clientInformations->setTel(self::clientInformations['tel']);
         $clientInformations->setHistory(self::clientInformations['history']);
         $clientInformations->setDescription(self::clientInformations['description']);
         $clientInformations->setAddressNumber(self::clientInformations['address_number']);
         $clientInformations->setAddressStreet(self::clientInformations['address_street']);
         $clientInformations->setAddressZipcode(self::clientInformations['address_zipcode']);
         $clientInformations->setAddressCity(self::clientInformations['address_city']);
         $clientInformations->setClientLastname(self::clientInformations['client_lastname']);
         $clientInformations->setEntrepriseName(self::clientInformations['enterprise_name']);
         $clientInformations->setSiretNumber(self::clientInformations['siret_number']);

         $manager->persist($clientInformations);

        $manager->flush();
    }
}
