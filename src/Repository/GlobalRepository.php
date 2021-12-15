<?php

namespace App\Repository;

/**
 * GlobalRepository
 */
class GlobalRepository extends \Doctrine\ORM\EntityRepository
{
	public function findPrecedent($item){$qb = $this->createQueryBuilder('m')->where('m.id < :itemid')->setParameters(array(':itemid'=> $item->getId()))->orderBy('m.id', 'DESC')->setMaxResults(1);$resultat=$qb->getQuery()->getOneOrNullResult();if(is_null($resultat)){return $item;}else{return $resultat;}}
	public function findSuivant($item){$qb = $this->createQueryBuilder('m')->where('m.id > :itemid')->setParameters(array(':itemid'=> $item->getId()))->orderBy('m.id', 'ASC')->setMaxResults(1);$resultat=$qb->getQuery()->getOneOrNullResult();if(is_null($resultat)){return $item;}else{return $resultat;}}
}
