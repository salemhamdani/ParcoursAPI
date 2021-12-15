<?php

namespace App\Repository;

use Doctrine\ORM\Query\ResultSetMappingBuilder;
use NoyauBundle\Entity\Evenement;

/**
 * EvenementRepository
 */
class EvenementRepository extends \Doctrine\ORM\EntityRepository
{
	
	// en array, les types d'évènements
	public function getByTypesEvenements($types)
	{
		$i=0;
		$parameters=array();
		foreach($types as $type)
		{
			$i++;
			if($i==1){
				$clausewhere='e.typeevenement = '.$type->getId();
			}else{
				$clausewhere = $clausewhere.' or e.typeevenement = '.$type->getId();
			}
		}
		$qb = $this
			->createQueryBuilder('e')
			->where($clausewhere);
		return $qb->getQuery()->getResult();
	}

	// une date est-elle un jour férié ou dans une date exceptionnelle ?
	public function isDateInFerieExcept($date)
	{

		$dateSql=$date->format('d/m/Y');

		$sql="
			select count(*) as combien
			from evenements
			where typeevenement_id in(
				select masterlistelgs.id from masterlistelgs inner join masterlistes on masterlistes.id=masterlistelgs.masterliste_id
				where masterlistes.module='CALENDRIER'
					and masterlistes.code='TYPEEVENEMENT'
					and masterlistelgs.code in('DATEEXCEPTIONNELLE','JOURFERIE'))
				and  STR_TO_DATE('".$dateSql."', '%d/%m/%Y') between evenements.datedebut and evenements.datefin
		";
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		if($resultat[0]['combien']>0){
			return true;
		}else{
			return false;
		}

	}

	// une date est-elle un jour férié ou dans une date exceptionnelle ?
	public function getnbModulesByDay($annee)
	{

		$sql="
			select calendrier.jour jour,
				(select count(*) from evenements 
					where type='session' 
						and date(datedebut)=date(calendrier.jour) 
						and (evenements.aenfants=false or evenements.aenfants is null) 
						and pere_id is not null
					) nb_events
			from(
			select jour
			from
				(SELECT DATE_ADD(STR_TO_DATE('01-01-".$annee."','%d-%m-%Y'), INTERVAL (@row_number:=@row_number + 1) DAY) jour
				FROM masterlistelgs,(SELECT @row_number:=-1) AS t
				LIMIT 365) as jours
			) calendrier
		";
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();
		
		return $resultat;

	}



	
      public function getEventsFromToDay()
    {     
          $now = new \DateTime('now');
          $qb = $this->createQueryBuilder('event')
                    ->where('event.datedebut >= :DATE_NOW')
					->setParameter('DATE_NOW', $now)
                    ->orderBy('event.datedebut', 'ASC');
        return $qb->getQuery()->getResult();

    }

    public function findByEventcategory($module,$codemaster,$codelg){

        $qb = $this
            ->createQueryBuilder('e')
            ->join('e.categorie', 'm')
            ->addSelect('m')
            ->leftJoin('m.masterliste', 'l')
            ->addSelect('l')
            ->where('m.code = :codelg and l.module=:module and l.code=:codemaster')
            ->setParameters(array(':codelg'=> $codelg,':module'=>$module,':codemaster'=>$codemaster));
        return $qb->getQuery()->getResult();
    }

    	public function getformOneByListeValeur($module,$codemaster,$valeur){

		$qb = $this
            ->createQueryBuilder('e')
            ->join('e.categorie', 'm')
            ->addSelect('m')
            ->join('m.masterliste', 'l')
            ->addSelect('l')
            ->where('m.valeur = :valeur and l.module=:module and l.code=:codemaster')
            ->setParameters(array(':valeur'=> $valeur,':module'=>$module,':codemaster'=>$codemaster));
		return $qb;
	}
	
    	public function getformOneByListeValeurDate($module,$codemaster,$valeur){

          $now = new \DateTime('now');
		$qb = $this
            ->createQueryBuilder('e')
            ->join('e.categorie', 'm')
            ->addSelect('m')
            ->join('m.masterliste', 'l')
            ->addSelect('l')
            ->where('m.valeur = :valeur and l.module=:module and l.code=:codemaster')
            ->AndWhere('e.datedebut >= :DATE_NOW')
            ->setParameters(array(':valeur'=> $valeur,':module'=>$module,':codemaster'=>$codemaster,'DATE_NOW'=> $now));
		return $qb;
	}

    public function findByEventCMS(){

        $qb = $this
            ->createQueryBuilder('e')
            ->join('e.categorie', 'm')
            ->addSelect('m')
            ->leftJoin('m.masterliste', 'l')
            ->addSelect('l')
            ->where('l.module=:module and l.code=:codemaster')
            ->andwhere(' m.code = :event')
            ->setParameters(array(':event'=> 'EVENEMENT',':module'=>'CALENDRIER',':codemaster'=>'TYPEEVENEMENT'));
        return $qb->getQuery()->getResult();
    }


    public function findByEventreunion(){

        $qb = $this
            ->createQueryBuilder('e')
            ->join('e.categorie', 'm')
            ->addSelect('m')
            ->leftJoin('m.masterliste', 'l')
            ->addSelect('l')
            ->where('l.module=:module and l.code=:codemaster')
            ->andwhere('m.code = :REUNION ')
            ->setParameters(array(':REUNION'=> 'REUNION',':module'=>'CALENDRIER',':codemaster'=>'TYPEEVENEMENT'));
        return $qb->getQuery()->getResult();
    }
    public function getByCategoryevent($module,$codemaster,$codelg){

        $qb = $this
            ->createQueryBuilder('e')
            ->join('e.categorie', 'm')
            ->addSelect('m')
            ->leftJoin('m.masterliste', 'l')
            ->addSelect('l')
            ->where('m.code = :codelg and l.module=:module and l.code=:codemaster')
            ->setParameters(array(':codelg'=> $codelg,':module'=>$module,':codemaster'=>$codemaster));
        return $qb;
    }

	public function getEmargementsNonvalides($formateur)
	{

		$sql="
			select module.code							module_code,
				module.intitule							module_intitule,
				sf.sessionevenement_id					sessionevenement_id,
				ev.id									evenement_id,
				sm.id									sessionmodule_id,
				ev.sessionformateur_id									sessionformateur_id,
				ev.jourentier,
				date_format(ev.datedebut,'%d/%m/%Y')	datedebut,
				date_format(ev.heuredebut1,'%H:%i')		heuredebut1,
				date_format(ev.heurefin1,'%H:%i')		heurefin1,
				date_format(ev.heuredebut2,'%H:%i')		heuredebut2,
				date_format(ev.heurefin2,'%H:%i')		heurefin2,
				ev.emarge1valide,
				date_format(ev.dateemarge1,'%d/%m/%Y')	dateemarge1,
				ev.emarge2valide,
				date_format(ev.dateemarge2,'%d/%m/%Y')	dateemarge2
			from session_formateur sf
				inner join evenements ev on ev.sessionformateur_id=sf.id
				inner join session_evenements sev on sev.id=sf.sessionevenement_id
				inner join session_module sm on sm.id=sev.sessionmodule_id
				inner join module on module.id=sm.module_id
			where ((ev.jourentier=1 and (ev.emarge1valide<>1 or ev.emarge2valide <>1 or ev.emarge1valide is null or ev.emarge2valide is null))
					or (ev.jourentier <>1 and (ev.emarge1valide is null or ev.emarge1valide<>1)))
				and sf.formateur_id=".$formateur->getId()		
		;
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;

	}


	public function getEmargementsFormateurSessionModule($sessionformateur,$sessionmodule)
	{

		$sql="
			select module.code							module_code,
				module.intitule							module_intitule,
				sf.sessionevenement_id					sessionevenement_id,
				ev.id									evenement_id,
				sm.id									sessionmodule_id,
				ev.sessionformateur_id									sessionformateur_id,
				ev.jourentier,
				date_format(ev.datedebut,'%d/%m/%Y')	datedebut,

				
				date_format(ev.heuredebut1,'%H:%i')		heuredebut1,
				date_format(ev.heurefin1,'%H:%i')		heurefin1,
				date_format(ev.heuredebut2,'%H:%i')		heuredebut2,
				date_format(ev.heurefin2,'%H:%i')		heurefin2,
				ev.emarge1valide,
				date_format(ev.dateemarge1,'%d/%m/%Y')	dateemarge1,
				ev.emarge2valide,
				date_format(ev.dateemarge2,'%d/%m/%Y')	dateemarge2
			from session_formateur sf
				inner join evenements ev on ev.sessionformateur_id=sf.id
				inner join session_evenements sev on sev.id=sf.sessionevenement_id
				inner join session_module sm on sm.id=sev.sessionmodule_id
				inner join module on module.id=sm.module_id
			where ((ev.jourentier=1 and (ev.emarge1valide<>1 or ev.emarge2valide <>1 or ev.emarge1valide is null or ev.emarge2valide is null))
					or (ev.jourentier <>1 and (ev.emarge1valide is null or ev.emarge1valide<>1)))
				and ev.sessionformateur_id=".$sessionformateur->getId()
		;
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;

	}

	public function getEmargementsSessionModule($sessionmodule)
	{

		$sql="
			select module.code							module_code,
				module.intitule							module_intitule,
				sf.sessionevenement_id					sessionevenement_id,
				ev.id									evenement_id,
				sm.id									sessionmodule_id,
				ev.jourentier,
				date_format(ev.datedebut,'%d/%m/%Y')	datedebut,
				date_format(ev.heuredebut1,'%H:%i')		heuredebut1,
				date_format(ev.heurefin1,'%H:%i')		heurefin1,
				date_format(ev.heuredebut2,'%H:%i')		heuredebut2,
				date_format(ev.heurefin2,'%H:%i')		heurefin2,
				ev.emarge1valide,
				date_format(ev.dateemarge1,'%d/%m/%Y')	dateemarge1,
				date_format(ev.dateemarge1,'%N')	jouremarge1,
				date_format(ev.dateemarge2,'%N')	jouremarge2,
				ev.emarge2valide,
				date_format(ev.dateemarge2,'%d/%m/%Y')	dateemarge2
			from session_formateur sf
				inner join evenements ev on ev.sessionformateur_id=sf.id
				inner join session_evenements sev on sev.id=sf.sessionevenement_id
				inner join session_module sm on sm.id=sev.sessionmodule_id
				inner join module on module.id=sm.module_id
			where ((ev.jourentier=1 and (ev.emarge1valide<>1 or ev.emarge2valide <>1 or ev.emarge1valide is null or ev.emarge2valide is null))
					or (ev.jourentier <>1 and (ev.emarge1valide is null or ev.emarge1valide<>1)))
				and sm.id=".$sessionmodule->getId()
		;
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;

	}
	
	public function getPeresBetweenDates($debut,$fin)
	{

		$resultat=[];
		$sql="
			select evenements.id id
			from evenements
			where pere_id is null
				and datedebut between STR_TO_DATE('".$debut->format('d/m/Y')."', '%d/%m/%Y') and STR_TO_DATE('".$fin->format('d/m/Y')."', '%d/%m/%Y')
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$res = $statement->fetchAll();

		foreach($res as $id){
			$resultat[]=$this->find($id['id']);
		}
		return $resultat;

	}


	public function findByEventreunionSession($idsession){

        $qb = $this
            ->createQueryBuilder('e')
            ->join('e.categorie', 'm')
            ->join('e.session', 'session')
            ->addSelect('m')
            ->leftJoin('m.masterliste', 'l')
            ->addSelect('l')
            ->where('l.module=:module and l.code=:codemaster')
            ->andwhere('session.id = :idsession ')
            ->setParameters(array(':idsession'=> 'idsession',':module'=>'CALENDRIER',':codemaster'=>'TYPEEVENEMENT'));
        return $qb->getQuery()->getResult();
    }
}
