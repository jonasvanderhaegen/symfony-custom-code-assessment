<?php

declare(strict_types=1);

namespace App\Restaurant\Domain\Inventory\Command;

use App\Restaurant\Domain\Inventory\Model\Quantity;
use App\Restaurant\Domain\Menu\Model\MenuItemId;

final class StockUpdateCommand
{
    public function __construct(
        private readonly string $restaurantId,
        private readonly MenuItemId $itemId,
        private readonly Quantity $quantity,
        private readonly string $reason
    ) {
    }

    public function getRestaurantId(): string
    {
        return $this->restaurantId;
    }

    public function getItemId(): MenuItemId
    {
        return $this->itemId;
    }

    public function getQuantity(): Quantity
    {
        return $this->quantity;
    }

    public function getReason(): string
    {
        return $this->reason;
    }
} 