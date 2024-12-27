<?php

namespace App\Repository;

use App\Entity\Item;
use App\Enum\ItemStatusEnum;
use App\Enum\ItemTypeEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Order;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Item>
 *
 * @method Item|null find($id, $lockMode = null, $lockVersion = null)
 * @method Item|null findOneBy(array $criteria, array $orderBy = null)
 * @method Item[]    findAll()
 * @method Item[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);
    }

    /**
     * @return array<int, Item>
     */
    public function getNewsItems() : array
    {
        $qb = $this->createQueryBuilder('item');

        $qb->andWhere(
            $qb->expr()->eq('item.itemTypeEnum', ':type')
        )->setParameter('type', ItemTypeEnum::NEWS);

        $qb->andWhere(
            $qb->expr()->eq('item.itemStatusEnum', ':status')
        )->setParameter('status', ItemStatusEnum::PUBLISHED);

        $qb->orderBy('item.createdAt', Order::Descending->value);

        return $qb->getQuery()->getResult();
    }


    /**
     * @return array<int, Item>
     */
    public function getEvents() : array
    {
        $qb = $this->createQueryBuilder('item');

        $qb->andWhere(
            $qb->expr()->eq('item.itemTypeEnum', ':type')
        )->setParameter('type', ItemTypeEnum::EVENT);

        $qb->andWhere(
            $qb->expr()->eq('item.itemTypeEnum', ':type')
        )->setParameter('type', ItemStatusEnum::PUBLISHED);

        $qb->orderBy('item.createdAt', Order::Descending->value);

        return $qb->getQuery()->getResult();
    }

}
