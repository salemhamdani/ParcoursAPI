<?php

namespace App\Repository;

/**
 * PartenaireRepository
 */
class PartenaireRepository extends \Doctrine\ORM\EntityRepository
{
	
	public function findByCategorie($categorie){

		$query = $this->createQueryBuilder('a')
			->select('a')
			->leftJoin('a.categories', 'c')
			->addSelect('c');

		$query = $query->add('where', $query->expr()->in('c', ':c'))
			->setParameter('c', $categorie)
			->getQuery()
			->getResult();

		return $query;
	}


          public function getPageFilsByParentId($idparent,$visibility)
    {
            
                $qb = $this->createQueryBuilder('partenair')
                    ->where('page.parent = :PAGE_PARENT')
                    ->Andwhere('page.visibility = :visibility')
                    ->where('partenair.archive = :ARCHIVE')
                    ->setParameter('ARCHIVE', $visibility);
        return $qb->getQuery()->getResult();


    }


}
