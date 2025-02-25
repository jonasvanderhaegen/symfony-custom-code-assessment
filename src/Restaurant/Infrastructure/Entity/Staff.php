<?php

declare(strict_types=1);

namespace App\Restaurant\Infrastructure\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: StaffRepository::class)]
#[ORM\Table(name: 'staff')]
#[ORM\Index(columns: ['role'], name: 'idx_staff_role')]
#[ORM\Index(columns: ['email'], name: 'idx_staff_email')]
#[ORM\UniqueConstraint(name: 'uniq_staff_email', columns: ['email'])]
class Staff
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', unique: true)]
    private string $id;

    #[ORM\ManyToOne(targetEntity: Restaurant::class, inversedBy: 'staff')]
    #[ORM\JoinColumn(nullable: false)]
    private Restaurant $restaurant;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private string $firstName;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private string $lastName;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Email]
    private string $email;

    #[ORM\Column(length: 50)]
    private string $role;

    #[ORM\Column]
    private bool $isActive = true;

    #[ORM\OneToMany(mappedBy: 'staff', targetEntity: Shift::class)]
    private Collection $shifts;

    #[ORM\Column(type: 'json')]
    private array $skills = [];

    public function __construct(
        string $id,
        Restaurant $restaurant,
        string $firstName,
        string $lastName,
        string $email,
        string $role
    ) {
        $this->id = $id;
        $this->restaurant = $restaurant;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->role = $role;
        $this->shifts = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getRestaurant(): Restaurant
    {
        return $this->restaurant;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;
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
     * @return Collection<int, Shift>
     */
    public function getShifts(): Collection
    {
        return $this->shifts;
    }

    public function addShift(Shift $shift): self
    {
        if (!$this->shifts->contains($shift)) {
            $this->shifts->add($shift);
        }
        return $this;
    }

    public function removeShift(Shift $shift): self
    {
        $this->shifts->removeElement($shift);
        return $this;
    }

    public function getSkills(): array
    {
        return $this->skills;
    }

    public function setSkills(array $skills): self
    {
        $this->skills = $skills;
        return $this;
    }

    public function addSkill(string $skill): self
    {
        if (!in_array($skill, $this->skills)) {
            $this->skills[] = $skill;
        }
        return $this;
    }

    public function removeSkill(string $skill): self
    {
        $this->skills = array_filter($this->skills, fn($s) => $s !== $skill);
        return $this;
    }
} 