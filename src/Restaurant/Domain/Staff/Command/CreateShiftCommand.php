<?php

declare(strict_types=1);

namespace App\Restaurant\Domain\Staff\Command;

final class CreateShiftCommand
{
    public function __construct(
        private readonly string $restaurantId,
        private readonly \DateTimeInterface $startTime,
        private readonly \DateTimeInterface $endTime,
        private readonly string $role,
        private readonly int $requiredStaff
    ) {
    }

    public function getRestaurantId(): string
    {
        return $this->restaurantId;
    }

    public function getStartTime(): \DateTimeInterface
    {
        return $this->startTime;
    }

    public function getEndTime(): \DateTimeInterface
    {
        return $this->endTime;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getRequiredStaff(): int
    {
        return $this->requiredStaff;
    }
} 