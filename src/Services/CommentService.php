<?php

namespace App\Services;

use App\Entity\Comments;
use App\Entity\Products;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class CommentService
{


    public function __construct(private EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function commentFormSubmit(
        Comments $comments,
        User $user,
        Products $product
    ) :void
    {
        $comments->setCreatedAt(new \DateTimeImmutable());
        $comments->setUser($user);
        $comments->setProduct($product);

        $this->em->persist($comments);
        $this->em->flush();
    }
}