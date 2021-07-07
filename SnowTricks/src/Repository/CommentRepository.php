<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use http\Exception\InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Comment::class);
    }
    public function findComment($slug,$currentPage)
    {
        return $this->createQueryBuilder('c')
            ->where('c.article = :article')
            ->setParameter(':article', $slug)
            ->setFirstResult(($currentPage-1)*10)
            ->setMaxResults('10')
            ->orderBy('c.commentDate', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }
    public function findCountPageNumber($slug)
    {
        return $this->createQueryBuilder('c')
            ->select('COUNT(c.id)')
            ->where('c.article = :article')
            ->setParameter(':article', $slug)
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }
}
