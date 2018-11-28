<?php

namespace App\Repository;

use App\Entity\UserFieldValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserFieldValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserFieldValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserFieldValue[]    findAll()
 * @method UserFieldValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserFieldValueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserFieldValue::class);
    }

    public function getUserIdListByBirthdayRange($dayFrom, $dayTo)
    {
        $query = $this->createQueryBuilder('fv')
            ->innerJoin('fv.field', 'f')
            ->innerJoin('fv.user', 'u')
            ->select(
                'MAX(CASE WHEN f.field_path = birthday THEN fv.value ELSE NULLIF(1, 1) END) birthday'
            )
            ->addSelect('IDENTITY(u) userId')
            ->groupBy('fv.user');

        if($dayFrom <= $dayTo){
            $expr = $query->expr()->andX(
                $query->expr()->gt('DAYOFYEAR(birthday)', $dayFrom),
                $query->expr()->lt('DAYOFYEAR(birthday)', $dayTo)
            );
        }
        else{
            $expr = $query->expr()->orX(
                $query->expr()->gt('DAYOFYEAR(birthday)', $dayFrom),
                $query->expr()->lt('DAYOFYEAR(birthday)', $dayTo)
            );
        }

        $query->having(
            $expr
        )->setParameters([
            'dayFrom' => $dayFrom,
            'dayTo' => $dayTo,
        ]);
        $data = $query->getQuery()->execute();
        $userIdList = [];
        foreach($data as $item){
            $userIdList[$item['userId']] = $item['userId'];
        }
        return $userIdList;
    }
}
