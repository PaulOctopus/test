<?php

namespace App\Repository;

use App\Entity\UserField;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserField|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserField|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserField[]    findAll()
 * @method UserField[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserFieldRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserField::class);
    }
}
