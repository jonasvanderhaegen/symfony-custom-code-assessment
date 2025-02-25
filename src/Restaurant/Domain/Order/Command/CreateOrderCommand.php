<?php

declare(strict_types=1);

namespace App\Restaurant\Domain\Order\Command;

/**
 * Command class for creating a new order.
 * This class encapsulates all the necessary data required to create an order.
 */
final class CreateOrderCommand
{
    /**
     * @param array<string, mixed> $items - The items being ordered, including details like item IDs and quantities.
     */
    public function __construct(
        private readonly string $restaurantId, // ID of the restaurant where the order is placed
        private readonly string $customerId,   // ID of the customer placing the order
        private readonly array $items,          // List of items in the order
        private readonly ?string $tableNumber = null, // Optional table number for dine-in orders
        private readonly ?string $specialInstructions = null // Optional special instructions for the order
    ) {
    }

    // Getters for accessing the command properties
    public function getRestaurantId(): string { return $this->restaurantId; }
    public function getCustomerId(): string { return $this->customerId; }
    public function getItems(): array { return $this->items; }
    public function getTableNumber(): ?string { return $this->tableNumber; }
    public function getSpecialInstructions(): ?string { return $this->specialInstructions; }
}