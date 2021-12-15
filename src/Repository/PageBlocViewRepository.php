<?php

namespace App\Repository;

/**
 * PageBlocViewRepository
 */
class PageBlocViewRepository extends \Doctrine\ORM\EntityRepository
{


        public function getRang()
    {
        $queryBuilder = $this->createQueryBuilder('f');
        $queryBuilder->select($queryBuilder->expr()->max('f.rang'));
        return (int)$queryBuilder->getQuery()->getScalarResult()[0][1] + 1;
    }


}
