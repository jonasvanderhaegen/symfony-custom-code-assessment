<?php

declare(strict_types=1);

namespace App\Restaurant\Infrastructure\Repository;

use App\Restaurant\Domain\Menu\Model\MenuItemId;
use App\Restaurant\Domain\Repository\MenuItemRepositoryInterface;
use App\Restaurant\Infrastructure\Entity\MenuItem;
use App\Restaurant\Infrastructure\Entity\Restaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

#[AsRepository]
class MenuItemRepository extends ServiceEntityRepository implements MenuItemRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MenuItem::class);
    }

    public function save(MenuItem $menuItem): void
    {
        $this->_em->persist($menuItem);
        $this->_em->flush();
    }

    public function findById(MenuItemId $id): ?MenuItem
    {
        return $this->find($id->toString());
    }

    public function findByRestaurant(Restaurant $restaurant): array
    {
        return $this->findBy(['restaurant' => $restaurant]);
    }

    public function findAvailableByCategory(Restaurant $restaurant, string $category): array
    {
        return $this->createQueryBuilder('m')
            ->where('m.restaurant = :restaurant')
            ->andWhere('m.category = :category')
            ->andWhere('m.isAvailable = :isAvailable')
            ->setParameter('restaurant', $restaurant)
            ->setParameter('category', $category)
            ->setParameter('isAvailable', true)
            ->getQuery()
            ->getResult();
    }

    public function findSeasonalItems(Restaurant $restaurant): array
    {
        return $this->createQueryBuilder('m')
            ->where('m.restaurant = :restaurant')
            ->andWhere('m.isSeasonalItem = :isSeasonalItem')
            ->andWhere('m.isAvailable = :isAvailable')
            ->setParameter('restaurant', $restaurant)
            ->setParameter('isSeasonalItem', true)
            ->setParameter('isAvailable', true)
            ->getQuery()
            ->getResult();
    }

    public function remove(MenuItem $menuItem): void
    {
        $this->_em->remove($menuItem);
        $this->_em->flush();
    }
} 