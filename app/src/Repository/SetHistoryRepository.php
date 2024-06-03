<?php

namespace App\Repository;

use App\Entity\SetHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<SetHistory>
 */
class SetHistoryRepository extends ServiceEntityRepository
{
    private $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, SetHistory::class);
        $this->entityManager = $entityManager;
    }


    public function updateSetHistory($set, $user)
    {
        $setHistory = $this->findOneBy(['set' => $set, 'usr' => $user]);

        if (!$setHistory) {
            $setHistory = new SetHistory();
            $setHistory->setSet($set);
            $setHistory->setUsr($user);
        }

        $setHistory->setTimestamp(new \DateTime());

        $this->entityManager->persist($setHistory);
        $this->entityManager->flush();
    }


    public function getUserSetHistory($user)
    {
        return $this->createQueryBuilder('sh')
            ->andWhere('sh.usr = :user')
            ->setParameter('user', $user)
            ->orderBy('sh.timestamp', 'DESC')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return SetHistory[] Returns an array of SetHistory objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?SetHistory
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
