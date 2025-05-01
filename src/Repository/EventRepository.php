<?php

namespace App\Repository;

use App\Entity\Event;
use App\Model\Item;
use Carbon\CarbonImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Order;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @extends ServiceEntityRepository<Event>
 *
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private readonly UrlGeneratorInterface $urlGenerator
    )
    {
        parent::__construct($registry, Event::class);
    }

    public function save(Event $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Event $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return array<int, Event>
     */
    public function findStartingSoon(): array
    {
        $qb = $this->createQueryBuilder('event');

        $now = CarbonImmutable::now();

        $qb->andWhere(
            $qb->expr()->gte('event.startAt', ':now')
        )
            ->setParameter('now', $now->toDateTimeImmutable())
            ->orderBy('event.startAt', Order::Ascending->value);

        return $qb->getQuery()->getResult();
    }

    /**
     * @return array<int, Item>
     */
    public function getHappeningSoonAsItems(): array
    {
        $qb = $this->createQueryBuilder('event');

        $now = CarbonImmutable::now();

        $qb->andWhere(
            $qb->expr()->gte('event.startAt', ':now')
        )
            ->setParameter('now', $now->toDateTimeImmutable())
            ->orderBy('event.startAt', Order::Ascending->value);

        /**
         * @var array<int,Event> $events
         */
        $events = $qb->getQuery()->getResult();
        $items = new ArrayCollection();
        foreach ($events as $event) {
            $items->add(
                new Item(
                    title: $event->getTitle(),
                    imagePath: "/uploads/business_images/67e82a17e1fad_WhatsApp Image 2024-12-08 at 15.14.03 (2).jpeg.jpg",
                    path: $this->urlGenerator->generate(name: 'show_event', parameters: ['id' => $event->getId()], referenceType: UrlGeneratorInterface::ABSOLUTE_URL ),
                )
            );
        }

        return $items->toArray();
    }


}
