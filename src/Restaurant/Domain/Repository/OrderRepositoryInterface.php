<?php

declare(strict_types=1);

namespace App\Restaurant\Domain\Repository;

use App\Restaurant\Domain\Order\Model\OrderId;
use App\Restaurant\Infrastructure\Entity\Order;
use App\Restaurant\Infrastructure\Entity\Restaurant;

interface OrderRepositoryInterface
{
    public function save(Order $order): void;
    public function findById(OrderId $id): ?Order;
    public function findByRestaurant(Restaurant $restaurant): array;
    public function findPendingOrders(Restaurant $restaurant): array;
    public function remove(Order $order): void;
} 