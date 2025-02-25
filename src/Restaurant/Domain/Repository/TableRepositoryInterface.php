<?php

declare(strict_types=1);

namespace App\Restaurant\Domain\Repository;

use App\Restaurant\Infrastructure\Entity\Table;
use App\Restaurant\Infrastructure\Entity\Restaurant;

interface TableRepositoryInterface
{
    public function save(Table $table): void;
    public function findById(int $id): ?Table;
    public function findByRestaurant(Restaurant $restaurant): array;
    public function findAvailableTables(Restaurant $restaurant): array;
    public function findByNumber(Restaurant $restaurant, string $number): ?Table;
    public function remove(Table $table): void;
} 