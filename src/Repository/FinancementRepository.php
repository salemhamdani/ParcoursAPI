<?php

namespace App\Repository;

/**

 * FinancementRepository
 */
class FinancementRepository extends \Doctrine\ORM\EntityRepository
{


public function getByBdcparcours($Bdcparcours){

    $qb = $this->createQueryBuilder('financement');
    $qb->innerJoin('financement.bdcparcours', 'bdcparcours')
    	->where('bdcparcours.id IN (:Bdcparcours)')
    	->setParameter('Bdcparcours', $Bdcparcours)
        ->orderBy('financement.id', 'DESC');

    return $qb->getQuery()->getResult();



    }

	public function getByParticipations($statut=0)
	{
		$resultat=array();
		
		$restrict="";
		if($statut==1){
			$restrict=" and participation=participationreglee";
		}
		if($statut==2){
			$restrict=" and participation>participationreglee";
		}
		
		$sql = "
			select devis.id											devis_id,
				devis.code											devis_code,
				personal_informations.prenom						prenom,
				personal_informations.nom							nom,
				dossiers.id											dossier_id,
				dossiers.participation								participation,
				dossiers.participationreglee						participationreglee,
				dossiers.participation-dossiers.participationreglee	restearegler,
				dossiers.caution									caution,
				date_format(devis.dateinsert,'%d/%m/%Y')			devis_date
			from dossiers
				inner join devis on devis.dossier_id=dossiers.id
				inner join masterlistelgs on masterlistelgs.id=devis.state_id
				left outer join personal_informations on personal_informations.id=dossiers.personalinformations_id
			where masterlistelgs.code='accord'
		".$restrict;

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

    /* non réglées = 0
    réglées = 1
    toutes = 2*/
	public function getIndividuelles($reglees=2)
	{
		$resultat=array();
		
		$restrict="";
		if($reglees==0){
			$restrict=" and participation > participationreglee";
		}
		if($reglees==1){
			$restrict=" and participation <= participationreglee";
		}
		
		$sql = "
			select devis.id											devis_id,
				devis.code											devis_code,
				personal_informations.prenom						prenom,
				personal_informations.nom							nom,
				dossiers.id											dossier_id,
				dossiers.participation								participation,
				dossiers.participationreglee						participationreglee,
				dossiers.participation-dossiers.participationreglee	restearegler,
				dossiers.caution									caution,
				date_format(devis.dateinsert,'%d/%m/%Y')			devis_date
			from dossiers
				inner join devis on devis.dossier_id=dossiers.id
				inner join masterlistelgs on masterlistelgs.id=devis.state_id
                inner join financements on financements.dossier_id=dossiers.id
                inner join masterlistelgs typefin on typefin.id=financements.typefinancement_id
				left outer join personal_informations on personal_informations.id=dossiers.personalinformations_id
			where masterlistelgs.code='accord'
                and typefin.code='AUTO'
                and participation is not null and participation>0
		".$restrict;

        $conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

	
}
