<?php

namespace App\Repository;

/**
 * SessionRepository
 */
class SessionRepository extends \Doctrine\ORM\EntityRepository
{

	public function getBetween($date)
	{
		
		$qb = $this
			->createQueryBuilder('s')
			->where("s.datedebut >= :madate")
			->setParameter('madate',$date);

		return $qb->getQuery()->getResult();

	}
	public function getBetweenByparcours($date,$parcours)
	{
		
		$qb = $this
			->createQueryBuilder('s')
			->where("s.datedebut >= :madate")      
             ->andWhere('s.parcours.id = :parcours')
            ->setParameters(array(':madate'=> $date,':parcours'=> $parcours));

		return $qb->getQuery()->getResult();

	}
	
	public function findAllByParcoursParent($parcours)
	{
		return $this
			->createQueryBuilder('s')
			->select('s')
			->join('s.parcours', 'pe')
			->join('pe.parent', 'pp')
			->where('pp.id = :parentid')
			->setParameter('parentid', $parcours->getId())
			->getQuery()
			->getResult();

	}

    public function getNbSessionByType($id,$type){
    
        $qb = $this->createQueryBuilder('s')
        ->select('COUNT(s)')        
        ->leftJoin('s.module', 'm')
        ->where('m.id = :MODULE_ID')        
        ->andWhere('s.type = :TYPE')
        ->setParameter('MODULE_ID', $id)
        ->setParameter('TYPE', $type);
 
        $count = $qb->getQuery()->getSingleScalarResult();

        return $count;
	}

	public function findByDateDebutAndId($parcours,$annee)
	{
		return $this
			->createQueryBuilder('s')
			->select('s')
			->join('s.parcours', 'p')
			->where('p.id = :parcoursid and year(s.datedebut)=:annee')
			->orderBy('s.datedebut,s.id')
			->setParameter('parcoursid', $parcours->getId())
			->setParameter('annee', $annee)
			->getQuery()
			->getResult();
	}
	
	public function getAllinfosForExport($session)
	{

		$resultat=array();

		$sql="
			select module.id									id,
				module.code										code,
				module.intitule									intitule,
				date_format(evenements.datedebut,'%d/%m%/%Y')	datedebut,
				date_format(evenements.datefin,'%d/%m%/%Y')		datefin,
				session_module.duree							duree,
				round(session_module.duree/7,0)					dureejrs,
				theme.couleur									couleur
			from sessions
				inner join session_module_bloc on session_module_bloc.session_id=sessions.id
				inner join session_module on session_module.id=session_module_bloc.sessionmodule_id
				inner join session_evenements on session_module.id=session_evenements.sessionmodule_id
				inner join evenements on session_evenements.id=evenements.id
				inner join module on module.id=session_module.module_id
				inner join sous_theme_theme on sous_theme_theme.id=module.sousthemetheme
                inner join theme on sous_theme_theme.theme_id=theme.id
			where sessions.id=".$session->getId()."
			order by evenements.datedebut";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

	public function getAllForTimelinePlan($session)
	{
		
		$resultat=array();
		$sql="
			select sessions.id 					session_id,
				sessions.publiesite				publiesite,
				salle.intitule				    salle_intitule,
				masterlistelgs.code				typeevenement,
				smb.id 							sessionmodulebloc_id,
				sm.id 							sessionmodule_id,
				niveautechnique.designation		niveautechnique,
				md.id 							module_id,
				md.code							module_code,
				md.intitule 					module_intitule,
				sm.duree						sessionmodule_duree,
				md.duree						module_duree,
				evt.datedebut					datedebut,
				DATE_FORMAT(evt.datedebut,'%Y')	anneedebut,
				DATE_FORMAT(evt.datedebut,'%m')	moisdebut,
				DATE_FORMAT(evt.datedebut,'%d')	jourdebut,
				DATE_FORMAT(evt.datedebut,'%H')	hdebut,
				DATE_FORMAT(evt.datedebut,'%i')	mindebut,
				week(evt.datedebut,2)			numsemaine,
				date(subdate(evt.datedebut, interval (dayofweek(evt.datedebut)-2)day))	jour1semaine,
				date(subdate(evt.datedebut, interval (dayofweek(evt.datedebut)-6)day))	jour5semaine,
				evt.datefin						datefin,
				DATE_FORMAT(evt.datefin,'%Y')	anneefin,
				DATE_FORMAT(evt.datefin,'%m')	moisfin,
				DATE_FORMAT(evt.datefin,'%d')	jourfin,
				DATE_FORMAT(evt.datefin,'%H')	hfin,
				DATE_FORMAT(evt.datefin,'%i')	minfin,
				(select count(*)-1 from session_module_bloc where sessionmodule_id=sm.id) nb_mutualisation,
				(select couleur from theme
					inner join sous_theme_theme stt on stt.theme_id=theme.id
					inner join module md2 on md2.sousthemetheme=stt.id
				where md2.id=md.id) couleur,
				null							acc_designation,
				null							sessionaccompagnementsession_id,
				null							sessionaccompagnement_id,
				null							sessionjury_id,
				(select count(*) from session_formateur where sevent.id=session_formateur.sessionevenement_id) nb_formateurs,
				(select count(*) from session_module_parcours smp
				INNER JOIN sessions_dossiers on sessions_dossiers.id=smp.sessiondossier_id
				INNER JOIN dossiers on sessions_dossiers.dossier_id=dossiers.id
					where sevent.id=smp.sessionevenement_id and dossiers.archive = 0
					) nb_apprenants,
				null                            nb_jurys,
				modalites.id					modalite_id,
				modalites.code					modalite_code,
				modalites.designation			modalite_designation,
				evt.id							event_id
			from sessions
				inner join session_module_bloc smb on smb.session_id=sessions.id
				inner join session_module sm on sm.id=smb.sessionmodule_id
				inner join module md on md.id=sm.module_id
				inner join masterlistelgs niveautechnique on niveautechnique.id=md.niveautechnique_id
				left outer join session_evenements sevent on sevent.sessionmodule_id=sm.id
				left outer join evenements evt on sevent.id=evt.id


				left outer join sessions_salles sessionsalle on evt.id=sessionsalle.sessionevenement_id
				left outer join salles salle on salle.id=sessionsalle.salle_id

				left outer join masterlistelgs on masterlistelgs.id=evt.typeevenement_id
				left outer join masterlistelgs modalites on modalites.id=sevent.modaliteapprentissage_id
			where sessions.id=".$session->getId()."
			union
			select sessions.id 					session_id,
				sessions.publiesite				publiesite,
				salle.intitule				    salle_intitule,
				masterlistelgs.code				typeevenement,
                null,
				null,
				null,
				null,
				null,
				null,
				sa.duree,
				sa.duree,
				evt.datedebut					datedebut,
				DATE_FORMAT(evt.datedebut,'%Y')	anneedebut,
				DATE_FORMAT(evt.datedebut,'%m')	moisdebut,
				DATE_FORMAT(evt.datedebut,'%d')	jourdebut,
				DATE_FORMAT(evt.datedebut,'%H')	hdebut,
				DATE_FORMAT(evt.datedebut,'%i')	mindebut,
				week(evt.datedebut,2)			numsemaine,
				date(subdate(evt.datedebut, interval (dayofweek(evt.datedebut)-2)day))	jour1semaine,
				date(subdate(evt.datedebut, interval (dayofweek(evt.datedebut)-6)day))	jour5semaine,
				evt.datefin						datefin,
				DATE_FORMAT(evt.datefin,'%Y')	anneefin,
				DATE_FORMAT(evt.datefin,'%m')	moisfin,
				DATE_FORMAT(evt.datefin,'%d')	jourfin,
				DATE_FORMAT(evt.datefin,'%H')	hfin,
				DATE_FORMAT(evt.datefin,'%i')	minfin,
				(select count(*)
					from session_accompagnement_session
					where session_accompagnement_session.session_id=sa.id) nb_mutualisation,
				null,
				typeacc.designation				acc_designation,
				sas.id							sessionaccompagnementsession_id,
				sa.id 							sessionaccompagnement_id,
				null							sessionjury_id,
				(select count(*) from session_formateur where sevent.id=session_formateur.sessionevenement_id) nb_formateurs,
				(select count(*) from session_module_parcours smp
				INNER JOIN sessions_dossiers on sessions_dossiers.id=smp.sessiondossier_id
				INNER JOIN dossiers on sessions_dossiers.dossier_id=dossiers.id
					where sevent.id=smp.sessionevenement_id and dossiers.archive = 0
					) nb_apprenants,
				null                            nb_jurys,
				modalites.id					modalite_id,
				modalites.code					modalite_code,
				modalites.designation			modalite_designation,
				evt.id							event_id
			from sessions
				left join session_accompagnement_session sas on sas.session_id=sessions.id
				left join session_accompagnement sa on sas.sessionaccompagnement_id=sa.id
				inner join masterlistelgs typeacc on sa.typeaccompagnement_id=typeacc.id


				left outer join session_evenements sevent on sevent.id=sa.sessionevenement_id
				left outer join evenements evt on sevent.id=evt.id

				left outer join sessions_salles sessionsalle on evt.id=sessionsalle.sessionevenement_id
				left outer join salles salle on salle.id=sessionsalle.salle_id
				
				left outer join masterlistelgs on masterlistelgs.id=evt.typeevenement_id
				left outer join masterlistelgs modalites on modalites.id=sevent.modaliteapprentissage_id
			where sessions.id=".$session->getId()."

			union
			select sessions.id 					session_id,
				sessions.publiesite				publiesite,
				salle.intitule				    salle_intitule,
				masterlistelgs.code				typeevenement,
                null,
				null,
				null,
				null,
				null,
				null,
				null,
				sessions.juryduree        	duree_jurys,
				evt.datedebut					datedebut,
				DATE_FORMAT(evt.datedebut,'%Y')	anneedebut,
				DATE_FORMAT(evt.datedebut,'%m')	moisdebut,
				DATE_FORMAT(evt.datedebut,'%d')	jourdebut,
				DATE_FORMAT(evt.datedebut,'%H')	hdebut,
				DATE_FORMAT(evt.datedebut,'%i')	mindebut,
				week(evt.datedebut,2)			numsemaine,
				date(subdate(evt.datedebut, interval (dayofweek(evt.datedebut)-2)day))	jour1semaine,
				date(subdate(evt.datedebut, interval (dayofweek(evt.datedebut)-6)day))	jour5semaine,
				evt.datefin						datefin,
				DATE_FORMAT(evt.datefin,'%Y')	anneefin,
				DATE_FORMAT(evt.datefin,'%m')	moisfin,
				DATE_FORMAT(evt.datefin,'%d')	jourfin,
				DATE_FORMAT(evt.datefin,'%H')	hfin,
				DATE_FORMAT(evt.datefin,'%i')	minfin,
				(select count(*)
					from sessions_jurys
					where sessions_jurys.id=sessions.sessionjury_id) nb_sessions_jurys,
				null,
				null,
				null,
				null 							sessionaccompagnement_id,
				sessions_jurys.id				sessionjury_id,
				(select count(*) from sessions_liste_jurys where sessions_jurys.id=sessions_liste_jurys.sessionjury_id) nb_jurys,
				null nb_apprenants,
				null,
				modalites.id					modalite_id,
				modalites.code					modalite_code,
				modalites.designation			modalite_designation,
				evt.id							event_id
			from sessions

				inner join sessions_jurys sessions_jurys on sessions_jurys.id=sessions.sessionjury_id

				left outer join session_evenements sevent on sevent.id=sessions_jurys.sessionevenement_id
				left outer join evenements evt on sevent.id=evt.id

				left outer join sessions_salles sessionsalle on evt.id=sessionsalle.sessionevenement_id
				left outer join salles salle on salle.id=sessionsalle.salle_id
				
				left outer join masterlistelgs on masterlistelgs.id=evt.typeevenement_id
				left outer join masterlistelgs modalites on modalites.id=sevent.modaliteapprentissage_id
			where sessions.id=".$session->getId()."
			order by datedebut";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}


public function getByParcours($parcours,$now)
	{
	$qb =  $this->createQueryBuilder('session')
			->where('session.datedebut BETWEEN :now AND :date')
			->innerJoin('session.parcours', 'parcours')
            ->where('session.archive = false')
            ->andWhere('session.datedebut >= :DATE_NOW')
            ->andWhere('parcours.id = :PARCOURS_ID')
            ->setParameter('DATE_NOW', $now)
            ->setParameter('PARCOURS_ID', $parcours);
    return $qb->getQuery()->getResult();
	}


public function getByParcoursEncours($parcours,$now)
	{
	$qb =  $this->createQueryBuilder('session')
			->innerJoin('session.parcours', 'parcours')
			->where('session.datefin > :DATE_NOW')
            ->andWhere('session.archive = false')
            ->andWhere('parcours.id = :PARCOURS_ID')
            ->setParameter('PARCOURS_ID', $parcours)
            ->setParameter('DATE_NOW', $now);
    return $qb->getQuery()->getResult();
	}


public function getByEncours($now)
	{
	$qb =  $this->createQueryBuilder('session')
			->where('session.datefin > :DATE_NOW')
            ->andWhere('session.archive = false')
            ->setParameter('DATE_NOW', $now)
            ->orderBy('session.datedebut', 'ASC');
    return $qb->getQuery()->getResult();
	}


public function getByDate($now)
	{
	$qb =  $this->createQueryBuilder('session')
			->where('session.datedebut BETWEEN :now AND :date')
            ->where('session.archive = false')
            ->andWhere('session.datedebut >= :DATE_NOW')
            ->setParameter('DATE_NOW', $now);
    return $qb->getQuery()->getResult();
	}



public function getsessionjury()
	{
	$qb =  $this->createQueryBuilder('session')
            ->where('session.sessionjury IS NOT NULL');
    return $qb->getQuery()->getResult();
	}

public function getByCertification($certification)
	{
	$qb =  $this->createQueryBuilder()
                            ->select('date')
                            ->from('NoyauBundle:Session', 'date')
                            ->where('date.archive =  :ARCHIVE')
                            ->andwhere('date.certification =  :CERTIFICATION')
                            ->andwhere('date.type =  :TYPE')
                            ->andwhere('date.datedebut > :DATENOW')
                            ->setParameter('CERTIFICATION', $certification)
                            ->setParameter('ARCHIVE', false)
                            ->setParameter('TYPE', 'certification')
                            ->setParameter('DATENOW', new \DateTime('now'))
                            ->orderBy('date.datedebut', 'ASC');
    return $qb->getQuery()->getResult();
	}

	public function getSeventsBySession($session)
	{
		
		$resultat=array();
		$sql="
			select * from(
			select
				evt.datedebut							datedebut,
				DATE_FORMAT(evt.datedebut,'%Y')			anneedebut,
				DATE_FORMAT(evt.datedebut,'%m')			moisdebut,
				DATE_FORMAT(evt.datedebut,'%d')			jourdebut,
				DATE_FORMAT(evt.datedebut,'%H')			hdebut,
				DATE_FORMAT(evt.datedebut,'%i')			mindebut,
				week(evt.datedebut,2)					numsemaine,
				DAYOFWEEK(evt.datedebut)				jourdebutdow,
				evt.datefin								datefin,
				DATE_FORMAT(evt.datefin,'%Y')			anneefin,
				DATE_FORMAT(evt.datefin,'%m')			moisfin,
				DATE_FORMAT(evt.datefin,'%d')			jourfin,
				DATE_FORMAT(evt.datefin,'%H')			hfin,
				DATE_FORMAT(evt.datefin,'%i')			minfin,
				DAYOFWEEK(evt.datefin)					jourfindow,
				modalites.id							modalite_id,
				modalites.code							modalite_code,
				modalites.designation					modalite_designation,
				evt.id									event_id,
				evt.pere_id								eventpere_id,
				DATE_FORMAT(evt.dateinsert,'%Y')		yearinsert,
				DATE_FORMAT(evt.dateinsert,'%Y%m%d')	dateinsert
			from session_evenements sevent
				inner join evenements evt on sevent.id=evt.id
				left outer join masterlistelgs modalites on modalites.id=sevent.modaliteapprentissage_id
			where evt.pere_id in(
					select sevent2.id
					from session_module_bloc smb
						inner join session_module sm on sm.id=smb.sessionmodule_id
						inner join session_evenements sevent2 on sevent2.sessionmodule_id=sm.id
					where smb.session_id=".$session->getId()."
				)
			union
			select
				evt.datedebut							datedebut,
				DATE_FORMAT(evt.datedebut,'%Y')			anneedebut,
				DATE_FORMAT(evt.datedebut,'%m')			moisdebut,
				DATE_FORMAT(evt.datedebut,'%d')			jourdebut,
				DATE_FORMAT(evt.datedebut,'%H')			hdebut,
				DATE_FORMAT(evt.datedebut,'%i')			mindebut,
				week(evt.datedebut,2)					numsemaine,
				DAYOFWEEK(evt.datedebut)				jourdebutdow,
				evt.datefin								datefin,
				DATE_FORMAT(evt.datefin,'%Y')			anneefin,
				DATE_FORMAT(evt.datefin,'%m')			moisfin,
				DATE_FORMAT(evt.datefin,'%d')			jourfin,
				DATE_FORMAT(evt.datefin,'%H')			hfin,
				DATE_FORMAT(evt.datefin,'%i')			minfin,
				DAYOFWEEK(evt.datefin)					jourfindow,
				modalites.id							modalite_id,
				modalites.code							modalite_code,
				modalites.designation					modalite_designation,
				evt.id									event_id,
				evt.pere_id								eventpere_id,
				DATE_FORMAT(evt.dateinsert,'%Y')		yearinsert,
				DATE_FORMAT(evt.dateinsert,'%Y%m%d')	dateinsert
			from session_evenements sevent
				inner join evenements evt on sevent.id=evt.id
				left outer join masterlistelgs modalites on modalites.id=sevent.modaliteapprentissage_id
				where evt.pere_id in(
					select sevent2.id
					from session_accompagnement_session sas
						inner join session_accompagnement sa on sas.sessionaccompagnement_id=sa.id
						inner join session_evenements sevent2 on sevent2.id=sa.sessionevenement_id
					where sas.session_id=".$session->getId()."
				)
			) as i
			order by i.datedebut,i.jourdebut
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

	public function getModalitesBySession($session)
	{
		
		$resultat=array();
		$sql="
			select
				'module' as regroupement,
				modalites.id					modalite_id,
				modalites.code					modalite_code,
				modalites.designation			modalite_designation,
				sum(7) duree
			from session_evenements sevent
				left outer join masterlistelgs modalites on modalites.id=sevent.modaliteapprentissage_id
				inner join evenements evt on sevent.id=evt.id
				inner join evenements evt2 on evt2.id=evt.pere_id
				inner join session_evenements sevent2 on sevent2.id=evt2.id
				inner join session_module sm2 on sm2.id=sevent2.sessionmodule_id
				inner join session_module_bloc smb on smb.sessionmodule_id=sm2.id
			where smb.session_id=".$session->getId()."
			group by 1,2,3,4
			union
			select
				'accompagnement' regroupement,
				modalites.id					modalite_id,
				modalites.code					modalite_code,
				modalites.designation			modalite_designation,
				sum(7) duree
			from session_evenements sevent
				left outer join masterlistelgs modalites on modalites.id=sevent.modaliteapprentissage_id
				inner join evenements evt on sevent.id=evt.id
				inner join evenements evt2 on evt2.id=evt.pere_id
				inner join session_evenements sevent2 on sevent2.id=evt2.id
				inner join session_accompagnement sa on sa.sessionevenement_id=sevent2.id
				inner join session_accompagnement_session sas on sas.sessionaccompagnement_id=sa.id
			where sas.session_id=".$session->getId()."
			group by 1,2,3,4
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

	public function getModalitesDetailsAccBySession($session)
	{
		
		$resultat=array();
		$sql="
			select
				'accompagnement'				regroupement,
				typeacc.code					typeaccompagnement_code,
				typeacc.designation				typeaccompagnement_designation,
				modalites.id					modalite_id,
				modalites.code					modalite_code,
				modalites.designation			modalite_designation,
				sum(7) duree
			from session_evenements sevent
				left outer join masterlistelgs modalites on modalites.id=sevent.modaliteapprentissage_id
				inner join evenements evt on sevent.id=evt.id
				inner join evenements evt2 on evt2.id=evt.pere_id
				inner join session_evenements sevent2 on sevent2.id=evt2.id
				inner join session_accompagnement sa on sa.sessionevenement_id=sevent2.id
				inner join session_accompagnement_session sas on sas.sessionaccompagnement_id=sa.id
				inner join masterlistelgs typeacc on typeacc.id=sa.typeaccompagnement_id
			where sas.session_id=".$session->getId()."
			group by 1,2,3,4
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

	public function getModalitesDetailsModuleBySession($session)
	{
		
		$resultat=array();
		$sql="
			select
				'module' as regroupement,
				nivtech.code					nivtech_code,
				nivtech.designation				nivtech_designation,
				modalites.id					modalite_id,
				modalites.code					modalite_code,
				modalites.designation			modalite_designation,
				sum(7) duree
			from session_evenements sevent
				left outer join masterlistelgs modalites on modalites.id=sevent.modaliteapprentissage_id
				inner join evenements evt on sevent.id=evt.id
				inner join evenements evt2 on evt2.id=evt.pere_id
				inner join session_evenements sevent2 on sevent2.id=evt2.id
				inner join session_module sm2 on sm2.id=sevent2.sessionmodule_id
				inner join session_module_bloc smb on smb.sessionmodule_id=sm2.id
				inner join module on module.id=sm2.module_id
				inner join masterlistelgs nivtech on nivtech.id=module.niveautechnique_id
			where smb.session_id=".$session->getId()."
			group by 1,2,3,4
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

}
