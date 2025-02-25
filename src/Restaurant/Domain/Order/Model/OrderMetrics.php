<?php

declare(strict_types=1);

namespace App\Restaurant\Domain\Order\Model;

final class OrderMetrics
{
    public function __construct(
        private readonly float $totalAmount,
        private readonly int $preparationTimeInMinutes,
        private readonly int $itemCount,
        private readonly array $itemMetrics
    ) {
    }

    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    public function getPreparationTimeInMinutes(): int
    {
        return $this->preparationTimeInMinutes;
    }

    public function getItemCount(): int
    {
        return $this->itemCount;
    }

    public function getItemMetrics(): array
    {
        return $this->itemMetrics;
    }
} 