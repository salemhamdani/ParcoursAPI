<?php

namespace App\Repository;

/**
 * SessionFormateurRepository
 */
class SessionFormateurRepository extends \Doctrine\ORM\EntityRepository
{


	public function getCalendrier($formateurid)
	{
		 
		$resultat=array();

		$sql="
			select 'module'							typeevenement,
				sevent.id							sessionevenement_id,
				sm.id 								sessionmodule_id,
				md.id 								module_id,
				md.code								module_code,
				md.intitule 						module_intitule,
				sm.duree							sessionmodule_duree,
				md.duree							module_duree,
				DATE_FORMAT(evt.datedebut,'%d/%m/%Y')	datedebut,
				DATE_FORMAT(evt.datedebut,'%d-%m-%Y')	datedebuttimeline,
				DATE_FORMAT(evt.datedebut,'%Y')		anneedebut,
				DATE_FORMAT(evt.datedebut,'%c')		moisdebut,
				DATE_FORMAT(evt.datedebut,'%e')		jourdebut,
				DATE_FORMAT(evt.datedebut,'%H')		hdebut,
				DATE_FORMAT(evt.datedebut,'%i')		mindebut,
				week(evt.datedebut,2)				numsemaine,
				DATE_FORMAT(evt.datefin,'%d/%m/%Y')	datefin,
				DATE_FORMAT(evt.datefin,'%Y')		anneefin,
				DATE_FORMAT(evt.datefin,'%c')		moisfin,
				DATE_FORMAT(evt.datefin,'%e')		jourfin,
				DATE_FORMAT(evt.datefin,'%H')		hfin,
				DATE_FORMAT(evt.datefin,'%i')		minfin,
				(select couleur from theme
					inner join sous_theme_theme stt on stt.theme_id=theme.id
					inner join module md2 on md2.sousthemetheme=stt.id
				where md2.id=md.id) couleur
			from session_formateur smp
				inner join session_evenements sevent on sevent.id=smp.sessionevenement_id
				inner join session_module sm on sm.id=sevent.sessionmodule_id
				inner join module md on md.id=sm.module_id
				inner join evenements evt on sevent.id=evt.id
			where smp.formateur_id=".$formateurid."
			
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

	public function findFromYears($date)
	{
		$qb = $this
			->createQueryBuilder('s')
          	->where('YEAR(s.dateinsert) = :day')
			->setParameter('day',$date)
			;
		return $qb->getQuery()->getResult();
	}

	public function getAccepted($date)
	{
		$qb = $this
			->createQueryBuilder('sf')
          	 ->join('sf.statutformateur', 'l')
            ->addSelect('l')
            ->where('l.code = :code')
          	->andwhere('sf.datefin < :date')
			->setParameter('code','ACCEPTE')
			->setParameter('date',$date)
			;
		return $qb->getQuery()->getResult();
	}



}
