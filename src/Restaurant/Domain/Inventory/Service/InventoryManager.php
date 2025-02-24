<?php

declare(strict_types=1);

namespace App\Restaurant\Domain\Inventory\Service;

use App\Restaurant\Domain\Inventory\Command\StockUpdateCommand;
use App\Restaurant\Domain\Menu\Model\MenuItemId;
use App\Restaurant\Domain\Inventory\Model\Quantity;

interface InventoryManager
{
    public function updateStock(StockUpdateCommand $command): void;
    public function checkAvailability(MenuItemId $itemId, Quantity $quantity): bool;
    public function generateLowStockAlerts(): array;
} 