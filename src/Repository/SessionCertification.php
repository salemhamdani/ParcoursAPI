<?php

namespace App\Repository;

/**
 * SessionCertificationRepository
 */
class SessionCertificationRepository extends \Doctrine\ORM\EntityRepository
{
	
	public function getFromDate($date)
	{
		
		$qb = $this
			->createQueryBuilder('s')
			->where("s.datedebut >= :madate")
			->setParameter('madate',$date);

		return $qb->getQuery()->getResult();

	}

}
