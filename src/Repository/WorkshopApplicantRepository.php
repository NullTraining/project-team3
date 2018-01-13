<?php

namespace App\Repository;

use App\Entity\WorkshopApplicant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class WorkshopApplicantRepository
 *
 * @package App\Repository
 */
class WorkshopApplicantRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WorkshopApplicant::class);
    }
}
