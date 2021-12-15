<?php

namespace App\Repository;

/**
 * SessionDossierRepository
 */
class SessionDossierRepository extends \Doctrine\ORM\EntityRepository
{
	
	
	public function getCalendrier($sessiondossier)
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
				DATE_FORMAT(evt.datedebut,'%Y-%m-%d')	datedebutPeriode,
				DATE_FORMAT(evt.datedebut,'%Y')		anneedebut,
				DATE_FORMAT(evt.datedebut,'%m')		moisdebut,
				DATE_FORMAT(evt.datedebut,'%d')		jourdebut,
				DATE_FORMAT(evt.datedebut,'%H')		hdebut,
				DATE_FORMAT(evt.datedebut,'%i')		mindebut,
				week(evt.datedebut,2)				numsemaine,
				DATE_FORMAT(evt.datefin,'%d/%m/%Y')	datefin,
				DATE_FORMAT(evt.datefin,'%Y-%m-%d')	datefinPeriode,
				DATE_FORMAT(evt.datefin,'%Y')		anneefin,
				DATE_FORMAT(evt.datefin,'%m')		moisfin,
				DATE_FORMAT(evt.datefin,'%d')		jourfin,
				DATE_FORMAT(evt.datefin,'%H')		hfin,
				DATE_FORMAT(evt.datefin,'%i')		minfin,
				(select couleur from theme
					inner join sous_theme_theme stt on stt.theme_id=theme.id
					inner join module md2 on md2.sousthemetheme=stt.id
				where md2.id=md.id) couleur
			from session_module_parcours smp
				inner join session_evenements sevent on sevent.id=smp.sessionevenement_id
				inner join session_module sm on sm.id=sevent.sessionmodule_id
				inner join module md on md.id=sm.module_id
				inner join evenements evt on sevent.id=evt.id
			where smp.sessiondossier_id=".$sessiondossier->getId()."
			union
			select 'jury',
				sevent.id,
				sjury.id,
				null,
				null,
				'jury',
				null,
				null,
				DATE_FORMAT(evt.datedebut,'%d/%m/%Y')	datedebut,
				DATE_FORMAT(evt.datedebut,'%d-%m-%Y')	datedebuttimeline,
				DATE_FORMAT(evt.datedebut,'%Y-%m-%d')	datedebutPeriode,
				DATE_FORMAT(evt.datedebut,'%Y')		anneedebut,
				DATE_FORMAT(evt.datedebut,'%m')		moisdebut,
				DATE_FORMAT(evt.datedebut,'%d')		jourdebut,
				DATE_FORMAT(evt.datedebut,'%H')		hdebut,
				DATE_FORMAT(evt.datedebut,'%i')		mindebut,
				week(evt.datedebut,2)				numsemaine,
				DATE_FORMAT(evt.datefin,'%d/%m/%Y')	datefin,
				DATE_FORMAT(evt.datefin,'%Y-%m-%d')	datefinPeriode,
				DATE_FORMAT(evt.datefin,'%Y')		anneefin,
				DATE_FORMAT(evt.datefin,'%m')		moisfin,
				DATE_FORMAT(evt.datefin,'%d')		jourfin,
				DATE_FORMAT(evt.datefin,'%H')		hfin,
				DATE_FORMAT(evt.datefin,'%i')		minfin,
				null
			from session_module_parcours smp
				inner join session_evenements sevent on sevent.id=smp.sessionevenement_id
				inner join evenements evt on sevent.id=evt.id
				inner join sessions_jurys sjury on sjury.sessionevenement_id=sevent.id
			where smp.sessiondossier_id=".$sessiondossier->getId()."
			union
			select 'accompagnement',
				sevent.id,
				sac.id,
				tac.id,
				tac.code,
				tac.designation,
				sac.duree,
				sac.duree,
				DATE_FORMAT(sac.datedebut,'%d/%m/%Y'),
				DATE_FORMAT(sac.datedebut,'%d-%m-%Y'),
				sac.datedebut,
				DATE_FORMAT(sac.datedebut,'%Y'),
				DATE_FORMAT(sac.datedebut,'%m'),
				DATE_FORMAT(sac.datedebut,'%d'),
				DATE_FORMAT(sac.datedebut,'%H'),
				DATE_FORMAT(sac.datedebut,'%i'),
				week(sac.datedebut,2),
				DATE_FORMAT(sac.datefin,'%d/%m/%Y'),
				sac.datefin,
				DATE_FORMAT(sac.datefin,'%Y'),
				DATE_FORMAT(sac.datefin,'%m'),
				DATE_FORMAT(sac.datefin,'%d'),
				DATE_FORMAT(sac.datefin,'%H'),
				DATE_FORMAT(sac.datefin,'%i'),
				null
			from session_module_parcours smp
				inner join session_evenements sevent on sevent.id=smp.sessionevenement_id
				inner join session_accompagnement sac on sac.sessionevenement_id=sevent.id
				inner join masterlistelgs tac on tac.id=sac.typeaccompagnement_id
			where smp.sessiondossier_id=".$sessiondossier->getId()."
			union
			select 'stage',
				sevent.id,
				sps.id,
				null,
				null,
				'stage',
				sps.duree,
				sps.duree,
				DATE_FORMAT(evt.datedebut,'%d/%m/%Y'),
				DATE_FORMAT(evt.datedebut,'%d-%m-%Y'),
				evt.datedebut,
				DATE_FORMAT(evt.datedebut,'%Y'),
				DATE_FORMAT(evt.datedebut,'%m'),
				DATE_FORMAT(evt.datedebut,'%d'),
				DATE_FORMAT(evt.datedebut,'%H'),
				DATE_FORMAT(evt.datedebut,'%i'),
				week(evt.datedebut,2),
				DATE_FORMAT(evt.datefin,'%d/%m/%Y'),
				evt.datefin,
				DATE_FORMAT(evt.datefin,'%Y'),
				DATE_FORMAT(evt.datefin,'%m'),
				DATE_FORMAT(evt.datefin,'%d'),
				DATE_FORMAT(evt.datefin,'%H'),
				DATE_FORMAT(evt.datefin,'%i'),
				null
			from session_evenements sevent
				inner join sessionparcours_stage sps on sps.id=sevent.sessionparcoursstage_id
				inner join evenements evt on sevent.id=evt.id
			where (sps.reel=false or sps.reel is null) and sps.sessiondossier_id=".$sessiondossier->getId()."
			order by datedebut
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

	public function getCalendrierAPI($sessiondossier)
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
				DATE_FORMAT(evt.datedebut,'%Y-%m-%d')	datedebutPeriode,
				week(evt.datedebut,2)				numsemaine,
				DATE_FORMAT(evt.datefin,'%d/%m/%Y')	datefin,
				DATE_FORMAT(evt.datefin,'%Y-%m-%d')	datefinPeriode,
				(select couleur from theme
					inner join sous_theme_theme stt on stt.theme_id=theme.id
					inner join module md2 on md2.sousthemetheme=stt.id
				where md2.id=md.id) couleur
			from session_module_parcours smp
				inner join session_evenements sevent on sevent.id=smp.sessionevenement_id
				inner join session_module sm on sm.id=sevent.sessionmodule_id
				inner join module md on md.id=sm.module_id
				inner join evenements evt on sevent.id=evt.id
			where smp.sessiondossier_id=".$sessiondossier->getId()."
			union
			select 'accompagnement',
				sevent.id,
				sac.id,
				tac.id,
				tac.code,
				tac.designation,
				sac.duree,
				sac.duree,
				DATE_FORMAT(sac.datedebut,'%d/%m/%Y'),
				DATE_FORMAT(sac.datedebut,'%d-%m-%Y'),
				DATE_FORMAT(sac.datedebut,'%Y-%m-%d'),
				week(sac.datedebut,2),
				DATE_FORMAT(sac.datefin,'%d/%m/%Y'),
				DATE_FORMAT(sac.datefin,'%Y-%m-%d'),
				null
			from session_module_parcours smp
				inner join session_evenements sevent on sevent.id=smp.sessionevenement_id
				inner join session_accompagnement sac on sac.sessionevenement_id=sevent.id
				inner join masterlistelgs tac on tac.id=sac.typeaccompagnement_id
			where smp.sessiondossier_id=".$sessiondossier->getId()."
			union
			select 'stage',
				sevent.id,
				sps.id,
				null,
				null,
				'stage',
				sps.duree,
				sps.duree,
				DATE_FORMAT(evt.datedebut,'%d/%m/%Y'),
				DATE_FORMAT(evt.datedebut,'%d-%m-%Y'),
				DATE_FORMAT(evt.datedebut,'%Y-%m-%d'),
				week(evt.datedebut,2),
				DATE_FORMAT(evt.datefin,'%d/%m/%Y'),
				DATE_FORMAT(evt.datefin,'%Y-%m-%d'),
				null
			from session_evenements sevent
				inner join sessionparcours_stage sps on sps.id=sevent.sessionparcoursstage_id
				inner join evenements evt on sevent.id=evt.id
			where (sps.reel=false or sps.reel is null) and sps.sessiondossier_id=".$sessiondossier->getId()."
			order by datedebutPeriode
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}



	    public function getEmargementDossier($datedebut,$datefin,$type){

            $qb = $this
            ->createQueryBuilder('sessiondossier')
            ->join('sessiondossier.sessionmoduleparcours', 'sessionmoduleparcours')
            ->join('sessionmoduleparcours.sessionemargements', 'sessionemargements')
            ->join('sessionemargements.sessionevenement', 'sessionevenement')
            ->where( "DATE_FORMAT(sessionevenement.datedebut,'%Y-%m-%d') <= :datedebut" )
            ->andWhere( "DATE_FORMAT(sessionevenement.datedebut,'%Y-%m-%d') >= :datefin" )
            ->setParameters(array(':datedebut'=> $datefin,':datefin'=> $datedebut))
                  ->orderBy('sessionevenement.datedebut', 'ASC');
            return $qb->getQuery()->getResult();

      }


}
