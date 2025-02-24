<?php

declare(strict_types=1);

namespace App\Restaurant\Domain\Order\Event;

interface OrderEventHandler
{
    public function handleOrderCreated(OrderCreatedEvent $event): void;
    public function handleOrderCompleted(OrderCompletedEvent $event): void;
    public function handleOrderCancelled(OrderCancelledEvent $event): void;
} 