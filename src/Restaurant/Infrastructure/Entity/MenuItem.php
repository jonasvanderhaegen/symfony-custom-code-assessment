<?php

declare(strict_types=1);

namespace App\Restaurant\Infrastructure\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Entity representing a menu item.
 * This class contains properties and methods related to a menu item's data.
 */
#[ORM\Entity(repositoryClass: MenuItemRepository::class)]
#[ORM\Table(name: 'menu_items')]
#[ORM\Index(columns: ['category'], name: 'idx_menu_item_category')]
#[ORM\Index(columns: ['is_available'], name: 'idx_menu_item_availability')]
class MenuItem
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', unique: true)]
    private string $id; // Unique identifier for the menu item

    #[ORM\ManyToOne(targetEntity: Restaurant::class, inversedBy: 'menuItems')]
    #[ORM\JoinColumn(nullable: false)]
    private Restaurant $restaurant; // The restaurant associated with the menu item

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private string $name; // Name of the menu item

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null; // Description of the menu item

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    #[Assert\NotNull]
    private float $price; // Price of the menu item

    #[ORM\Column(type: 'json')]
    private array $allergens = []; // List of allergens associated with the menu item

    #[ORM\Column(type: 'json')]
    private array $ingredients = []; // List of ingredients in the menu item

    #[ORM\Column]
    private bool $isAvailable = true; // Indicates if the menu item is available

    #[ORM\Column(length: 50)]
    private string $category; // Category of the menu item (e.g., appetizer, main course)

    #[ORM\Column]
    private bool $isSeasonalItem = false; // Indicates if the menu item is seasonal

    public function __construct(string $id, Restaurant $restaurant, string $name, float $price, string $category)
    {
        $this->id = $id;
        $this->restaurant = $restaurant;
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
    }

    // Getters and setters for accessing and modifying properties
    public function getId(): string { return $this->id; }
    public function getRestaurant(): Restaurant { return $this->restaurant; }
    public function getName(): string { return $this->name; }
    public function setName(string $name): self { $this->name = $name; return $this; }
    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }
    public function getPrice(): float { return $this->price; }
    public function setPrice(float $price): self { $this->price = $price; return $this; }
    public function getAllergens(): array { return $this->allergens; }
    public function setAllergens(array $allergens): self { $this->allergens = $allergens; return $this; }
    public function getIngredients(): array { return $this->ingredients; }
    public function setIngredients(array $ingredients): self { $this->ingredients = $ingredients; return $this; }
    public function isAvailable(): bool { return $this->isAvailable; }
    public function setIsAvailable(bool $isAvailable): self { $this->isAvailable = $isAvailable; return $this; }
    public function getCategory(): string { return $this->category; }
    public function setCategory(string $category): self { $this->category = $category; return $this; }
    public function isSeasonalItem(): bool { return $this->isSeasonalItem; }
    public function setIsSeasonalItem(bool $isSeasonalItem): self { $this->isSeasonalItem = $isSeasonalItem; return $this; }
} 