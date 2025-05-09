<?php

namespace App\Repository;

use App\Entity\HistoricalEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Order;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HistoricalEvent>
 */
class HistoricalEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HistoricalEvent::class);
    }

    public function save(HistoricalEvent $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(HistoricalEvent $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return array<int, HistoricalEvent>
     */
    public function findAllByDate(): array
    {
        $qb = $this->createQueryBuilder('historical_event');
        $qb->orderBy('historical_event.startAt', Order::Descending->value);
        return $qb->getQuery()->getResult();
    }
}
