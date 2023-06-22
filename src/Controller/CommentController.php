<?php

namespace App\Controller;

use App\Entity\Comments;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/comment/published/{id}', name: 'app_comment_validate')]
    public function validate(
        Comments $comment,
        EntityManagerInterface $em
    ): Response
    {
        $comment->setPublishedAt(new \DateTimeImmutable());

        $em->persist($comment);
        $em->flush();

        return $this->redirectToRoute('app_product_buy_show', ['slug' => $comment->getProduct()->getSlug()]);
    }
}
