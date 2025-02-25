<?php

declare(strict_types=1);

namespace App\Restaurant\Infrastructure\Repository;

use App\Restaurant\Domain\Repository\TableRepositoryInterface;
use App\Restaurant\Infrastructure\Entity\Table;
use App\Restaurant\Infrastructure\Entity\Restaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

#[AsRepository]
class TableRepository extends ServiceEntityRepository implements TableRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Table::class);
    }

    public function save(Table $table): void
    {
        $this->_em->persist($table);
        $this->_em->flush();
    }

    public function findById(int $id): ?Table
    {
        return $this->find($id);
    }

    public function findByRestaurant(Restaurant $restaurant): array
    {
        return $this->findBy(['restaurant' => $restaurant, 'isActive' => true]);
    }

    public function findAvailableTables(Restaurant $restaurant): array
    {
        return $this->createQueryBuilder('t')
            ->where('t.restaurant = :restaurant')
            ->andWhere('t.status = :status')
            ->andWhere('t.isActive = :isActive')
            ->setParameter('restaurant', $restaurant)
            ->setParameter('status', 'available')
            ->setParameter('isActive', true)
            ->getQuery()
            ->getResult();
    }

    public function findByNumber(Restaurant $restaurant, string $number): ?Table
    {
        return $this->findOneBy([
            'restaurant' => $restaurant,
            'number' => $number,
            'isActive' => true
        ]);
    }

    public function remove(Table $table): void
    {
        $this->_em->remove($table);
        $this->_em->flush();
    }
} 