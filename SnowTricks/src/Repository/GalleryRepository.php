<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\Gallery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


/**
 * @method Gallery|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gallery|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gallery[]    findAll()
 * @method Gallery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GalleryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Gallery::class);
    }

public function findGalleryByArticleId(int $articleId){

     $this->createQueryBuilder('g')
         ->innerJoin('App\Entity\Article','a','WITH' , 'a = g.article')
        ->andWhere('g.article = :articleId')
        ->setParameter(':articleId' , $articleId)
        ->getQuery()
        ->getResult()

        ;
    return $this;
}


    // /**
    //  * @return Gallery[] Returns an array of Gallery objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gallery
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
