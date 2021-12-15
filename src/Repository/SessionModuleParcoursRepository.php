<?php

namespace App\Repository;

use Doctrine\ORM\Query\ResultSetMappingBuilder;
use NoyauBundle\Entity\SessionModuleParcours;

/**
 * SessionModuleParcoursRepository
 */
class SessionModuleParcoursRepository extends \Doctrine\ORM\EntityRepository
{


	public function getByWeek($week,$sessiondossier){

		$qb = $this
			->createQueryBuilder('m')
            ->join('m.sessiondossier', 'sessiondossier')
            ->join('m.sessionevenement', 'sessionevenement')
            ->where('sessiondossier.id = :sessiondossier')
            ->andWhere( "WEEK(sessionevenement.datedebut) = :week" )
            ->setParameters(array(':sessiondossier'=> $sessiondossier,':week'=> $week))
			->orderBy('sessionevenement.datedebut', 'ASC');
		return $qb->getQuery()->getResult();


	}
public function setapprenantconfirme($apprenantconfirme,$sessiondossier){

      $sql = "
      UPDATE session_module_parcours inner join sessions_dossiers sessiondossier on sessiondossier.id=session_module_parcours.sessiondossier_id
SET session_module_parcours.apprenantconfirme = ".$apprenantconfirme."    
where sessiondossier.id = ".$sessiondossier ;

      $conn = $this->_em->getConnection();
            $statement = $conn->executeQuery($sql);
}


	public function getByDate($date,$sessiondossier,$type){

		$qb = $this
			->createQueryBuilder('m')
            ->join('m.sessiondossier', 'sessiondossier')
            ->join('m.sessionevenement', 'sessionevenement')
            ->join('sessionevenement.typeevenement', 'typeevenement')
            ->where('sessiondossier.id = :sessiondossier')
            ->andWhere('typeevenement.code = :type')
            ->andWhere( "DATE_FORMAT(sessionevenement.datedebut,'%Y-%m-%d') <= :date" )
            ->andWhere( "DATE_FORMAT(sessionevenement.datefin,'%Y-%m-%d') >= :date" )
            ->setParameters(array(':sessiondossier'=> $sessiondossier,':date'=> $date,':type'=> $type))
			->orderBy('sessionevenement.datedebut', 'ASC');
		return $qb->getQuery()->getResult();

	}

      public function getBySessiondossier($sessiondossier){
            $qb = $this
                  ->createQueryBuilder('m')
            ->join('m.sessiondossier', 'sessiondossier')
            ->where('sessiondossier.id = :sessiondossier')
            ->AndWhere($qb->expr()->isNotNull("m.sessionsalle"))
            ->setParameters(array(':sessiondossier'=> $sessiondossier));
            return $qb->getQuery()->getOneOrNullResult();


      }
      public function findBySessiondossierOrdre($sessiondossier){
            $qb = $this
                  ->createQueryBuilder('m')
            ->join('m.sessiondossier', 'sessiondossier')
            ->join('m.sessionevenement', 'sessionevenement')
            ->join('sessionevenement.sessionmodule', 'sessionmodule')
            ->where('sessiondossier.id = :sessiondossier')
            ->orderBy('sessionmodule.datedebut', 'ASC')
            ->setParameters(array(':sessiondossier'=> $sessiondossier));
            return $qb->getQuery()->getResult();


      }

      

}
