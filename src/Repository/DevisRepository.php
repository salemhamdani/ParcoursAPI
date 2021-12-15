<?php

namespace App\Repository;

/**
 * DevisRepository
 */
class DevisRepository extends \Doctrine\ORM\EntityRepository
{

    public function getByState($encours,$terminer){

        $qb = $this
            ->createQueryBuilder('d')
            ->join('d.state', 's')
            ->addSelect('s')
            ->where('s.code != :terminer and s.code != :encours ')
            ->setParameters(array(':encours'=> $encours,':terminer'=>$terminer));
        return $qb->getQuery()->getResult();
    }

	public function getParticipations()
	{
		
		$resultat=[];
		$sql="
			SELECT devis.id									devis_id,
				devis.code									devis_code,
				personal_informations.nom					nom,
				personal_informations.prenom				prenom,
				date_format(devis.dateinsert,'%d/%m/%Y')	dateinsert,
				sum(devislignes.montantht)					montant
			FROM devislignes
				inner join devis on devis.id=devislignes.devis_id
				inner join masterlistelgs on masterlistelgs.id=devis.state_id
				inner join dossiers on dossiers.id=devis.dossier_id
				left outer join personal_informations on personal_informations.id=dossiers.personalinformations_id
			where chargeht=0 
				and devislignes.montantht>0
				and masterlistelgs.code='accord'
			group by devis_id,
				devis.code,
				personal_informations.nom,
				personal_informations.prenom,
				devis.dateinsert
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

	public function getDevisOuvertsApprenants()
	{

		$resultat=[];
		$sql="
			select d1.id,
				d1.code,
				d1.montantht,
				d1.nbapprenants,
				ent.raisonSocial
			from devis d1
				inner join entreprises ent on ent.id=d1.entreprise_id
			where d1.devisentreprise=1
				and d1.nbapprenants>(select count(*) from dossier_devis where devis_id=d1.id)
				and d1.archive=0
				and ent.archive=0
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

}
