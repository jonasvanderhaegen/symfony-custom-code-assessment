<?php

declare(strict_types=1);

namespace App\Restaurant\Domain\Staff\Model;

final class StaffingRequirements
{
    /**
     * @param array<string, int> $roleRequirements
     */
    public function __construct(
        private readonly \DateTimeInterface $dateTime,
        private readonly array $roleRequirements,
        private readonly int $totalStaffNeeded
    ) {
    }

    public function getDateTime(): \DateTimeInterface
    {
        return $this->dateTime;
    }

    public function getRoleRequirements(): array
    {
        return $this->roleRequirements;
    }

    public function getTotalStaffNeeded(): int
    {
        return $this->totalStaffNeeded;
    }
} 