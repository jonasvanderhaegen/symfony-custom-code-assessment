<?php

declare(strict_types=1);

namespace App\Restaurant\Infrastructure\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RestaurantRepository::class)]
#[ORM\Table(name: 'restaurants')]
class Restaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private string $name;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private string $address;

    #[ORM\Column]
    private bool $isActive = true;

    #[ORM\OneToMany(mappedBy: 'restaurant', targetEntity: Order::class)]
    private Collection $orders;

    #[ORM\OneToMany(mappedBy: 'restaurant', targetEntity: MenuItem::class)]
    private Collection $menuItems;

    #[ORM\OneToMany(mappedBy: 'restaurant', targetEntity: Staff::class)]
    private Collection $staff;

    #[ORM\OneToMany(mappedBy: 'restaurant', targetEntity: Table::class)]
    private Collection $tables;

    public function __construct(string $name, string $address)
    {
        $this->name = $name;
        $this->address = $address;
        $this->orders = new ArrayCollection();
        $this->menuItems = new ArrayCollection();
        $this->staff = new ArrayCollection();
        $this->tables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;
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

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
        }
        return $this;
    }

    public function removeOrder(Order $order): self
    {
        $this->orders->removeElement($order);
        return $this;
    }

    /**
     * @return Collection<int, MenuItem>
     */
    public function getMenuItems(): Collection
    {
        return $this->menuItems;
    }

    public function addMenuItem(MenuItem $menuItem): self
    {
        if (!$this->menuItems->contains($menuItem)) {
            $this->menuItems->add($menuItem);
        }
        return $this;
    }

    public function removeMenuItem(MenuItem $menuItem): self
    {
        $this->menuItems->removeElement($menuItem);
        return $this;
    }

    /**
     * @return Collection<int, Staff>
     */
    public function getStaff(): Collection
    {
        return $this->staff;
    }

    public function addStaffMember(Staff $staffMember): self
    {
        if (!$this->staff->contains($staffMember)) {
            $this->staff->add($staffMember);
        }
        return $this;
    }

    public function removeStaffMember(Staff $staffMember): self
    {
        $this->staff->removeElement($staffMember);
        return $this;
    }

    /**
     * @return Collection<int, Table>
     */
    public function getTables(): Collection
    {
        return $this->tables;
    }

    public function addTable(Table $table): self
    {
        if (!$this->tables->contains($table)) {
            $this->tables->add($table);
        }
        return $this;
    }

    public function removeTable(Table $table): self
    {
        $this->tables->removeElement($table);
        return $this;
    }
}