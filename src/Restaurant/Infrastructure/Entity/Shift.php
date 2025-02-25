<?php

declare(strict_types=1);

namespace App\Restaurant\Infrastructure\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShiftRepository::class)]
#[ORM\Table(name: 'shifts')]
#[ORM\Index(columns: ['start_time'], name: 'idx_shift_start_time')]
#[ORM\Index(columns: ['status'], name: 'idx_shift_status')]
class Shift
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', unique: true)]
    private string $id;

    #[ORM\ManyToOne(targetEntity: Staff::class, inversedBy: 'shifts')]
    #[ORM\JoinColumn(nullable: false)]
    private Staff $staff;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $startTime;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $endTime;

    #[ORM\Column(length: 50)]
    private string $status = 'scheduled';

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $checkinTime = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $checkoutTime = null;

    #[ORM\Column(type: 'json')]
    private array $breaks = [];

    public function __construct(
        string $id,
        Staff $staff,
        \DateTimeImmutable $startTime,
        \DateTimeImmutable $endTime
    ) {
        $this->id = $id;
        $this->staff = $staff;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    // Getters and setters...
} 