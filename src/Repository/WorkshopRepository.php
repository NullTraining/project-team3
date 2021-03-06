<?php

namespace App\Repository;

use App\Entity\Workshop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class WorkshopRepository.
 */
class WorkshopRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Workshop::class);
    }

    /**
     * @return array
     */
    public function getAllActiveWorkshops()
    {
        return $this
            ->createQueryBuilder('w')
            ->orderBy('w.title')
            ->where('w.active = true')
            ->getQuery()
            ->getResult();
    }
}
