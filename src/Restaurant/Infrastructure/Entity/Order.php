<?php

declare(strict_types=1);

namespace App\Restaurant\Infrastructure\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entity representing an order.
 * This class contains properties and methods related to an order's data.
 */
#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: 'orders')]
#[ORM\Index(columns: ['status'], name: 'idx_order_status')]
#[ORM\Index(columns: ['created_at'], name: 'idx_order_created_at')]
class Order
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', unique: true)]
    private string $id; // Unique identifier for the order

    #[ORM\ManyToOne(targetEntity: Restaurant::class, inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private Restaurant $restaurant; // The restaurant associated with the order

    #[ORM\Column(length: 20)]
    private string $status; // Current status of the order (e.g., created, preparing, completed)

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $totalAmount; // Total amount for the order

    #[ORM\Column(type: 'json')]
    private array $items = []; // List of items in the order

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $tableNumber = null; // Optional table number for dine-in orders

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $specialInstructions = null; // Optional special instructions for the order

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt; // Timestamp when the order was created

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $completedAt = null; // Timestamp when the order was completed

    public function __construct(string $id, Restaurant $restaurant)
    {
        $this->id = $id;
        $this->restaurant = $restaurant;
        $this->createdAt = new \DateTimeImmutable();
        $this->status = 'created'; // Default status when the order is created
    }

    // Getters and setters for accessing and modifying properties
    public function getId(): string { return $this->id; }
    public function getRestaurant(): Restaurant { return $this->restaurant; }
    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }
    public function getTotalAmount(): float { return $this->totalAmount; }
    public function setTotalAmount(float $totalAmount): self { $this->totalAmount = $totalAmount; return $this; }
    public function getItems(): array { return $this->items; }
    public function setItems(array $items): self { $this->items = $items; return $this; }
    public function getTableNumber(): ?string { return $this->tableNumber; }
    public function setTableNumber(?string $tableNumber): self { $this->tableNumber = $tableNumber; return $this; }
    public function getSpecialInstructions(): ?string { return $this->specialInstructions; }
    public function setSpecialInstructions(?string $specialInstructions): self { $this->specialInstructions = $specialInstructions; return $this; }
    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }
    public function getCompletedAt(): ?\DateTimeImmutable { return $this->completedAt; }
    public function setCompletedAt(?\DateTimeImmutable $completedAt): self { $this->completedAt = $completedAt; return $this; }
    public function complete(): self { $this->status = 'completed'; $this->completedAt = new \DateTimeImmutable(); return $this; }
    public function cancel(): self { $this->status = 'cancelled'; return $this; }
}