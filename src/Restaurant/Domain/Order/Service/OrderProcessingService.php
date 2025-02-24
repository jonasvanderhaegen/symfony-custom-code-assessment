<?php

declare(strict_types=1);

namespace App\Restaurant\Domain\Order\Service;

use App\Restaurant\Domain\Order\Command\CreateOrderCommand;
use App\Restaurant\Domain\Order\Model\OrderId;
use App\Restaurant\Domain\Order\Model\OrderStatus;
use App\Restaurant\Domain\Order\Model\OrderMetrics;

interface OrderProcessingService
{
    public function createOrder(CreateOrderCommand $command): OrderId;
    public function updateOrderStatus(OrderId $orderId, OrderStatus $status): void;
    public function assignToKitchenQueue(OrderId $orderId): void;
    public function calculateOrderMetrics(OrderId $orderId): OrderMetrics;
} 