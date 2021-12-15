<?php

namespace App\Repository;

use Doctrine\ORM\Query\ResultSetMappingBuilder;
use NoyauBundle\Entity\Dossier;

/**
 * DossierRepository
 */
class DossierRepository extends \Doctrine\ORM\EntityRepository
{
	
	// index des postulants
	public function getIndexPostulants($archive=0)
	{
		$resultat=array();
		$sql = "
			select
				d.id,
				state.designation												state,
				date_format(d.dateinsert,'%d/%m/%Y')							dateinsert,
				personal_informations.nom,
				personal_informations.prenom,
				date_format(personal_informations.date_naissance,'%d/%m/%Y')	date_naissance,
				profil.intitule													profil_intitule,
				dispositif.designation											dispositif,
				(select group_concat(devislignes.designation)
					from devis
					inner join devislignes
						on devislignes.devis_id=devis.id
					where devis.dossier_id=d.id
						and devislignes.typeligne='parcours')					parcours_demandes,
				niveauxetudes.designation										niveauxetudes_designation,
				adressev3.codepostal,
				personal_informations.telmobile,
				personal_informations.email,
				adressev3.ligne1,
				adressev3.ligne2,
				adressev3.ville,
				date_format(d.debutcontrat,'%d/%m/%Y')							debutcontrat,
				situation.designation											dossierannexes_situation,
				d.reference
			from dossiers d
				inner join masterlistelgs typeactif on (typeactif.id=d.typeactif_id and typeactif.code='postulant')
				left outer join masterlistelgs state on state.id=d.state_id
				inner join personal_informations on personal_informations.id=d.personalinformations_id
				left outer join profil on profil.id=d.profil_id
				left outer join masterlistelgs dispositif on dispositif.id=d.dispositif_id
				left outer join dossierannexes on dossierannexes.id=d.dossierannexes_id
				left outer join masterlistelgs niveauxetudes on niveauxetudes.id=dossierannexes.niveaux_etudes_id
				left outer join adresses adressev3 on adressev3.id=personal_informations.adressev3_id
				left outer join masterlistelgs situation on situation.id=dossierannexes.situation_id
			where d.archive =".$archive
		;

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

	//candidats sans entretien 
	public function findCandidatNotAdmis(){
		  $qb = $this
            ->createQueryBuilder('d')
            ->join('d.state', 's')
            ->addSelect('s')
            ->where('s.code = :code')
            ->setParameters(array(':code'=> 'ADMIS'));
            return $qb;

	}

	// index des stagiaires
	public function getIndexStagiaires($archive=0)
	{
		$resultat=array();
		$sql = "
			SELECT
				stagiaires.id															stagiaire_id,
				date_format(d.dateinsert,'%d/%m/%Y')									dateinsert,
				personal_informations.nom,
				personal_informations.prenom,
				profil.intitule															profil_intitule,
				situation.designation													dossierannexes_situation,
				dispositif.designation													dispositif,
				parcours.intitule														parcours_intitule,
				stagiaires.typeformation												typeformation,
				sessions.intitule														sessions_intitule,
				(select group_concat(financeurs.intitule)
					from financements
					inner join financeurs
						on financements.financeur_id=financeurs.id
					where financements.dossier_id=d.id)							dossier_financeurs_intitule,

				(select group_concat(devis.montantttc)
					from devis
					where devis.dossier_id=d.id)							dossier_devis_montantttc,

					(select group_concat(bondecommandes.numero)
					from financements
					inner join bondecommande_parcours
						on financements.bdcparcours_id=bondecommande_parcours.id
					inner join bondecommandes
						on bondecommande_parcours.bondecommande_id=bondecommandes.id
					where financements.dossier_id=d.id)							dossier_financeurs_numero,

					(select group_concat(bondecommandes.intitule)
					from financements
					inner join bondecommande_parcours
						on financements.bdcparcours_id=bondecommande_parcours.id
					inner join bondecommandes
						on bondecommande_parcours.bondecommande_id=bondecommandes.id
					where financements.dossier_id=d.id)							dossier_financeurs_lot,

				date_format(d.debutcontrat,'%d/%m/%Y')									debutcontrat,
				date_format(d.fincontrat,'%d/%m/%Y')									fincontrat,
				civilite.designation													civilite_designation,
				date_format(d.datedebutcalendrier,'%d/%m/%Y')							datedebutcalendrier,
				date_format(d.datefincalendrier,'%d/%m/%Y')								datefincalendrier,
				date_format(personal_informations.date_naissance,'%d/%m/%Y')			date_naissance,
				TIMESTAMPDIFF(YEAR, personal_informations.date_naissance, CURDATE())	age,
				niveauxetudes.designation												niveauxetudes_designation,
				niveau.intitule															niveau_intitule,
				adressev3.ligne1,
				adressev3.ligne2,
				adressev3.codepostal,
				adressev3.ville,
				personal_informations.email,
				personal_informations.telmobile,
				nationality,
				stagiaires.stateclassrooms,
				d.active_classroom,
				stagiaires.generate,
				d.reference,
				diplomant,
				delegueclasse,
				num_pole_emploi				
			from dossiers d
				inner join personnes on personnes.id=d.personne_id
				inner join masterlistelgs typeactif on (typeactif.id=d.typeactif_id and typeactif.code='stagiaire')
				inner join personal_informations on personal_informations.id=d.personalinformations_id
				left outer join masterlistelgs civilite on civilite.id=personal_informations.civilite_id
				left outer join adresses adressev3 on adressev3.id=personal_informations.adressev3_id
				inner join stagiaires on stagiaires.dossier_id=d.id
				left outer join profil on profil.id=d.profil_id
				left outer join dossierannexes on dossierannexes.id=d.dossierannexes_id
				left outer join masterlistelgs situation on situation.id=dossierannexes.situation_id
				left outer join masterlistelgs niveauxetudes on niveauxetudes.id=dossierannexes.niveaux_etudes_id
				left outer join masterlistelgs dispositif on dispositif.id=d.dispositif_id
				left outer join parcours on parcours.id=d.parcours
				left outer join niveau on niveau.id=parcours.niveau
				inner join sessions_dossiers on sessions_dossiers.dossier_id=d.id
				inner join sessions	on sessions.id=sessions_dossiers.session_id
			where d.archive =".$archive
				;
		
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}
	// index des stagiaires
	public function getDossiersArchives()
	{
		$resultat=array();
		$sql = "
			SELECT
				stagiaires.id															stagiaire_id,
				candidat.id																candidat_id,
				d.id																	dossier_id,
				date_format(d.dateinsert,'%d/%m/%Y')									dateinsert,
				personal_informations.nom,
				personal_informations.prenom,
				profil.intitule															profil_intitule,
				typeactif.designation													typeactif,
				situation.designation													dossierannexes_situation,
				dispositif.designation													dispositif,
				parcours.intitule														parcours_intitule,
				sessions.intitule														sessions_intitule,
				(select group_concat(financeurs.intitule)
					from dossier_financeurs
					inner join financeurs
						on dossier_financeurs.financeur_id=financeurs.id
					where dossier_financeurs.dossier_id=d.id)							dossier_financeurs_intitule,
				date_format(d.debutcontrat,'%d/%m/%Y')									debutcontrat,
				date_format(d.fincontrat,'%d/%m/%Y')									fincontrat,
				civilite.designation													civilite_designation,
				date_format(d.datedebutcalendrier,'%d/%m/%Y')							datedebutcalendrier,
				date_format(d.datefincalendrier,'%d/%m/%Y')								datefincalendrier,
				date_format(personal_informations.date_naissance,'%d/%m/%Y')			date_naissance,
				TIMESTAMPDIFF(YEAR, personal_informations.date_naissance, CURDATE())	age,
				niveauxetudes.designation												niveauxetudes_designation,
				niveau.intitule															niveau_intitule,
				adressev3.ligne1,
				adressev3.ligne2,
				adressev3.codepostal,
				adressev3.ville,
				personal_informations.email,
				personal_informations.telmobile,
				nationality,
				d.active_classroom,
				d.reference,
				diplomant,
				delegueclasse,
				num_pole_emploi,
				date_format(d.dateabondant,'%d/%m/%Y')									date_abandon,				
				date_format(d.dateradiation,'%d/%m/%Y')									date_radiation,
				causeabandon.designation												causeabandon,
				state.designation														state
			from dossiers d
				inner join personnes on personnes.id=d.personne_id
				inner join masterlistelgs typeactif on (typeactif.id=d.typeactif_id)
				inner join personal_informations on personal_informations.id=d.personalinformations_id
				left outer join stagiaires on stagiaires.dossier_id=d.id
				left outer join candidat on candidat.dossier_id=d.id
				left outer join masterlistelgs civilite on civilite.id=personal_informations.civilite_id
				left outer join adresses adressev3 on adressev3.id=personal_informations.adressev3_id
				left outer join profil on profil.id=d.profil_id
				left outer join dossierannexes on dossierannexes.id=d.dossierannexes_id
				left outer join masterlistelgs situation on situation.id=dossierannexes.situation_id
				left outer join masterlistelgs niveauxetudes on niveauxetudes.id=dossierannexes.niveaux_etudes_id
				left outer join masterlistelgs dispositif on dispositif.id=d.dispositif_id
				left outer join masterlistelgs causeabandon on (causeabandon.id=d.causeabandon_id)
				left outer join masterlistelgs state on (state.id=d.state_id)
				left outer join parcours on parcours.id=d.parcours
				left outer join niveau on niveau.id=parcours.niveau
				inner join sessions_dossiers on sessions_dossiers.dossier_id=d.id
				inner join sessions	on sessions.id=sessions_dossiers.session_id
			where d.archive =1"
				;
		
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}


	// index des candidats
	public function getIndexCandidats($archive=0)
	{
		$resultat=array();
		$sql = "
			SELECT
				d.id,
				candidat.id																candidat_id,
				date_format(d.dateinsert,'%d/%m/%Y')									dateinsert,
				personal_informations.nom,
				personal_informations.prenom,
				TIMESTAMPDIFF(YEAR, personal_informations.date_naissance, CURDATE())	age,
				adressev3.codepostal,
				niveauxetudes.designation												niveauxetudes_designation,
				profil.intitule															profil_intitule,
				dispositif.designation													dispositif,
				parcours.intitule														parcours_intitule,
				date_format(d.datedebutcalendrier,'%d/%m/%Y')							datedebutcalendrier,
				date_format(d.datefincalendrier,'%d/%m/%Y')								datefincalendrier,
				date_format(personal_informations.date_naissance,'%d/%m/%Y')			date_naissance,
				situation.designation													dossierannexes_situation,
				civilite.designation													civilite_designation,
				adressev3.ligne1,
				adressev3.ligne2,
				adressev3.ville,
				personal_informations.email,
				personal_informations.telmobile,
				date_format(d.debutcontrat,'%d/%m/%Y')									debutcontrat,
				d.reference
			from dossiers d
				inner join personnes on personnes.id=d.personne_id
				inner join candidat on candidat.dossier_id=d.id
				inner join masterlistelgs typeactif on (typeactif.id=d.typeactif_id and typeactif.code='candidat')
				inner join personal_informations on personal_informations.id=d.personalinformations_id
				left outer join adresses adressev3 on adressev3.id=personal_informations.adressev3_id
				left outer join dossierannexes on dossierannexes.id=d.dossierannexes_id
				left outer join masterlistelgs niveauxetudes on niveauxetudes.id=dossierannexes.niveaux_etudes_id
				left outer join profil on profil.id=d.profil_id
				left outer join masterlistelgs dispositif on dispositif.id=d.dispositif_id
				left outer join parcours on parcours.id=d.parcours
				left outer join masterlistelgs situation on situation.id=dossierannexes.situation_id
				left outer join masterlistelgs civilite on civilite.id=personal_informations.civilite_id
			where d.archive =".$archive
		;
		
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}
	
	
	// Les dossiers pour copie
	public function getForCopy($dossier)
	{
		$resultat=array();
		
		$sql = "
			select personal_informations.prenom						prenom,
				personal_informations.nom							nom,
				parcours.intitule									parcours_intitule,
				dossiers.id											dossier_id,
				sessions_dossiers.id								sessiondossier_id,
				personnes.id										personne_id,
				DATE_FORMAT(sessions_dossiers.datedebut,'%d/%m/%Y')	datedebut,
				DATE_FORMAT(sessions_dossiers.datefin,'%d/%m/%Y')	datefin
			from sessions_dossiers
				inner join dossiers on dossiers.id=sessions_dossiers.dossier_id
				left outer join parcours on parcours.id=dossiers.parcours
				inner join personnes on personnes.id=dossiers.personne_id
				inner join personal_informations on personal_informations.id=personnes.personalinformations_id
			where period_diff(date_format(now(), '%Y%m'), date_format(datedebut, '%Y%m')) <= 12
				and dossiers.id <> ".$dossier->getId()
		;

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

	// Les dossiers des stagiaires de l'année
	public function getAllStagiairesForYear($annee)
	{
		$resultat=array();

		$sql = "
			select distinct dossiers.*
			from dossiers
				inner join sessions_dossiers			on sessions_dossiers.dossier_id=dossiers.id
				inner join session_module_parcours smp	on smp.sessiondossier_id=sessions_dossiers.id
				inner join session_emargement sem		on sem.sessionmoduleparcours_id=smp.id
				inner join session_evenements sev		on sev.id=smp.sessionevenement_id
				inner join evenements ev				on ev.id=sev.id
			where year(ev.datedebut)=".$annee." or year(ev.datefin)=".$annee;

		$rsmb = new ResultSetMappingBuilder($this->_em);
		$rsmb->addRootEntityFromClassMetadata(Dossier::class,'u');
		$resultat = $this->_em->createNativeQuery($sql, $rsmb)->getResult();

		return $resultat;
	}

	public function getByPersonelinformationNotNull(){

        $qb = $this
            ->createQueryBuilder('d')
            ->where('d.personalinformations IS NOT NULL');
        return $qb->getQuery()->getResult();
    }


	public function getByActif(){

        $qb = $this
            ->createQueryBuilder('d')
            ->where('d.personalinformations IS NOT NULL')
            ->AndWhere('d.candidatexiste = 1');
            return $qb;
    }

	/* Les participations
		statut :
			- 0 => toutes les participations
			- 1 => que les entièrement réglées
			- 2 => encore à régler
	*/
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

	public function getByRechercheForm($typedossier,$rechercheform, $count=false)
	{


		if($typedossier=='postulant' || $typedossier=='candidat')
		{
			$statutdossier = $this->_em->getRepository('NoyauBundle:Masterlistelg')->getOneByListeCode('DOSSIER','STATUTDOSSIER',$typedossier);
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
						$restrict.='and dossiers.dossierannexes_id=(select id from dossierannexes where dossierannexes.id=dossiers.id and niveaux_etudes_id in(select id from masterlistelgs where masterliste_id=(select id from masterlistes where module="DEVIS" and code="NIVEAUXETUDES") and code in(';
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
			if(!is_null($rechercheform->getParcourss())){
				$drap=0;
				foreach($rechercheform->getParcourss() as $ligne)
				{
					if($drap==0){$restrict.=' and (';$drap=1;}else{$restrict.=' or ';}
					
					$restrict.='dossiers.parcours='.$ligne->getId();
					if(!is_null($ligne->getParent())){
						$restrict.=' or dossiers.parcours='.$ligne->getParent()->getId();
					}
				}
				if($drap==1){$restrict.=')';}
			}

			if($count==false){
				$sql = "
					select dossiers.*
					from dossiers
						left outer join personal_informations pin on pin.id=dossiers.personalinformations_id
					where  dossiers.archive=0
						and typeactif_id=".$statutdossier->getId()."
				".$restrict;
				$rsmb = new ResultSetMappingBuilder($this->_em);
				$rsmb->addRootEntityFromClassMetadata(Dossier::class,'u');
				$resultat = $this->_em->createNativeQuery($sql, $rsmb)->getResult();
			}else{
				$sql = "
					select count(*) as combien
					from dossiers
					where dossiers.archive=0
						and typeactif_id=".$statutdossier->getId()."
				".$restrict;

				$conn = $this->_em->getConnection();
				$statement = $conn->executeQuery($sql);
				$resultat = $statement->fetchAll();
			}
			
			return $resultat;
		}

		if($typedossier=='stagiaire')
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

			if($count==false){
				$sql = "
					select dossiers.*
					from dossiers
						inner join stagiaires on dossiers.id=stagiaires.dossier_id
						left outer join personal_informations pin on pin.id=dossiers.personalinformations_id
					where dossiers.archive=0
				".$restrict;
				$rsmb = new ResultSetMappingBuilder($this->_em);
				$rsmb->addRootEntityFromClassMetadata(Dossier::class,'u');
				$resultat = $this->_em->createNativeQuery($sql, $rsmb)->getResult();
			}else{
				$sql = "
					select count(*) as combien
					from dossiers
						inner join stagiaires on dossiers.id=stagiaires.dossier_id
					where dossiers.archive=0
				".$restrict;

				$conn = $this->_em->getConnection();
				$statement = $conn->executeQuery($sql);
				$resultat = $statement->fetchAll();
			}
			
			return $resultat;
		}

		return null;
	}

	// Les dossiers pour copie
	public function getRepartitionByCandTypeformation()
	{
		$resultat=array();
		
		$sql = "
			select masterlistelgs.code,
				masterlistelgs.designation,
				count(*) combien
			from candidat
				inner join dossiers on dossiers.id=candidat.dossier_id
				inner join masterlistelgs on masterlistelgs.id=dossiers.typeformation_id
			group by masterlistelgs.code,
				masterlistelgs.designation
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}


    public function getFormationBydatedebut($datedebut,$datefin){
        
        $dossier = $this->createQueryBuilder('dossier')
            			->join('dossier.typeactif', 'typeactif')
            			->where('dossier.datedebutcalendrier BETWEEN :datedebut AND :datefin')
            			->andwhere('typeactif.code = :code')
                        ->setParameter('datedebut', $datedebut)
                        ->setParameter('datefin', $datefin)
                        ->setParameter('code', 'stagiaire')
                        ->getQuery()->getResult();
        
        return $dossier;
                        
    }

   /*     public function finddebutformationclassrooms($datenow){
        
        $date =$datenow->format('Y-m-d');
        $resultat=array();
 		$sql = "select dossiers.id from dossiers
		 inner join masterlistelgs typeactif on (typeactif.id=dossiers.typeactif_id  )
		where  active_classroom = false
		and typeactif.code !='candidat' and typeactif.code !='postulant' and typeactif.code !='prospect' and typeactif.code !='dossierimporte'
		and (date_format(datedebutcalendrier,'%Y-%m-%d') > '$date' ) ";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;          
    }*/


        public function getFormationBydatefin($datenow){
        
        $dossier = $this->createQueryBuilder('dossier')
            			->join('dossier.typeactif', 'typeactif')
            			->where('dossier.datefincalendrier <= :datenow')
            			->andwhere('typeactif.code = :code')
            			->andwhere('dossier.archive = :archive')
                        ->setParameter('datenow', $datenow)
                        ->setParameter('archive', false)
                        ->setParameter('code', 'stagiaire')
                        ->getQuery()->getResult();
        
        return $dossier;
                        
    }


        public function findfinformationclassrooms($delais){
        
        $resultat=array();
 		$sql = "select dossiers.id from dossiers
		 inner join masterlistelgs typeactif on (typeactif.id=dossiers.typeactif_id  )
		where  active_classroom = true
		and  ( typeactif.code ='arret' or  (typeactif.code= 'alumni'
		and date_format(datefincalendrier,'%Y-%m-%d') <= '$delais' ) ) ";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;          
    }

        public function accessclassrooms($datenext){//creation classrooms
        	
        $resultat=array();
 		$sql = "select dossiers.id from dossiers
inner join fos_user fos_user on (fos_user.id=dossiers.personne_id  )
inner  join masterlistelgs typeactif on (typeactif.id=dossiers.typeactif_id  )
where  active_classroom = false and archive = false 
and  typeactif.code ='stagiaire'
and (date_format(datefincalendrier,'%Y-%m-%d') > '$datenext' )
and (date_format(datedebutcalendrier,'%Y-%m-%d') < '$datenext' ) ";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;          
    }



		public function getCalendriernull(){

		$qb = $this
			->createQueryBuilder('d')
                        ->where('d.datedebutcalendrier is null')
                        ->getQuery()->getResult();
		return $qb;
	}

}