<?php

declare(strict_types=1);

namespace App\Restaurant\Infrastructure\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuItemRepository::class)]
#[ORM\Table(name: 'menu_items')]
#[ORM\Index(columns: ['category'], name: 'idx_menu_item_category')]
#[ORM\Index(columns: ['is_available'], name: 'idx_menu_item_availability')]
class MenuItem
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', unique: true)]
    private string $id;

    #[ORM\ManyToOne(targetEntity: Restaurant::class, inversedBy: 'menuItems')]
    #[ORM\JoinColumn(nullable: false)]
    private Restaurant $restaurant;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private float $price;

    #[ORM\Column(type: 'json')]
    private array $allergens = [];

    #[ORM\Column(type: 'json')]
    private array $ingredients = [];

    #[ORM\Column]
    private bool $isAvailable = true;

    #[ORM\Column(length: 50)]
    private string $category;

    #[ORM\Column]
    private bool $isSeasonalItem = false;

    public function __construct(string $id, Restaurant $restaurant, string $name, float $price, string $category)
    {
        $this->id = $id;
        $this->restaurant = $restaurant;
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getRestaurant(): Restaurant
    {
        return $this->restaurant;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getAllergens(): array
    {
        return $this->allergens;
    }

    public function setAllergens(array $allergens): self
    {
        $this->allergens = $allergens;
        return $this;
    }

    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    public function setIngredients(array $ingredients): self
    {
        $this->ingredients = $ingredients;
        return $this;
    }

    public function isAvailable(): bool
    {
        return $this->isAvailable;
    }

    public function setIsAvailable(bool $isAvailable): self
    {
        $this->isAvailable = $isAvailable;
        return $this;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function isSeasonalItem(): bool
    {
        return $this->isSeasonalItem;
    }

    public function setIsSeasonalItem(bool $isSeasonalItem): self
    {
        $this->isSeasonalItem = $isSeasonalItem;
        return $this;
    }
} 