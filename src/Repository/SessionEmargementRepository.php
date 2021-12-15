<?php

namespace App\Repository;

/**
 * SessionEmargementRepository
 */
class SessionEmargementRepository extends \Doctrine\ORM\EntityRepository
{

	public function getByDossierForFiche($dossier)
	{
		$resultat=array();
		
		$sql = "
			select
				evpere.id									evpere_id,
				sem.id										sem_id,
				sem.actionrealisee,
				sem.estpresent,
				sem.retard,
				sem.commentaire,
				motifabsencecentre.code						motifabsencecentre,
				(case
					when session_module.id is not null
						then concat(
							module.code,
							' ',
							module.intitule)
					when ac.id is not null
						then ac.designation
					else '' end
				)											intitule,
				date_format(evpere.datedebut,'%d/%m/%Y')	evpere_debut,
				date_format(evpere.datefin,'%d/%m/%Y')		evpere_fin,
				(case
					when ampm.code='AM'
						then date_format(evenements.heuredebut1,'%d/%m/%Y %H:%i')
					else date_format(evenements.heuredebut2,'%d/%m/%Y %H:%i') end)	heure_debut,
				(case
					when ampm.code='AM'
						then date_format(evenements.heurefin1,'%d/%m/%Y %H:%i')
					else date_format(evenements.heurefin2,'%d/%m/%Y %H:%i') end)	heure_fin,
				ampm.code									ampm_code,
				dayofweek(evenements.datedebut)				jour
				
			from session_emargement sem
				inner join session_module_parcours smp on smp.id=sem.sessionmoduleparcours_id
				inner join sessions_dossiers sdo on sdo.id=smp.sessiondossier_id
				inner join dossiers on dossiers.id=sdo.dossier_id
				inner join stagiaires on stagiaires.dossier_id=dossiers.id
				inner join session_evenements sev on sev.id=sem.sessionevenement_id
				inner join evenements on evenements.id=sev.id
				inner join evenements evpere on evpere.id=evenements.pere_id
				inner join session_evenements sevpere on sevpere.id=evpere.id
				left outer join session_module on session_module.id=sevpere.sessionmodule_id
				left outer join module on module.id=session_module.module_id
				left outer join session_accompagnement sac on sac.sessionevenement_id=sevpere.id
				left outer join masterlistelgs ac on ac.id=sac.typeaccompagnement_id
				left outer join masterlistelgs motifabsencecentre on motifabsencecentre.id= sem.motifabsencecentre_id
			
				inner join masterlistelgs ampm on ampm.id=sem.ampm_id
			where dossiers.id=".$dossier->getId()."
			order by evenements.datedebut,ampm.code
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

	public function getBysmp($sessionmoduleparcours){

		$qb = $this
			->createQueryBuilder('m')
            ->join('m.sessionmoduleparcours', 'smp')
            ->join('m.sessionevenement', 'sessionevenement')
            ->where('smp.id = :sessionmoduleparcours')
            ->setParameters(array(':sessionmoduleparcours'=> $sessionmoduleparcours))
			->orderBy('sessionevenement.datedebut', 'ASC');
		return $qb->getQuery()->getResult();


	}

	public function getByEvenementPereAndDossier($evenementid,$sessiondossierid)
	{
		$resultat=array();
		
		$sql = "
			select *
			from session_emargement sem
				inner join evenements ev on ev.id=sem.sessionevenement_id
				inner join session_module_parcours smp on smp.id=sem.sessionmoduleparcours_id
			where ev.pere_id=".$evenementid." and smp.sessiondossier_id=".$sessiondossierid
		;

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}


	    public function getByDateEmargement($date,$sessiondossier,$type){

            $qb = $this
            ->createQueryBuilder('emargement')
            ->join('emargement.sessionmoduleparcours', 'sessionmoduleparcours')
            ->join('emargement.sessionevenement', 'sessionevenement')
            ->join('sessionevenement.typeevenement', 'typeevenement')
            ->join('sessionmoduleparcours.sessiondossier', 'sessiondossier')
            ->where('sessiondossier.id = :sessiondossier')
            //->andWhere('typeevenement.code = :type')
            ->andWhere( "DATE_FORMAT(sessionevenement.datedebut,'%Y-%m-%d') = :date" )
            ->andWhere( "DATE_FORMAT(sessionevenement.datefin,'%Y-%m-%d') = :date" )
            ->setParameters(array(':sessiondossier'=> $sessiondossier,':date'=> $date))
                  ->orderBy('sessionevenement.datedebut', 'ASC');
            return $qb->getQuery()->getResult();

      }

   		
	public function findEmargementsFormateurSessionModule($sessionformateur,$idevents)
	{

		$qb = $this
			->createQueryBuilder('em')
            ->addSelect('em')
            ->join('em.sessionevenement', 'ev')
            ->where('em.sessionformateur =:sessionformateur ')
            ->andwhere('ev.id in (:idevents)')
            ->setParameters(array(':idevents'=> $idevents,':sessionformateur'=>$sessionformateur))
			->orderBy('em.id');
		 return $qb->getQuery()->getResult();
	}
}
