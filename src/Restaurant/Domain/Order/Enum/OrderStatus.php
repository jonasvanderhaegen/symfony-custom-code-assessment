<?php

declare(strict_types=1);

namespace App\Restaurant\Domain\Order\Enum;

enum OrderStatus: string
{
    case CREATED = 'created';
    case PREPARING = 'preparing';
    case READY = 'ready';
    case DELIVERED = 'delivered';
    case CANCELLED = 'cancelled';
} 