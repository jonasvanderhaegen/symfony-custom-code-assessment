<?php

declare(strict_types=1);

namespace App\Restaurant\Infrastructure\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TableRepository::class)]
#[ORM\Table(name: 'tables')]
class Table
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Restaurant::class, inversedBy: 'tables')]
    #[ORM\JoinColumn(nullable: false)]
    private Restaurant $restaurant;

    #[ORM\Column(length: 50)]
    private string $number;

    #[ORM\Column]
    private int $capacity;

    #[ORM\Column(length: 50)]
    private string $status = 'available';

    #[ORM\Column(length: 50)]
    private string $location;

    #[ORM\Column]
    private bool $isActive = true;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRestaurant(): Restaurant
    {
        return $this->restaurant;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;
        return $this;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;
        return $this;
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

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;
        return $this;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function markAsOccupied(): self
    {
        $this->status = 'occupied';
        return $this;
    }

    public function markAsAvailable(): self
    {
        $this->status = 'available';
        return $this;
    }

    public function markAsReserved(): self
    {
        $this->status = 'reserved';
        return $this;
    }
} 