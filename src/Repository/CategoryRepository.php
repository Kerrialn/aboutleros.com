<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\User;
use App\Model\Item;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Order;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use function Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Category>
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry                        $registry,
        private readonly UrlGeneratorInterface $urlGenerator
    )
    {
        parent::__construct($registry, Category::class);
    }

    public function save(Category $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Category $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return array<int, Category>
     */
    public function getMainCategories(): array
    {
        $qb = $this->createQueryBuilder('category');
        $qb->orderBy('category.title', Order::Ascending->value);

        return $qb->getQuery()->getResult();
    }

    /**
     * @param string $slug
     * @return array<int, Item>
     */
    public function getCategoryBusinessesAsItems(string $slug): array
    {
        $qb = $this->createQueryBuilder('category');

        $qb->andWhere(
            $qb->expr()->eq('category.slug', ':slug')
        )->setParameter('slug', $slug);

        $category = $qb->getQuery()->getOneOrNullResult();

        $items = new ArrayCollection();
        foreach ($category->getBusinesses() as $business) {
            $items->add(
                new Item(
                    title: $business->getTitle(),
                    imagePath: "/uploads/business_images/{$business->getMainImage()->getFilename()}",
                    path: $this->urlGenerator->generate(name: 'show_business', parameters: ['slug' => $business->getSlug()], referenceType: UrlGeneratorInterface::ABSOLUTE_URL ),
                )
            );
        }

        return $items->toArray();
    }

}
