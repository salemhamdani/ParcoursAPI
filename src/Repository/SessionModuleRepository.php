<?php

namespace App\Repository;

use NoyauBundle\Entity\SessionModule;

use Doctrine\ORM\Query\ResultSetMappingBuilder;

/**
 * SessionModuleRepository
 */
class SessionModuleRepository extends \Doctrine\ORM\EntityRepository
{

	public function getFromDate($date)
	{
		
		$qb = $this
			->createQueryBuilder('s')
			->where("s.datedebut >= :madate")
			->setParameter('madate',$date);

		return $qb->getQuery()->getResult();

	}

	public function getFromDateModule($date,$module)
	{
		
		$qb = $this
			->createQueryBuilder('s')
			->where("s.datedebut >= :madate")
			->AndWhere("s.module = :module")
			->setParameter('module',$module)
			->setParameter('madate',$date);

		return $qb->getQuery()->getResult();

	}

	public function getByDate($now)
	{
	$qb =  $this->createQueryBuilder('sessionmodule')
			->where('sessionmodule.datedebut BETWEEN :now AND :date')
            ->where('sessionmodule.archive = false')
            ->andWhere('sessionmodule.datedebut >= :DATE_NOW')
            ->setParameter('DATE_NOW', $now);
    return $qb->getQuery()->getResult();
	}


     public function getProchaineModule($datedebut,$datefin){
        
	$qb =  $this->createQueryBuilder('sessionmodule')
			->where('sessionmodule.datedebut BETWEEN :now AND :date')
            ->where('sessionmodule.archive = false')
            ->andWhere('sessionmodule.datedebut >= :DATE_DEBUT')
            ->andWhere('sessionmodule.datefin <= :DATE_FIN')
            ->setParameter('DATE_DEBUT', $datedebut)
            ->setParameter('DATE_FIN', $datefin);
    return $qb->getQuery()->getResult();
                        
    }


	public function findPlanifiesBySession($session)
	{
		$query = $this->createQueryBuilder('m')
			->select('m')
			->join('m.sessionmoduleblocs', 'smb')
			->join('smb.session', 's')
			->orderBy('m.datedebut', 'ASC')
			->where('s.id = :sessionid and m.datedebut is not null')
			->setParameter('sessionid', $session->getId());

		return $query->getQuery()->getResult();
	}

	public function getMaxIntitule($debutintitule)
	{
		$resultat=array();

		$sql = "
			select max(intitule) intitule
			from session_module
			where intitule like '".$debutintitule."%'";
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat[0]['intitule'];
	}
	
	public function getSessionsUnitaires($annee=0)
	{
		$resultat=array();

		$restrict='';
		if($annee != 0){
			$restrict=' and year(datedebut)='.$annee.' ';
		}
		$sql = "
			select session_module.id sessionmodule_id,
				session_evenements.id sessionevenements_id,
				DATE_FORMAT(datedebut, '%d/%m/%Y') datedebut,
				DATE_FORMAT(datefin, '%d/%m/%Y') datefin,
				DATE_FORMAT(datedebut, '%Y/%m/%d') datedebutjs,
				DATE_FORMAT(datefin, '%Y/%m/%d') datefinjs,
				intitule
			from session_module
				inner join session_evenements on session_evenements.sessionmodule_id=session_module.id
			where sessionunitaire=true ". $restrict;

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}
	

public function trouverModule($debut,$fin,$module)
	{
	$sql = "select session_module.*
				from evenements
					inner join session_evenements on session_evenements.id=evenements.id
					inner join session_module on session_module.id=session_evenements.sessionmodule_id
					inner join session_module_bloc smb on smb.sessionmodule_id=session_module.id
					inner join sessions se on se.id=smb.session_id
					inner join masterlistelgs on masterlistelgs.id=se.statut_id
					where session_module.datedebut between STR_TO_DATE('".$debut->format('Y-m-d')."','%Y-%m-%d') and STR_TO_DATE('".$fin->format('Y-m-d')."','%Y-%m-%d') and  masterlistelgs.code='VALIDE' and session_module.module_id=".$module->getId()."
				order by session_module.datedebut ";

		$rsmb = new ResultSetMappingBuilder($this->_em);
		$rsmb->addRootEntityFromClassMetadata(SessionModule::class,'u');
		$resultat = $this->_em->createNativeQuery($sql, $rsmb)->getResult();

		return $resultat;
	}

	public function trouverSessions($debut,$fin,$module=null,$parcours=null)
	{



		$restrict=" where session_module.datedebut between STR_TO_DATE('".$debut->format('Y-m-d')."','%Y-%m-%d') and STR_TO_DATE('".$fin->format('Y-m-d')."','%Y-%m-%d')";

		if(!is_null($module)){
			$restrict = $restrict." and session_module.module_id=".$module->getId()." ";
		}
		$resultat=array();

		$sql = "
			select session_module.*
			from evenements
				inner join session_evenements on session_evenements.id=evenements.id
				inner join session_module on session_module.id=session_evenements.sessionmodule_id
			".$restrict."
			order by evenements.datedebut";

		
		if(!is_null($parcours)){
			//$restrict = $restrict." and parcours.id=".$parcours->getId()." and sessions.publiesite=true";
			$restrict = $restrict." and parcours.id=".$parcours->getId();
		}

		if(!is_null($parcours)){
			$sql = "
				select session_module.*
				from evenements
					inner join session_evenements on session_evenements.id=evenements.id
					inner join session_module on session_module.id=session_evenements.sessionmodule_id
					inner join session_module_bloc smb on smb.sessionmodule_id=session_module.id
					inner join sessions se on se.id=smb.session_id
					inner join parcours on parcours.id=se.parcours_id
				".$restrict."
				order by session_module.datedebut";
		}

		$rsmb = new ResultSetMappingBuilder($this->_em);
		$rsmb->addRootEntityFromClassMetadata(SessionModule::class,'u');
		$resultat = $this->_em->createNativeQuery($sql, $rsmb)->getResult();

		return $resultat;
	}

	// la liste pour le calendrier
	public function getForCalendar($debut,$fin)
	{

		$resultat=array();

		$sql = "
			select
				sev.id				evenement_id,
				sm.id				sessionmodule_id,
				sm.intitule			sessionmodule_intitule,
				module.id			module_id,
				module.intitule		module_intitule,
				sm.duree			duree,
				module.code			module_code,				
				(select max(couleur) from theme inner join sous_theme_theme stt on stt.theme_id=theme.id where module.sousthemetheme=stt.id) couleur,
				sm.datedebut		debut,
				sm.datefin			fin
			from session_module sm
				inner join session_evenements sev on sev.sessionmodule_id=sm.id
				inner join module on module.id=sm.module_id
			where sm.datedebut between STR_TO_DATE('".$debut."','%Y-%m-%d') and STR_TO_DATE('".$fin."','%Y-%m-%d')
			";
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}


     public function getMutualise($datedebut,$datefin){
        
	$qb =  $this->createQueryBuilder('sessionmodule')
            ->where('sessionmodule.archive = false')
            ->andWhere('sessionmodule.sessionunitaire = false')
            ->andWhere('sessionmodule.datedebut >= :DATE_DEBUT')
            ->andWhere('sessionmodule.datefin <= :DATE_FIN')
           // ->groupby('sessionmodule.datedebut','sessionmodule.datefin')
            ->setParameter('DATE_DEBUT', $datedebut)
            ->setParameter('DATE_FIN', $datefin);
    return $qb->getQuery()->getResult();
                        
    }


}
