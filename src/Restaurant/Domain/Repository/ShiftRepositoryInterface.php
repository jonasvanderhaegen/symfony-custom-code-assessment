<?php

declare(strict_types=1);

namespace App\Restaurant\Domain\Repository;

use App\Restaurant\Domain\Staff\Model\ShiftId;
use App\Restaurant\Infrastructure\Entity\Shift;
use App\Restaurant\Infrastructure\Entity\Staff;

interface ShiftRepositoryInterface
{
    public function save(Shift $shift): void;
    public function findById(ShiftId $id): ?Shift;
    public function findByStaff(Staff $staff): array;
    public function findActiveShifts(): array;
    public function remove(Shift $shift): void;
} 