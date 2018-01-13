<?php

namespace App\Repository;

use App\Entity\Workshop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class WorkshopRepository
 *
 * @package App\Repository
 */
class WorkshopRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Workshop::class);
    }
    
}
