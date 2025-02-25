<?php

declare(strict_types=1);

namespace App\Restaurant\Infrastructure\Repository;

use App\Restaurant\Domain\Repository\RestaurantRepositoryInterface;
use App\Restaurant\Infrastructure\Entity\Restaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RestaurantRepository extends ServiceEntityRepository implements RestaurantRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Restaurant::class);
    }

    public function save(Restaurant $restaurant): void
    {
        $this->_em->persist($restaurant);
        $this->_em->flush();
    }

    public function findById(int $id): ?Restaurant
    {
        return $this->find($id);
    }

    public function findAll(): array
    {
        return parent::findAll();
    }

    public function findActive(): array
    {
        return $this->findBy(['isActive' => true]);
    }

    public function remove(Restaurant $restaurant): void
    {
        $this->_em->remove($restaurant);
        $this->_em->flush();
    }
} 