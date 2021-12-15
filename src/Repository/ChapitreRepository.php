<?php

namespace App\Repository;

/**
 * ChapitreRepository
 */
class ChapitreRepository extends \Doctrine\ORM\EntityRepository
{
    
    public function deleteAllChapitreByModule($module)
    {
        $qb = $this->createQueryBuilder('c');
        $qb->delete()
            ->where($qb->expr()->eq('c.module', '?1'))
            ->setParameter(1, $module)
        ;

        return $qb->getQuery()->execute();
    }
    
}
