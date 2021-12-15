<?php

namespace App\Repository;

/**
 * FormateurRepository
 */
class FormateurRepository extends \Doctrine\ORM\EntityRepository
{

	public function getFormateursAllStatutsForEvent($event)
	{
		$resultat=[];
/*		
		$datedebutsql=$event->getDatedebut()->format('Y-m-d');
		$datefinsql=$event->getDatefin()->format('Y-m-d');
*/
		$sql="
			select
				formateurs.id				id,
				nom							nom,
				prenom						prenom,
				masterlistelgs.code			statut,
				masterlistelgs.designation	designation,
				masterlistelgs.valeur		couleur
			from formateurs
				inner join personnes p1 on formateurs.id=p1.id
				inner join personal_informations on p1.personalinformations_id = personal_informations.id
				inner join session_formateur on session_formateur.formateur_id=formateurs.id
				inner join masterlistelgs on masterlistelgs.id=session_formateur.statutformateur_id
				inner join fos_user on fos_user.id=formateurs.id
			where fos_user.enabled=1
				and session_formateur.sessionevenement_id=".$event->getId()."
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

	public function getMentorsactifs()
	{
		$sql="
			select
				formateurs.id				id,
				nom							nom,
				prenom						prenom
			from formateurs
				inner join contrat on formateurs.id=contrat.formateur_id
				inner join personnes p1 on formateurs.id=p1.id
				inner join personal_informations on personal_informations.id=p1.personalinformations_id
				inner join fos_user on fos_user.id=formateurs.id
				inner join masterlistelgs st on st.id=contrat.statut_id
				inner join masterlistelgs objet on objet.id=contrat.objet_id
			where fos_user.enabled=1
				and now() between contrat.debutvalidite and finvalidite
				and ( objet.code='ACCJURY' or objet.code='ACCVAE' or objet.code='REFERENT'  )
				and ( st.code='VALIDE' or st.code='PROPOSE'  or st.code='ACCEPTE'  )
			group by formateurs.id
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

	public function getAllForEvent($event)
	{
		$resultat=[];
/*		
		$datedebutsql=$event->getDatedebut()->format('Y-m-d');
		$datefinsql=$event->getDatefin()->format('Y-m-d');
*/		
		if(!is_null($event->getSessionModule()) and !is_null($event->getSessionModule()->getModule())){

			/* tous les formateurs non proposés de la session module libres pour la session_module
			union
			tous les formateurs déjà proposés de la session module
			*/
			$sql="
				select
					f1.id							id,
					personal_informations.nom		nom,
					personal_informations.prenom	prenom,
					null							statut,
					null							couleur
				from formateurs f1
					inner join personnes p1 on f1.id=p1.id
					inner join formateur_module on formateur_module.formateur_id=f1.id
					inner join personal_informations on p1.personalinformations_id = personal_informations.id
					inner join fos_user on fos_user.id=f1.id
				where fos_user.enabled=1
					and formateur_module.module_id=".$event->getSessionModule()->getModule()->getId()."
					and (
						select count(*)
						from evenements ev1
							inner join session_formateur sf1 on sf1.id=ev1.sessionformateur_id
						where ev1.datedebut in(select datedebut from evenements where pere_id=".$event->getId().")
							and sf1.formateur_id=f1.id
					)=0
					and not exists(
						select *
						from session_formateur sf2
						where formateur_id=f1.id
							and sessionevenement_id=".$event->getId()."
					)
				union
				select
					formateurs.id,
					nom,
					prenom,
					masterlistelgs.code,
					masterlistelgs.valeur
				from formateurs
					inner join personnes p1 on formateurs.id=p1.id
					inner join personal_informations on p1.personalinformations_id = personal_informations.id
					inner join session_formateur on session_formateur.formateur_id=formateurs.id
					inner join masterlistelgs on masterlistelgs.id=session_formateur.statutformateur_id
					inner join fos_user on fos_user.id=formateurs.id
				where fos_user.enabled=1
					and session_formateur.sessionevenement_id=".$event->getId()."
					and masterlistelgs.code='PROPOSE'
			";

			$conn = $this->_em->getConnection();
			$statement = $conn->executeQuery($sql);
			$resultat = $statement->fetchAll();
		}else if(! is_null($event->getSessionaccompagnement()) ){

			$sql="
				select
					f1.id							id,
					personal_informations.nom		nom,
					personal_informations.prenom	prenom,
					null							statut,
					null							couleur
				from formateurs f1
					inner join personnes p1 on f1.id=p1.id
					inner join personal_informations on p1.personalinformations_id = personal_informations.id
					inner join fos_user on fos_user.id=f1.id
				where fos_user.enabled=1
					and (
						select count(*)
						from evenements ev1
							inner join session_formateur sf1 on sf1.id=ev1.sessionformateur_id
						where ev1.datedebut in(select datedebut from evenements where pere_id=".$event->getId().")
							and sf1.formateur_id=f1.id
					)=0
					and not exists(
						select *
						from session_formateur sf2
						where formateur_id=f1.id
							and sessionevenement_id=".$event->getId()."
					)
				union
				select
					formateurs.id,
					nom,
					prenom,
					masterlistelgs.code,
					masterlistelgs.valeur
				from formateurs
					inner join personnes p1 on formateurs.id=p1.id
					inner join personal_informations on p1.personalinformations_id = personal_informations.id
					inner join session_formateur on session_formateur.formateur_id=formateurs.id
					inner join masterlistelgs on masterlistelgs.id=session_formateur.statutformateur_id
					inner join fos_user on fos_user.id=formateurs.id
				where fos_user.enabled=1
					and session_formateur.sessionevenement_id=".$event->getId()."
					and masterlistelgs.code='PROPOSE'
			";

			$conn = $this->_em->getConnection();
			$statement = $conn->executeQuery($sql);
			$resultat = $statement->fetchAll();
		}


		return $resultat;
	}

	// vérifie qu'un formateur n'a pas d'événement validé dans l'intervalle de date d'un évènement
	public function getLibreForEvent($formateur,$event)
	{
		$resultat=true;
		
		$datedebutsql=$event->getDatedebut()->format('Y-m-d');
//		$datefinsql=$event->getDatefin()->format('Y-m-d');
		
		if(!is_null($event->getSessionModule())){

			$sql="
			select count(*) as combien
			from session_formateur
				inner join session_module on session_module.id=session_formateur.sessionmodule_id
				inner join evenements on evenements.id=session_module.sessionevenement_id
			where evenements.datedebut = STR_TO_DATE('".$datedebutsql."','%Y-%m-%d')
				and evenements.id <> ".$event->getId()." 
				and session_formateur.formateur_id=".$formateur->getId()
			;
			$conn = $this->_em->getConnection();
			$statement = $conn->executeQuery($sql);
			$resultatsql = $statement->fetchAll();
			
			if($resultatsql[0]['combien']!=0){
				$resultat=false;
			}
		}

		return $resultat;
	}

}
