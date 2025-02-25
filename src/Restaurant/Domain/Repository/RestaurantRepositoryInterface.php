<?php

declare(strict_types=1);

namespace App\Restaurant\Domain\Repository;

use App\Restaurant\Infrastructure\Entity\Restaurant;

interface RestaurantRepositoryInterface
{
    public function save(Restaurant $restaurant): void;
    public function findById(int $id): ?Restaurant;
    public function findAll(): array;
    public function findActive(): array;
    public function remove(Restaurant $restaurant): void;
} 