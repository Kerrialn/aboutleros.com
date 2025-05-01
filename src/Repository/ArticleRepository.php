<?php

namespace App\Repository;

use App\Entity\Article;
use App\Enum\ItemStatusEnum;
use App\Enum\ItemTypeEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Order;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @return array<int, Article>
     */
    public function getNewsItems(): array
    {
        $qb = $this->createQueryBuilder('article');
        $qb->orderBy('article.createdAt', Order::Descending->value);

        return $qb->getQuery()->getResult();
    }

    /**
     * @return array<int, Article>
     */
    public function getEvents(): array
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
