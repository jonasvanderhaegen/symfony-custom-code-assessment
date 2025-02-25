<?php

declare(strict_types=1);

namespace App\Restaurant\Domain\Inventory\Model;

final class Quantity
{
    private function __construct(
        private readonly float $amount,
        private readonly string $unit
    ) {
    }

    public static function create(float $amount, string $unit): self
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException('Quantity amount cannot be negative');
        }

        return new self($amount, $unit);
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function add(self $other): self
    {
        if ($this->unit !== $other->unit) {
            throw new \InvalidArgumentException('Cannot add quantities with different units');
        }

        return new self($this->amount + $other->amount, $this->unit);
    }

    public function subtract(self $other): self
    {
        if ($this->unit !== $other->unit) {
            throw new \InvalidArgumentException('Cannot subtract quantities with different units');
        }

        return new self($this->amount - $other->amount, $this->unit);
    }
} 