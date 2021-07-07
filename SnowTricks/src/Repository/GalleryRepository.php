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

    public function changeMainPicture($id)
    {
        $qb = $this->createQueryBuilder('mainPicture');
        $qb ->update(Gallery::class,'g')
            ->andWhere('g.id = '.$id)
            -> set('g.mainPicture', 1)
        ;
        $qb->getQuery()->execute();
    }
    public function looseMainPicture($articleid)
    {
        $qb = $this->createQueryBuilder('mainPicture');
        $qb ->update(Gallery::class,'g')
            ->andWhere('g.mainPicture = 1 ')
            ->andWhere('g.article = '.$articleid)
            -> set('g.mainPicture', 0)
        ;
        $qb->getQuery()->execute();
    }

}
