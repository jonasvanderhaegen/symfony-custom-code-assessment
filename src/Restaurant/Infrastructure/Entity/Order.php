<?php

declare(strict_types=1);

namespace App\Restaurant\Infrastructure\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: 'orders')]
#[ORM\Index(columns: ['status'], name: 'idx_order_status')]
#[ORM\Index(columns: ['created_at'], name: 'idx_order_created_at')]
class Order
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', unique: true)]
    private string $id;

    #[ORM\ManyToOne(targetEntity: Restaurant::class, inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private Restaurant $restaurant;

    #[ORM\Column(length: 20)]
    private string $status;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $totalAmount;

    #[ORM\Column(type: 'json')]
    private array $items = [];

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $tableNumber = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $specialInstructions = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $completedAt = null;

    public function __construct(string $id, Restaurant $restaurant)
    {
        $this->id = $id;
        $this->restaurant = $restaurant;
        $this->createdAt = new \DateTimeImmutable();
        $this->status = 'created';
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getRestaurant(): Restaurant
    {
        return $this->restaurant;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    public function setTotalAmount(float $totalAmount): self
    {
        $this->totalAmount = $totalAmount;
        return $this;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }

    public function getTableNumber(): ?string
    {
        return $this->tableNumber;
    }

    public function setTableNumber(?string $tableNumber): self
    {
        $this->tableNumber = $tableNumber;
        return $this;
    }

    public function getSpecialInstructions(): ?string
    {
        return $this->specialInstructions;
    }

    public function setSpecialInstructions(?string $specialInstructions): self
    {
        $this->specialInstructions = $specialInstructions;
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getCompletedAt(): ?\DateTimeImmutable
    {
        return $this->completedAt;
    }

    public function setCompletedAt(?\DateTimeImmutable $completedAt): self
    {
        $this->completedAt = $completedAt;
        return $this;
    }

    public function complete(): self
    {
        $this->status = 'completed';
        $this->completedAt = new \DateTimeImmutable();
        return $this;
    }

    public function cancel(): self
    {
        $this->status = 'cancelled';
        return $this;
    }
} 