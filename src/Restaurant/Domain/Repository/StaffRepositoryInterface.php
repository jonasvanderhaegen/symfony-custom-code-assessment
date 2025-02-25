<?php

declare(strict_types=1);

namespace App\Restaurant\Domain\Repository;

use App\Restaurant\Domain\Staff\Model\StaffId;
use App\Restaurant\Infrastructure\Entity\Staff;
use App\Restaurant\Infrastructure\Entity\Restaurant;

interface StaffRepositoryInterface
{
    public function save(Staff $staff): void;
    public function findById(StaffId $id): ?Staff;
    public function findByEmail(string $email): ?Staff;
    public function findByRestaurant(Restaurant $restaurant): array;
    public function findActiveByRole(Restaurant $restaurant, string $role): array;
    public function remove(Staff $staff): void;
} 