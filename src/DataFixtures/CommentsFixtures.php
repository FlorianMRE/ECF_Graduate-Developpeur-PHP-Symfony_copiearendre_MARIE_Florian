<?php

namespace App\DataFixtures;

use App\Entity\Comments;
use App\Entity\Products;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CommentsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $allProducts = $manager->getRepository(Products::class)->findAll();

        foreach ($allProducts as $product) {
            $comment = new Comments();



            $manager->persist($product);
        }


        $manager->flush();
    }
}
