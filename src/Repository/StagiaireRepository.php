<?php

namespace App\Repository;

use Doctrine\ORM\Query\ResultSetMappingBuilder;
use NoyauBundle\Entity\Stagiaire;

/**
 * StagiaireRepository
 */
class StagiaireRepository extends GlobalRepository
{
	
	// Les dossiers pour copie
	public function getAllForRecherche($str='')
	{
		$resultat=array();
		
		$sql = "
			select stagiaires.id	id,
				p1.prenom			prenom,
				p1.nom				nom,
				dossiers.id			dossier_id,
				p2.prenom			prenom,
				p2.nom				nom
			from dossiers
				left outer join personal_informations p1 on p1.id=dossiers.personalinformations_id
				inner join personnes on personnes.id=dossiers.personne_id
				left outer join personal_informations p2 on p2.id=personnes.personalinformations_id
				inner join stagiaires on stagiaires.dossier_id=dossiers.id
			where p1.prenom like '%".$str."%' or p1.nom like '%".$str."%' or p2.prenom like '%".$str."%' or p2.nom like '%".$str."%'
			limit 10
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

	public function getByRechercheForm($rechercheform)
	{
		
		$restrict='';
		if(!is_null($rechercheform->getReferentpedagogiques())){
			$drap=0;
			foreach($rechercheform->getReferentpedagogiques() as $ligne)
			{
				if($drap==0){$restrict.=' and (';$drap=1;}else{$restrict.=' or ';}
				$restrict.='dossiers.referentpedagogique_id='.$ligne->getId();
			}
			if($drap==1){$restrict.=')';}
		}
		if(!is_null($rechercheform->getReferentcommercials())){
			$drap=0;
			foreach($rechercheform->getReferentcommercials() as $ligne)
			{
				if($drap==0){$restrict.=' and (';$drap=1;}else{$restrict.=' or ';}
				$restrict.='dossiers.referentcommercial_id='.$ligne->getId();
			}
			if($drap==1){$restrict.=')';}
		}
		if(!is_null($rechercheform->getReferentadministratifs())){
			$drap=0;
			foreach($rechercheform->getReferentadministratifs() as $ligne)
			{
				if($drap==0){$restrict.=' and (';$drap=1;}else{$restrict.=' or ';}
				$restrict.='dossiers.referentadministratif_id='.$ligne->getId();
			}
			if($drap==1){$restrict.=')';}
		}
		if(!is_null($rechercheform->getReferentcoachs())){
			$drap=0;
			foreach($rechercheform->getReferentcoachs() as $ligne)
			{
				if($drap==0){$restrict.=' and (';$drap=1;}else{$restrict.=' or ';}
				$restrict.='dossiers.referentcoach_id='.$ligne->getId();
			}
			if($drap==1){$restrict.=')';}
		}
		if(!is_null($rechercheform->getProfils())){
			$drap=0;
			foreach($rechercheform->getProfils() as $ligne)
			{
				if($drap==0){$restrict.=' and (';$drap=1;}else{$restrict.=' or ';}
				$restrict.='dossiers.profil_id='.$ligne->getId();
			}
			if($drap==1){$restrict.=')';}
		}
		if(!is_null($rechercheform->getDispositifs())){
			$drap=0;
			foreach($rechercheform->getDispositifs() as $ligne)
			{
				if($drap==0){$restrict.=' and (';$drap=1;}else{$restrict.=' or ';}
				$restrict.='dossiers.dispositif_id='.$ligne->getId();
			}
			if($drap==1){$restrict.=')';}
		}
		if(!is_null($rechercheform->getNiveauetudes())){
			$drap=0;
			foreach($rechercheform->getNiveauetudes() as $ligne)
			{
				if($drap==0){
					$restrict.='and dossiers.dossierannexes_id=(select id from dossierannexes where dossierannexes.id=dossiers.dossierannexes_id and niveaux_etudes_id in(select id from masterlistelgs where masterliste_id=(select id from masterlistes where module="DEVIS" and code="NIVEAUXETUDES") and code in(';
					$drap=1;
				}else{
					$restrict.=', ';
				}
				$restrict.='"'.$ligne->getCode().'"';
			}
			if($drap==1){$restrict.=')))';}
		}

		if(!is_null($rechercheform->getAgemini())){
			$restrict.=' and (DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(pin.date_naissance)), "%Y")+0)>='.$rechercheform->getAgemini();
		}
		if(!is_null($rechercheform->getAgemaxi())){
			$restrict.=' and (DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(pin.date_naissance)), "%Y")+0)<='.$rechercheform->getAgemaxi();
		}
	 
		$sql = "
			select stagiaires.*
			from stagiaires
				inner join dossiers on dossiers.id=stagiaires.dossier_id
				left outer join personal_informations pin on pin.id=dossiers.personalinformations_id
			where dossiers.archive=0
		".$restrict;
		$rsmb = new ResultSetMappingBuilder($this->_em);
		$rsmb->addRootEntityFromClassMetadata(Stagiaire::class,'u');
		$resultat = $this->_em->createNativeQuery($sql, $rsmb)->getResult();
		
		return $resultat;
	}



}
