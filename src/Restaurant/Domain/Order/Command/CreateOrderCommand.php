<?php

declare(strict_types=1);

namespace App\Restaurant\Domain\Order\Command;

final class CreateOrderCommand
{
    /**
     * @param array<string, mixed> $items
     */
    public function __construct(
        private readonly string $restaurantId,
        private readonly string $customerId,
        private readonly array $items,
        private readonly ?string $tableNumber = null,
        private readonly ?string $specialInstructions = null
    ) {
    }

    public function getRestaurantId(): string
    {
        return $this->restaurantId;
    }

    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getTableNumber(): ?string
    {
        return $this->tableNumber;
    }

    public function getSpecialInstructions(): ?string
    {
        return $this->specialInstructions;
    }
} 