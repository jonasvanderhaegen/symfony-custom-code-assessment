<?php

declare(strict_types=1);

namespace App\Restaurant\Infrastructure\Repository;

use App\Restaurant\Domain\Order\Model\OrderId;
use App\Restaurant\Domain\Repository\OrderRepositoryInterface;
use App\Restaurant\Infrastructure\Entity\Order;
use App\Restaurant\Infrastructure\Entity\Restaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

#[AsRepository]
class OrderRepository extends ServiceEntityRepository implements OrderRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function save(Order $order): void
    {
        $this->_em->persist($order);
        $this->_em->flush();
    }

    public function findById(OrderId $id): ?Order
    {
        return $this->find($id->toString());
    }

    public function findByRestaurant(Restaurant $restaurant): array
    {
        return $this->findBy(['restaurant' => $restaurant]);
    }

    public function findPendingOrders(Restaurant $restaurant): array
    {
        return $this->createQueryBuilder('o')
            ->where('o.restaurant = :restaurant')
            ->andWhere('o.status IN (:statuses)')
            ->setParameter('restaurant', $restaurant)
            ->setParameter('statuses', ['created', 'preparing'])
            ->orderBy('o.createdAt', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function remove(Order $order): void
    {
        $this->_em->remove($order);
        $this->_em->flush();
    }
} 