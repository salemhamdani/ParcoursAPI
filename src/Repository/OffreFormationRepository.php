<?php

namespace App\Repository;

/**
 * OffreFormationRepository
 */
class OffreFormationRepository extends \Doctrine\ORM\EntityRepository
{
	public function findPrecedent($item){$qb = $this->createQueryBuilder('m')->where('m.id < :itemid')->setParameters(array(':itemid'=> $item->getId()))->orderBy('m.id', 'DESC')->setMaxResults(1);$resultat=$qb->getQuery()->getOneOrNullResult();if(is_null($resultat)){return $item;}else{return $resultat;}}
	public function findSuivant($item){$qb = $this->createQueryBuilder('m')->where('m.id > :itemid')->setParameters(array(':itemid'=> $item->getId()))->orderBy('m.id', 'ASC')->setMaxResults(1);$resultat=$qb->getQuery()->getOneOrNullResult();if(is_null($resultat)){return $item;}else{return $resultat;}}


	public function findByProfil($profil){

		$qb = $this
			->createQueryBuilder('l')
            ->where('l.profil = :profil')
        	->groupBy('l.formation')
            ->setParameters(array(':profil'=> $profil))
			->orderBy('l.id');
		return $qb->getQuery()->getResult();
	}


	public function findByProfilFormation($profil,$formation){

		$qb = $this
			->createQueryBuilder('l')
            ->where('l.profil = :profil and l.formation=:formation')
        	->groupBy('l.formation')
            ->setParameters(array(':profil'=> $profil,':formation'=>$formation))
			->orderBy('l.id');
		return $qb;
	}

}
