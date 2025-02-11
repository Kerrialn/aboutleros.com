<?php

namespace App\Repository;

use App\Entity\Artefact;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Artefact>
 */
class ArtefactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artefact::class);
    }

    public function save(Artefact $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Artefact $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return array<int, Artefact>
     */
    public function getMainCategories(): array
    {
        $qb = $this->createQueryBuilder('artefact');

        $qb->andWhere(
            $qb->expr()->isNull('artefact.artefact')
        );

        $qb->orderBy('artefact.title', 'ASC');

        return $qb->getQuery()->getResult();
    }

}
