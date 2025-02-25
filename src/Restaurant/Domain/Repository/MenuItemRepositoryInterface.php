<?php

declare(strict_types=1);

namespace App\Restaurant\Domain\Repository;

use App\Restaurant\Domain\Menu\Model\MenuItemId;
use App\Restaurant\Infrastructure\Entity\MenuItem;
use App\Restaurant\Infrastructure\Entity\Restaurant;

interface MenuItemRepositoryInterface
{
    public function save(MenuItem $menuItem): void;
    public function findById(MenuItemId $id): ?MenuItem;
    public function findByRestaurant(Restaurant $restaurant): array;
    public function findAvailableByCategory(Restaurant $restaurant, string $category): array;
    public function findSeasonalItems(Restaurant $restaurant): array;
    public function remove(MenuItem $menuItem): void;
} 