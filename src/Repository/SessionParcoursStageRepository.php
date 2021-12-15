<?php

namespace App\Repository;

/**
 * SessionParcoursStageRepository
 */
class SessionParcoursStageRepository extends \Doctrine\ORM\EntityRepository
{


    public function getByDate($date,$now)
	{
	$qb =  $this->createQueryBuilder('s')
			->where('s.datedebut BETWEEN :now AND :date')
			->setParameter('date', $date)
			->setParameter('now', $now);
    return $qb->getQuery()->getResult();
	}

    public function getByDateDossier($date,$now,$dossier)
	{
	$qb =  $this->createQueryBuilder('s')
			->where('s.datedebut BETWEEN :now AND :date')
			->Andwhere('s.sessiondossier =:dossier')
			->setParameter('date', $date)
			->setParameter('dossier', $dossier)
			->setParameter('now', $now);
    return $qb->getQuery()->getResult();
	}
	

    public function getByDateCal($date,$dossier)
	{
	$qb =  $this->createQueryBuilder('s')
            ->where( "DATE_FORMAT(s.datedebut,'%Y-%m-%d') <= :date" )
            ->andWhere( "DATE_FORMAT(s.datefin,'%Y-%m-%d') >= :date" )
			->Andwhere('s.sessiondossier =:dossier')
			->setParameter('date', $date)
			->setParameter('dossier', $dossier);
    return $qb->getQuery()->getResult();
	}


	// pour formType
		public function getBySessiondossier($sessiondossier){

		$qb = $this
			->createQueryBuilder('m')
            ->where('m.sessiondossier=:sessiondossier')
			->setParameter('sessiondossier', $sessiondossier)
			->orderBy('m.id');;
		return $qb;
	}




}
