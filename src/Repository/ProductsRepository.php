<?php

namespace App\Repository;

use App\Entity\Products;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Products>
 *
 * @method Products|null find($id, $lockMode = null, $lockVersion = null)
 * @method Products|null findOneBy(array $criteria, array $orderBy = null)
 * @method Products[]    findAll()
 * @method Products[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Products::class);
    }

    public function save(Products $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Products $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getProductsLinstingByFilters($options)
    {
        $q = $this->createQueryBuilder('p');

        if (!empty($options['type'])) {
            $q->andWhere('p.type IN(:type)')
                ->setParameter('type', array_values($options['type']));
        }

        if (isset($options['price-min']) && !empty($options['price-min'])) {
            $q->andWhere(
                $q->expr()->gte('p.price', ((int) $options['price-min'] * 100))
            );
        }
        if (isset($options['price-max']) && !empty($options['price-max'])) {
            $q->andWhere(
                $q->expr()->lte('p.price', ((int) $options['price-max'] * 100))
            );
        }

        if (isset($options['km-min']) && !empty($options['km-min'])) {
            $q->andWhere(
                $q->expr()->gte('p.kilometrages', ((int) $options['km-min']))
            );
        }
        if (isset($options['km-max']) && !empty($options['km-max'])) {
            $q->andWhere(
                $q->expr()->lte('p.kilometrages', ((int) $options['km-max']))
            );
        }

        if (isset($options['releaseYear-min']) && !empty($options['releaseYear-min'])) {
            $q->andWhere(
                $q->expr()->gte('p.years_of_release', ((int) $options['releaseYear-min']))
            );
        }
        if (isset($options['releaseYear-max']) && !empty($options['releaseYear-max'])) {
            $q->andWhere(
                $q->expr()->lte('p.years_of_release', ((int) $options['releaseYear-max']))
            );
        }

        if (array_key_exists('order', $options) || !empty($options['order'])) {
            if (str_contains($options['order'], 'name_')) {
                $order = substr($options['order'], strpos($options['order'], "_") +1, null);
                $q->orderBy('p.title', $order);
            } elseif (str_contains($options['order'], 'price_')) {
                $order = substr($options['order'], strpos($options['order'], "_") +1, null);
                $q->orderBy('p.price', $order);
            }
        }



        return $q->getQuery()->getResult();
    }

//    /**
//     * @return Products[] Returns an array of Products objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Products
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
