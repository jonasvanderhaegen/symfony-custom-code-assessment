<?php

declare(strict_types=1);

namespace App\Restaurant\Infrastructure\Repository;

use App\Restaurant\Domain\Staff\Model\StaffId;
use App\Restaurant\Domain\Repository\StaffRepositoryInterface;
use App\Restaurant\Infrastructure\Entity\Staff;
use App\Restaurant\Infrastructure\Entity\Restaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

#[AsRepository]
class StaffRepository extends ServiceEntityRepository implements StaffRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Staff::class);
    }

    public function save(Staff $staff): void
    {
        $this->_em->persist($staff);
        $this->_em->flush();
    }

    public function findById(StaffId $id): ?Staff
    {
        return $this->find($id->toString());
    }

    public function findByEmail(string $email): ?Staff
    {
        return $this->findOneBy(['email' => $email]);
    }

    public function findByRestaurant(Restaurant $restaurant): array
    {
        return $this->findBy(['restaurant' => $restaurant, 'isActive' => true]);
    }

    public function findActiveByRole(Restaurant $restaurant, string $role): array
    {
        return $this->createQueryBuilder('s')
            ->where('s.restaurant = :restaurant')
            ->andWhere('s.role = :role')
            ->andWhere('s.isActive = :isActive')
            ->setParameter('restaurant', $restaurant)
            ->setParameter('role', $role)
            ->setParameter('isActive', true)
            ->getQuery()
            ->getResult();
    }

    public function remove(Staff $staff): void
    {
        $this->_em->remove($staff);
        $this->_em->flush();
    }
} 