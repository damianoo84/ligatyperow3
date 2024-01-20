<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Comment>
 *
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    // pobranie komentarzy po ID sezonu
    public function getCommentsBySeason($season) : array
    {
        $qb = $this->createQueryBuilder('c');
        $qb->select(
            'c.text AS text'
            ,'c.created AS createdAt'
            ,'s.id AS season_id'
            ,'u.username AS username'
        )
            ->innerJoin('c.season', 's')
            ->innerJoin('c.user', 'u')
            ->where('s.id = :season')
            ->setParameter('season', $season)
            ->orderBy('c.id','DESC')
        ;

        $result = $qb->getQuery()->getResult();
//        exit(\Doctrine\Common\Util\Debug::dump($result));

        return $result;

    }
    
//    /**
//     * @return Comment[] Returns an array of Comment objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Comment
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
