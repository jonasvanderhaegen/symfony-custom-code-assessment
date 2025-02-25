<?php

declare(strict_types=1);

namespace App\Restaurant\Infrastructure\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Entity representing a table in a restaurant.
 * This class contains properties and methods related to a table's data.
 */
#[ORM\Entity(repositoryClass: TableRepository::class)]
#[ORM\Table(name: 'tables')]
class Table
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null; // Unique identifier for the table

    #[ORM\ManyToOne(targetEntity: Restaurant::class, inversedBy: 'tables')]
    #[ORM\JoinColumn(nullable: false)]
    private Restaurant $restaurant; // The restaurant associated with the table

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    private string $number; // Table number

    #[ORM\Column]
    #[Assert\NotNull]
    #[Assert\GreaterThan(0)]
    private int $capacity; // Seating capacity of the table

    #[ORM\Column(length: 50)]
    private string $status = 'available'; // Current status of the table (e.g., available, occupied, reserved)

    #[ORM\Column(length: 50)]
    private string $location; // Location of the table within the restaurant

    #[ORM\Column]
    private bool $isActive = true; // Indicates if the table is active

    public function __construct(
        Restaurant $restaurant,
        string $number,
        int $capacity,
        string $location
    ) {
        $this->restaurant = $restaurant;
        $this->number = $number;
        $this->capacity = $capacity;
        $this->location = $location;
    }

    // Getters and setters for accessing and modifying properties
    public function getId(): ?int { return $this->id; }
    public function getRestaurant(): Restaurant { return $this->restaurant; }
    public function getNumber(): string { return $this->number; }
    public function setNumber(string $number): self { $this->number = $number; return $this; }
    public function getCapacity(): int { return $this->capacity; }
    public function setCapacity(int $capacity): self { $this->capacity = $capacity; return $this; }
    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }
    public function getLocation(): string { return $this->location; }
    public function setLocation(string $location): self { $this->location = $location; return $this; }
    public function isActive(): bool { return $this->isActive; }
    public function setIsActive(bool $isActive): self { $this->isActive = $isActive; return $this; }
    public function markAsOccupied(): self { $this->status = 'occupied'; return $this; }
    public function markAsAvailable(): self { $this->status = 'available'; return $this; }
    public function markAsReserved(): self { $this->status = 'reserved'; return $this; }
}