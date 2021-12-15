<?php

namespace App\Repository;

/**
 * SessionEvenementRepository
 */
class SessionEvenementRepository extends \Doctrine\ORM\EntityRepository
{

	public function getCurrentForSalleTv($salle,$nbminutes=0)
	{
		$resultat=[];
		$sql="select event.id id
			from evenements event
				inner join session_evenements sevent on sevent.id=event.id
				inner join evenements eventpere on event.pere_id=eventpere.id
				inner join sessions_salles on sessions_salles.sessionevenement_id=eventpere.id
			where (now() between DATE_SUB(event.heuredebut1, INTERVAL ".$nbminutes." MINUTE) and event.heurefin1 or now() between DATE_SUB(event.heuredebut2, INTERVAL ".$nbminutes." MINUTE) and event.heurefin2)
				and sessions_salles.salle_id=".$salle->getId();

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();
		
		if(count($resultat)==1){
			return $this->find($resultat[0]['id']);
		}

		return null;
	}


	public function array_sort($array, $on, $order=SORT_ASC)
	{
		$new_array = array();
		$sortable_array = array();
	
		if (count($array) > 0) {
			foreach ($array as $k => $v) {
				if (is_array($v)) {
					foreach ($v as $k2 => $v2) {
						if ($k2 == $on) {
							$sortable_array[$k] = $v2;
						}
					}
				} else {
					$sortable_array[$k] = $v;
				}
			}
	
			switch ($order) {
				case SORT_ASC:
					asort($sortable_array);
				break;
				case SORT_DESC:
					arsort($sortable_array);
				break;
			}
	
			foreach ($sortable_array as $k => $v) {
				$new_array[$k] = $array[$k];
			}
		}
	
		return $new_array;
	}
	


    public function getBydate($datedebut,$datefin){
        
        $enchainementModule = $this->createQueryBuilder('evenement')
                        ->where('evenement.datedebut > :datedebut')
                        ->andWhere('evenement.datefin < :datefin')
                        ->setParameter('datefin', $datefin)
                        ->setParameter('datedebut', $datedebut)
                        ->getQuery()->getResult();
        
        return $enchainementModule;
                        
    }
    public function getAllForTimelineDossier($datedebut=null,$intitule=null){
    	//$nbsemaines=1;
		//if($nbsemaines<1){$nbsemaines=1;}
		// if(is_null($ipdate)){
		// 	$ipdate=new \DateTime();
		// 	}
		//le lundi de la semaine de début
		//	$datedebut= new \DateTime('Monday previous week '.$ipdate->format('Y-m-d'));
		//	$datedebut->add(new \DateInterval('P7D'));

		$i=1;
		$resultat=[];
		if( is_null($datedebut)){
				$datedebut=new \DateTime();
			$datefin = new \DateTime($datedebut->format('d-m-Y')); 
			$datefin->modify('+2 years');
		}else {
			$datefin = new \DateTime($datedebut->format('d-m-Y')); 
			$datefin->modify('+2 day');
		}

			// ligne d'entete
			$ligne=[];
			$datepourannee=clone $datedebut;
			$datepourannee->add(new \DateInterval('P3D'));
			$anneeint=$datepourannee->format('Y');
			$semaineint=$datedebut->format('W');

			$ligne['anneedebut']=$anneeint;
			$ligne['numsemaine']=$semaineint;
			$ligne['debut_semaine']=$datedebut->format('d-m-Y');
			$ligne['fin_semaine']=$datefin->format('d-m-Y');
			$ligne['id']=null;
			$resultat[]=$ligne;
			////////
			
			$sql = $this->getSqlTimeLineByInterval($datedebut,$datefin,$intitule);
			$conn = $this->_em->getConnection();
			$statement = $conn->executeQuery($sql);
			$resultatint = $statement->fetchAll();

			$repoSessionEvenement = $this
				->getEntityManager()
				->getRepository('NoyauBundle:SessionEvenement');
			$repoSessionAccomp = $this
				->getEntityManager()
				->getRepository('NoyauBundle:SessionAccompagnement');	
			$repoSessionJury = $this
				->getEntityManager()
				->getRepository('NoyauBundle:SessionJury');	
			$repoSession = $this
				->getEntityManager()
				->getRepository('NoyauBundle:Session');		
			for($numtab=0;$numtab<count($resultatint);$numtab++){
				// les "chapeaux"
				$sessionevenement=$repoSessionEvenement->find($resultatint[$numtab]['event_id']);
				$resultatint[$numtab]['sessions']=[];
				$numparcours=0;
				$nbtotenvisages=0;
				if(!is_null($sessionevenement->getSessionmodule())){
					foreach($sessionevenement->getSessionmodule()->getSessionmoduleblocs() as $smb)
					{
						$resultatint[$numtab]['sessions'][$numparcours]=[];
						$resultatint[$numtab]['sessions'][$numparcours]['session_id']=$smb->getSession()->getId();
						$resultatint[$numtab]['sessions'][$numparcours]['session_intitule']=$smb->getSession()->getIntitule();
						$resultatint[$numtab]['sessions'][$numparcours]['parcours_intitule']=$smb->getSession()->getParcours()->getIntitule();
						$resultatint[$numtab]['sessions'][$numparcours]['couleur']="#ffffff";
						if(!is_null($smb->getSession()->getParcours()) && !is_null($smb->getSession()->getParcours()->getFiliere()) && strlen($smb->getSession()->getParcours()->getFiliere()->getCouleur())>1){
							$resultatint[$numtab]['sessions'][$numparcours]['couleur']=$smb->getSession()->getParcours()->getFiliere()->getCouleur();
						}
						$resultatint[$numtab]['sessions'][$numparcours]['session_nbenvisages']=$smb->getSession()->getSimulnbapprenants();
						$nbtotenvisages += $smb->getSession()->getSimulnbapprenants();
						if(!is_null($smb->getSession()->getReferentpedagogique())){
						$resultatint[$numtab]['sessions'][$numparcours]['refped']= $smb->getSession()->getReferentpedagogique()->getPersonalinformations()->getPrenom();
						}
						else {
							$resultatint[$numtab]['sessions'][$numparcours]['refped']="?";	
						}
						if(!is_null($smb->getSession()->getReferentcoach())){
						$resultatint[$numtab]['sessions'][$numparcours]['refcoach']= $smb->getSession()->getReferentcoach()->getPersonalinformations()->getPrenom();
						}
						else {
							$resultatint[$numtab]['sessions'][$numparcours]['refcoach']="?"	;
						}

						$numparcours++;
					}
				}


				if(!is_null($sessionevenement->getSessionaccompagnement())){
					
					foreach($sessionevenement->getSessionaccompagnement()->getSessionaccompagnementsessions() as $sacc)
					{
						$resultatint[$numtab]['sessions'][$numparcours]=[];
						$resultatint[$numtab]['sessions'][$numparcours]['session_id']=$sacc->getSession()->getId();
						$resultatint[$numtab]['sessions'][$numparcours]['session_intitule']=$sacc->getSession()->getIntitule();
						$resultatint[$numtab]['sessions'][$numparcours]['parcours_intitule']=$sacc->getSession()->getParcours()->getIntitule();
						$resultatint[$numtab]['sessions'][$numparcours]['couleur']="#ffffff";
						if(!is_null($sacc->getSession()->getParcours()) && !is_null($sacc->getSession()->getParcours()->getFiliere()) && strlen($sacc->getSession()->getParcours()->getFiliere()->getCouleur())>1){
							$resultatint[$numtab]['sessions'][$numparcours]['couleur']=$sacc->getSession()->getParcours()->getFiliere()->getCouleur();
						}
						$resultatint[$numtab]['sessions'][$numparcours]['session_nbenvisages']=$sacc->getSession()->getSimulnbapprenants();
						$nbtotenvisages += $sacc->getSession()->getSimulnbapprenants();
						if(!is_null($sacc->getSession()->getReferentpedagogique())){
						$resultatint[$numtab]['sessions'][$numparcours]['refped']= $sacc->getSession()->getReferentpedagogique()->getPersonalinformations()->getPrenom();
						}
						else {
							$resultatint[$numtab]['sessions'][$numparcours]['refped']="?";	
						}
						if(!is_null($sacc->getSession()->getReferentcoach())){
						$resultatint[$numtab]['sessions'][$numparcours]['refcoach']= $sacc->getSession()->getReferentcoach()->getPersonalinformations()->getPrenom();
						}
						else {
							$resultatint[$numtab]['sessions'][$numparcours]['refcoach']="?"	;
						}

						$numparcours++;
					}
					
				}
				$resultatint[$numtab]['nbtotenvisages'] = $nbtotenvisages;
			}



			
			$resultat=array_merge($resultat,$resultatint);

			
			$datedebut->add(new \DateInterval('P7D'));
			$datefin->add(new \DateInterval('P7D'));

		return $resultat;
	}		
	public function getAllForTimeline($ipdate=null,$nbsemaines=10,$sort=null)
	{
		//$nbsemaines=40;
		if($nbsemaines<1){$nbsemaines=1;}
		if(is_null($ipdate)){
			$ipdate=new \DateTime();
		}
		// le lundi de la semaine de début
		$datedebut= new \DateTime('Monday previous week '.$ipdate->format('Y-m-d'));
		$datedebut->add(new \DateInterval('P7D'));

		// la date de fin
		$datefin=clone $datedebut;
		$datefin->add(new \DateInterval('P6D'));


		$i=1;
		$resultat=[];
		while($i<=$nbsemaines){

			// ligne d'entete
			$ligne=[];

			$datepourannee=clone $datedebut;
			$datepourannee->add(new \DateInterval('P3D'));
			$anneeint=$datepourannee->format('Y');
			$semaineint=$datedebut->format('W');


			$ligne['anneedebut']=$anneeint;
			$ligne['numsemaine']=$semaineint;
			$ligne['debut_semaine']=$datedebut->format('d-m-Y');
			$ligne['fin_semaine']=$datefin->format('d-m-Y');
			$ligne['id']=null;
			$resultat[]=$ligne;
			////////
			$sql = $this->getSqlTimeLineByInterval($datedebut,$datefin);
			$conn = $this->_em->getConnection();
			$statement = $conn->executeQuery($sql);
			$resultatint = $statement->fetchAll();
			
			$repoSessionSalle = $this
				->getEntityManager()
				->getRepository('NoyauBundle:SessionSalle');
			$repoSessionEvenement = $this
				->getEntityManager()
				->getRepository('NoyauBundle:SessionEvenement');
			$repoSessionFormateur = $this
				->getEntityManager()
				->getRepository('NoyauBundle:SessionFormateur');
			$repoSessionAccomp = $this
				->getEntityManager()
				->getRepository('NoyauBundle:SessionAccompagnement');	
			$repoSessionJury = $this
				->getEntityManager()
				->getRepository('NoyauBundle:SessionJury');	
			// ajouter les salles et les formateurs par événement
			for($numtab=0;$numtab<count($resultatint);$numtab++){
				// les salles
				$resultatint[$numtab]['salles']=[];
				$sessionsalles=$repoSessionSalle->findBySessionevenement($resultatint[$numtab]['event_id']);
				$numsalle=0;
				$modalites='';
				setlocale(LC_ALL, 'fr','fr_FR','fr_FR@euro','fr_FR.utf8','fr-FR','fra');
				foreach($sessionsalles as $sessionsalleslg)
					if(! is_null($sessionsalleslg->getSalle()))
					{
						$resultatint[$numtab]['salles'][$numsalle]=[];
						$resultatint[$numtab]['salles'][$numsalle]['salle_id']=$sessionsalleslg->getSalle()->getId();
						$resultatint[$numtab]['salles'][$numsalle]['salle_intitule']=$sessionsalleslg->getSalle()->getIntitule();
						$resultatint[$numtab]['salles'][$numsalle]['salle_capacite']=$sessionsalleslg->getSalle()->getCapacite();
						$resultatint[$numtab]['salles'][$numsalle]['site_id']=$sessionsalleslg->getSalle()->getSite()->getId();
						$resultatint[$numtab]['salles'][$numsalle]['site_intitule']=$sessionsalleslg->getSalle()->getSite()->getIntitule();
						//$sasessionevtid = $sessionsalleslg->getSessionevenement()->getid();
						$evtenfants = $sessionsalleslg->getSessionevenement();
						$elearningmode = $this->getEntityManager()->getRepository('NoyauBundle:Masterlistelg')->getOneByListeCode('CALENDRIER','MODALITEAPPRENTISSAGE','ELEARNING');
						//$evtenfants =$this->getEntityManager()->getRepository('NoyauBundle:evenement')->findByid($sessionsalleslg->getSessionevenement()->getid())->getEnfants();
						$resultatint[$numtab]['salles'][$numsalle]['modalite'] ="";
						foreach($evtenfants->getEnfants() as $enfant ){
							$modalites .= '<span class="badge badge-mark border-success" title="'.$enfant->getdatedebut()->format('d-m-Y').':'.$repoSessionEvenement->findOneByid($enfant->getid())->getmodaliteapprentissage()->getdesignation().'"></span>';
							$resultatint[$numtab]['salles'][$numsalle]['modalite'] .=  $enfant->getdatedebut()->format('j').'/';
						}
				

						$numsalle++;
					}
					//$resultatint[$numtab]['modjours'] = $modjours;

					//Dates suivant type de session
					/*
					$datedebut='';
					$datefin='';
					if(!is_null($repoSessionEvenement->findOneById($resultatint[$numtab]['event_id'])->getTypeevenement())){
						if($repoSessionEvenement->findOneById($resultatint[$numtab]['event_id'])->getTypeevenement()->getCode()=='ACCOMPAGNEMENT'){
							switch($repoSessionEvenemen->finOnedById($resultatint[$numtab]['event_id'])->getTypeEvenement()->getCode()){
								case 'ACCOMPAGNEMENT':
									$datedebut = $repoSessionAccomp->findBySessionevenement($resultatint[$numtab]['event_id'])->getdatedebut()->format('d-m-Y');
									$datefin = $repoSessionAccomp->findBySessionevenement($resultatint[$numtab]['event_id'])->getdatefin()->format('d-m-Y');
									break;
								case 'SESSIONMODULE' : 
									$datedebut = $sessionsalleslg->getSessionevenement()->getsessionmodule()->getdatedebut()->format('d-m-Y');
									$datefin = $sessionsalleslg->getSessionevenement()->getsessionmodule()->getdatefin()->format('d-m-Y');
									break;
								case 'SESSIONJURY' : 
									$datedebut = $repoSessionJury->findBySessionevenement($resultatint[$numtab]['event_id'])->getdatedebut()->format('d-m-Y');
									$datefin = $repoSessionJury->findBySessionevenement($resultatint[$numtab]['event_id'])->getdatefin()->format('d-m-Y');
									break;
								default : break;	
							}
						}
					}
					
					$resultatint[$numtab]['salles'][$numsalle]['datedebut'] = $datedebut='';
					$resultatint[$numtab]['salles'][$numsalle]['datefin']= $datefin;
					
				*/
								
				// les "chapeaux"
				$sessionevenement=$repoSessionEvenement->find($resultatint[$numtab]['event_id']);
				$resultatint[$numtab]['sessions']=[];
				$numparcours=0;
				$nbtotenvisages=0;
				if(!is_null($sessionevenement->getSessionmodule())){
					foreach($sessionevenement->getSessionmodule()->getSessionmoduleblocs() as $smb)
					{
						$resultatint[$numtab]['sessions'][$numparcours]=[];
						$resultatint[$numtab]['sessions'][$numparcours]['session_id']=$smb->getSession()->getId();
						$resultatint[$numtab]['sessions'][$numparcours]['session_intitule']=$smb->getSession()->getIntitule();
						$resultatint[$numtab]['sessions'][$numparcours]['parcours_intitule']=$smb->getSession()->getParcours()->getIntitule();
						$resultatint[$numtab]['sessions'][$numparcours]['couleur']="#263238";
						$resultatint[$numtab]['sessions'][$numparcours]['session_statut']= $smb->getSession()->getStatut()->getDesignation() ;

						if(!is_null($smb->getSession()->getParcours()) && !is_null($smb->getSession()->getParcours()->getFiliere()) && strlen($smb->getSession()->getParcours()->getFiliere()->getCouleur())>1){
							$resultatint[$numtab]['sessions'][$numparcours]['couleur']=$smb->getSession()->getParcours()->getFiliere()->getCouleur();
						}

						$resultatint[$numtab]['sessions'][$numparcours]['session_nbenvisages']=$smb->getSession()->getSimulnbapprenants();
						$nbtotenvisages += $smb->getSession()->getSimulnbapprenants();
						
						if(!is_null($smb->getSession()->getReferentpedagogique())){
						$resultatint[$numtab]['sessions'][$numparcours]['refped']= $smb->getSession()->getReferentpedagogique()->getPersonalinformations()->getPrenom();
						}
						else {
							$resultatint[$numtab]['sessions'][$numparcours]['refped']="?";	
						}
						
						if(!is_null($smb->getSession()->getReferentcoach())){
						$resultatint[$numtab]['sessions'][$numparcours]['refcoach']= $smb->getSession()->getReferentcoach()->getPersonalinformations()->getPrenom();
						}
						else {
							$resultatint[$numtab]['sessions'][$numparcours]['refcoach']="?"	;
						}

						$numparcours++;
					}
				}
				

				if(!is_null($sessionevenement->getSessionaccompagnement())){
					
					foreach($sessionevenement->getSessionaccompagnement()->getSessionaccompagnementsessions() as $smb)
					{
						$resultatint[$numtab]['sessions'][$numparcours]=[];
						$resultatint[$numtab]['sessions'][$numparcours]['session_id']=$smb->getSession()->getId();
						$resultatint[$numtab]['sessions'][$numparcours]['session_intitule']=$smb->getSession()->getIntitule();
						$resultatint[$numtab]['sessions'][$numparcours]['parcours_intitule']=$smb->getSession()->getParcours()->getIntitule();
						$resultatint[$numtab]['sessions'][$numparcours]['couleur']="#263238";
						$resultatint[$numtab]['sessions'][$numparcours]['session_statut']= $smb->getSession()->getStatut()->getDesignation() ;
						$resultatint[$numtab]['sessions'][$numparcours]['session_nbenvisages']=$smb->getSession()->getSimulnbapprenants();
						$nbtotenvisages += $smb->getSession()->getSimulnbapprenants();
						if(!is_null($smb->getSession()->getReferentpedagogique())){
						$resultatint[$numtab]['sessions'][$numparcours]['refped']= $smb->getSession()->getReferentpedagogique()->getPersonalinformations()->getPrenom();
						}
						else {
							$resultatint[$numtab]['sessions'][$numparcours]['refped']="?";	
						}
						if(!is_null($smb->getSession()->getReferentcoach())){
						$resultatint[$numtab]['sessions'][$numparcours]['refcoach']= $smb->getSession()->getReferentcoach()->getPersonalinformations()->getPrenom();
						}
						else {
							$resultatint[$numtab]['sessions'][$numparcours]['refcoach']="?"	;
						}

						$numparcours++;
					}
				}

				if ($resultatint[$numtab]['typeevenement'] == 'SESSIONJURY'){
					$resultatint[$numtab]['sessions'][$numparcours]=[];
					$resultatint[$numtab]['sessions'][$numparcours]['session_id'] = $resultatint[$numtab]['session_id'];
					$resultatint[$numtab]['sessions'][$numparcours]['session_intitule'] = $resultatint[$numtab]['sessionjury_intitule'];
					$resultatint[$numtab]['sessions'][$numparcours]['session_statut']= $resultatint[$numtab]['session_statut'] ;

				}

				
				$resultatint[$numtab]['nbtotenvisages'] = $nbtotenvisages;
				// les formateurs
				$resultatint[$numtab]['formateurs']=[];
/*
				$sessionmodule = $this->getEntityManager()->getRepository('NoyauBundle:SessionModule')->findBySessionevenement($resultatint[$numtab]['event_id']);
				$sessionformateurs=$repoSessionFormateur->findBySessionmodule($sessionmodule);
*/
				$numformateur=0;
				foreach($sessionevenement->getSessionformateurs() as $sessionformateur){
					$resultatint[$numtab]['formateurs'][$numformateur]=[];
					$resultatint[$numtab]['formateurs'][$numformateur]['formateur_id']=$sessionformateur->getFormateur()->getId();
					$resultatint[$numtab]['formateurs'][$numformateur]['formateur_nom']=$sessionformateur->getFormateur()->getPersonalinformations()->getNom();
					$resultatint[$numtab]['formateurs'][$numformateur]['formateur_prenom']=$sessionformateur->getFormateur()->getPersonalinformations()->getPrenom();
					$resultatint[$numtab]['formateurs'][$numformateur]['formateur_statut_code']=$sessionformateur->getStatutformateur()->getCode();
					$resultatint[$numtab]['formateurs'][$numformateur]['formateur_statut_des']=$sessionformateur->getStatutformateur()->getDesignation();
					$resultatint[$numtab]['formateurs'][$numformateur]['formateur_statut_couleur']=$sessionformateur->getStatutformateur()->getValeur();
					$resultatint[$numtab]['formateurs'][$numformateur]['annexe']='';
					if(!is_null($sessionformateur->getContrat())){
						$resultatint[$numtab]['formateurs'][$numformateur]['annexe']=$sessionformateur->getContrat()->getRefcontrat();
						$resultatint[$numtab]['formateurs'][$numformateur]['dates']=$sessionformateur->getContrat()->getdebutvalidite()->format('d-m');
						$resultatint[$numtab]['formateurs'][$numformateur]['dates'] .= " au ".$sessionformateur->getContrat()->getfinvalidite()->format('d-m');
					}
					else $resultatint[$numtab]['formateurs'][$numformateur]['dates']="-";
					$resultatint[$numtab]['formateurs'][$numformateur]['jours']=[];
					foreach($sessionformateur->getEvenements() as $evenement){
						$resultatint[$numtab]['formateurs'][$numformateur]['jours'][]=$evenement->getDatedebut()->format('d-m-Y');
					}
					$numformateur++;
				}
				
			}
			//tri
			if ($sort != null){
				$resultatint = $this->array_sort($resultatint, $sort, SORT_ASC);
			}
			$resultat=array_merge($resultat,$resultatint);
			
			

			// les salles libres
			//$salleslibres=$this->getSalleslibres($datedebut,5);
			//$resultat=array_merge($resultat,$salleslibres);

			$datedebut->add(new \DateInterval('P7D'));
			$datefin->add(new \DateInterval('P7D'));

			$i++;
		}
		
		return $resultat;
	}

	public function getSalleslibres($datedebut,$nbjours)
	{
		$resultat=[];

		$sql="select
				DATE_FORMAT(jours.jour,'%Y')	anneedebut,
				week(jours.jour,1)				numsemaine,
				jours.jour						datedebut,
				DATE_FORMAT(jours.jour,'%m')	moisdebut,
				DATE_FORMAT(jours.jour,'%d')	jourdebut,
				DATE_FORMAT(jours.jour,'%H')	hdebut,
				DATE_FORMAT(jours.jour,'%i')	mindebut,
				salles.id						salle_id,
				salles.intitule					salle_intitule,
				salles.capacite					salle_capacite,
				salles.logocouleur				logocouleur
			from salles
			inner join
			(SELECT DATE_ADD(STR_TO_DATE('".$datedebut->format('Y-m-d')."','%Y-%m-%d'), INTERVAL (@row_number:=@row_number + 1) DAY) jour
			FROM
				masterlistes,(SELECT @row_number:=-1) AS t
			LIMIT ".$nbjours.") as jours
			where not exists(
				select * from sessions_salles
					inner join session_evenements on sessions_salles.sessionevenement_id=session_evenements.id
					inner join evenements on session_evenements.id=evenements.id
				where jours.jour between evenements.datedebut and evenements.datefin
				)
			order by id,
				jour;
			";
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$sqlresultat = $statement->fetchAll();
		
		// faire les between (du..au..)
		$salle=0;
		$i=0;
		foreach($sqlresultat as $ligne)
		{
			if($salle != $ligne['salle_id']){
				$salle=$ligne['salle_id'];
				$i++;
				$resultat[$i]['eventanneedebut']=$ligne['anneedebut'];
				if($ligne['numsemaine']>'52'){
					$ligne['numsemaine']='01';
					$ligne['anneedebut']++;
				}
				$resultat[$i]['anneedebut']=$ligne['anneedebut'];
				$resultat[$i]['numsemaine']=$ligne['numsemaine'];
				$resultat[$i]['event_id']=null;
				$resultat[$i]['statut_code']=null;
				$resultat[$i]['typeevenement']=null;
				$resultat[$i]['datedebut']=$ligne['datedebut'];
				$resultat[$i]['moisdebut']=$ligne['moisdebut'];
				$resultat[$i]['jourdebut']=$ligne['jourdebut'];
				$resultat[$i]['hdebut']=$ligne['hdebut'];
				$resultat[$i]['mindebut']=$ligne['mindebut'];
				$resultat[$i]['couleur']=$ligne['logocouleur'];
				$resultat[$i]['salle_id']=$ligne['salle_id'];
				$resultat[$i]['salle_intitule']=$ligne['salle_intitule'];
				$resultat[$i]['salle_capacite']=$ligne['salle_capacite'];
			}
			$resultat[$i]['datefin']=$ligne['datedebut'];
			$resultat[$i]['anneefin']=$ligne['anneedebut'];
			$resultat[$i]['moisfin']=$ligne['moisdebut'];
			$resultat[$i]['jourfin']=$ligne['jourdebut'];
			$resultat[$i]['hfin']=$ligne['hdebut'];
			$resultat[$i]['minfin']=$ligne['mindebut'];
		}
		return $resultat;
	}
	private function getSqlTimeLineByInterval($datedebut,$datefin,$intitule=null)
	{	
		$sqlintitule=''; 
		if(! is_null($intitule)){
			$sqlintitule="and ( md.intitule LIKE '%".$intitule."%' or  md.code LIKE '%".$intitule."%' or   tacc.designation LIKE '%".$intitule."%' or  sessionmodule.intitule LIKE '%".$intitule."%' or  sessionj.intitule LIKE '%".$intitule."%'  or  tev.code LIKE '%".$intitule."%' )";
			if($intitule=='jury')$sqlintitule="and  tev.code LIKE '%SESSIONJURY%'";
		}

		$sql = "
			select
				DATE_FORMAT(evt.datedebut,'%Y')	anneedebut,
				week(evt.datedebut,1)			numsemaine,
				sevt.id							event_id,
				sevtst.code						statut_code,
				sevtst.designation				statut_designation,
				tev.code						typeevenement,
				convocationstagiaire			convocationstagiaire,
				convocationformateur			convocationformateur,
				evt.datedebut					datedebut,
				DATE_FORMAT(evt.datedebut,'%m')	moisdebut,
				DATE_FORMAT(evt.datedebut,'%d')	jourdebut,
				DATE_FORMAT(evt.datedebut,'%H')	hdebut,
				DATE_FORMAT(evt.datedebut,'%i')	mindebut,
				evt.datefin						datefin,
				DATE_FORMAT(evt.datefin,'%Y')	anneefin,
				DATE_FORMAT(evt.datefin,'%m')	moisfin,
				DATE_FORMAT(evt.datefin,'%d')	jourfin,
				DATE_FORMAT(evt.datefin,'%H')	hfin,
				DATE_FORMAT(evt.datefin,'%i')	minfin,
				md.id							module_id,
				(select couleur from theme inner join sous_theme_theme stt on stt.theme_id=theme.id inner join module md2 on md2.sousthemetheme=stt.id where md2.id=md.id) couleur,
				md.code							module_code,
				md.intitule						module_intitule,
				md.duree						module_duree,
				smod.duree						sessionmodule_duree,
				sac.id							sessionaccompagnement_id,
				sac.duree						sessionaccompagnement_duree,
				tacc.designation				typeaccompagnement,
				sj.id							sessionjury_id,
				sessionj.intitule				sessionjury_intitule,
				sessionj.juryduree				sessionjury_duree,
				sessionj.id						session_id,
				sessionj.statut_id					session_statut,
				DATE_FORMAT(DATE_ADD(evt.datedebut, INTERVAL(-WEEKDAY(evt.datedebut)) DAY),'%d-%m-%Y') debut_semaine,
				DATE_FORMAT(DATE_ADD(DATE_ADD(evt.datedebut, INTERVAL(-WEEKDAY(evt.datedebut)) DAY), INTERVAL 6 DAY),'%d-%m-%Y') fin_semaine,
				null							salle_id,
				null							salle_intitule,
				(select count(1) from sessions_dossiers
					inner join session_module_parcours on session_module_parcours.sessiondossier_id=sessions_dossiers.id
				where session_module_parcours.sessionevenement_id=sevt.id and session_module_parcours.apprenantconfirme=1) nb_confirmes,
				(select count(1) from sessions_dossiers
					inner join session_module_parcours on session_module_parcours.sessiondossier_id=sessions_dossiers.id
				where session_module_parcours.sessionevenement_id=sevt.id and session_module_parcours.apprenantconfirme=0) nb_nonconfirmes
			from session_evenements sevt
				inner join evenements evt on sevt.id=evt.id
				inner join masterlistelgs tev on tev.id=evt.typeevenement_id
				inner join masterlistelgs sevtst on sevtst.id=sevt.statutsessionevt_id
				left outer join session_module smod on smod.id=sevt.sessionmodule_id
				left outer join module md on md.id=smod.module_id
				left outer join session_accompagnement sac on sac.sessionevenement_id=sevt.id
				left outer join masterlistelgs tacc on tacc.id=sac.typeaccompagnement_id
				left outer join sessions_jurys sj on sj.sessionevenement_id=sevt.id
				left outer join parcours on parcours.id=sj.parcours_id
				left outer join sessions sessionj on sessionj.sessionjury_id=sj.id
				left outer join session_module_bloc sessionmoduleblocs on sessionmoduleblocs.sessionmodule_id=smod.id
				left outer join sessions sessionmodule on sessionmoduleblocs.session_id=sessionmodule.id

			where evt.datedebut between STR_TO_DATE('".$datedebut->format('Y-m-d')."','%Y-%m-%d') and STR_TO_DATE('".$datefin->format('Y-m-d')."','%Y-%m-%d')
				and (smod.id is null or (smod.id is not null and smod.archive=false))
				and tev.code <> 'DOSSIERSTAGE' ".$sqlintitule." group by sevt.id
			order by anneedebut,numsemaine,datedebut,hdebut
		";
		
		return $sql;
	}

	private function getSqlTimeLineByWeek($annee,$semaine)
	{
		$date=new \Datetime();
		$datedebut = $date->setISODate($annee, $semaine);
		$datefin=clone $datedebut;
		$datefin->modify('+6 days');
		
		$sql=$this->getSqlTimeLineByInterval($datedebut,$datefin);
		return $sql;
	}

	public function getBySalles($salles)
	{
		$restrict='';

		$i=0;
		foreach($salles as $salle){
			$i++;
			if($i==1){
				$restrict='ss.salle='.$salle->getId();
			}else{
				$restrict = $restrict . ' or ss.salle='.$salle->getId();
			}
		}

		$qb = $this
			->createQueryBuilder('s')
			->join('s.sessionsalles','ss')
            ->where($restrict);
		return $qb->getQuery()->getResult();
	}

	// Les périodes pour un dossier
	public function getBySessionDossier($typeevenement,$sessiondossier)
	{
		$resultat=array();
		if($typeevenement=='centrewithacc'){
		
			$sql = "
				select distinct
					DATE_FORMAT(session_module.datedebut,'%d/%m/%Y') datedebut,
					DATE_FORMAT(session_module.datefin,'%d/%m/%Y') datefin,
					session_module.duree duree
				from session_evenements
					inner join session_module on session_module.id=session_evenements.sessionmodule_id
					inner join session_module_parcours smp on smp.sessionevenement_id=session_evenements.id
				where smp.sessiondossier_id=".$sessiondossier->getId()."
				union
				select distinct
					DATE_FORMAT(session_accompagnement.datedebut,'%d/%m/%Y') datedebut,
					DATE_FORMAT(session_accompagnement.datefin,'%d/%m/%Y') datefin,
					session_accompagnement.duree duree
				from session_evenements
					inner join session_module_parcours smp on smp.sessionevenement_id=session_evenements.id
					inner join session_accompagnement on session_accompagnement.sessionevenement_id=session_evenements.id
				where smp.sessiondossier_id=".$sessiondossier->getId()."
				order by datedebut
				";

			$conn = $this->_em->getConnection();
			$statement = $conn->executeQuery($sql);
			$resultat = $statement->fetchAll();
		}

		if($typeevenement=='centre'){
		
			$sql = "
				select distinct
					DATE_FORMAT(session_module.datedebut,'%d/%m/%Y') datedebut,
					DATE_FORMAT(session_module.datefin,'%d/%m/%Y') datefin,
					session_module.duree duree
				from session_evenements
					inner join session_module on session_module.id=session_evenements.sessionmodule_id
					inner join session_module_parcours smp on smp.sessionevenement_id=session_evenements.id
				where smp.sessiondossier_id=".$sessiondossier->getId()."
				order by datedebut
				";

			$conn = $this->_em->getConnection();
			$statement = $conn->executeQuery($sql);
			$resultat = $statement->fetchAll();
		}

		if($typeevenement=='accompagnement'){
		
			$sql = "
				select distinct
					DATE_FORMAT(session_accompagnement.datedebut,'%d/%m/%Y') datedebut,
					DATE_FORMAT(session_accompagnement.datefin,'%d/%m/%Y') datefin,
					session_accompagnement.duree duree
				from session_evenements
					inner join session_module_parcours smp on smp.sessionevenement_id=session_evenements.id
					inner join session_accompagnement on session_accompagnement.sessionevenement_id=session_evenements.id
				where smp.sessiondossier_id=".$sessiondossier->getId()."
				order by datedebut
				";

			$conn = $this->_em->getConnection();
			$statement = $conn->executeQuery($sql);
			$resultat = $statement->fetchAll();
		}
		if($typeevenement=='stage'){
		
			$sql = "
				select distinct
					DATE_FORMAT(datedebut,'%d/%m/%Y') datedebut,
					DATE_FORMAT(datefin,'%d/%m/%Y') datefin,
					duree duree
				from sessionparcours_stage
				where sessiondossier_id=".$sessiondossier->getId()."
					and (reel=false or reel is null)
				order by datedebut
				";

			$conn = $this->_em->getConnection();
			$statement = $conn->executeQuery($sql);
			$resultat = $statement->fetchAll();
		}
		return $resultat;
	}

	// utilisation dans le service DorancoCalendrier pour connaitre les périodes en centre
	public function getBySession($session)
	{
		
		$resultat=array();

		$sql = "
			select distinct
				DATE_FORMAT(evenements.datedebut,'%d/%m/%Y') datedebut,
				DATE_FORMAT(evenements.datefin,'%d/%m/%Y') datefin,
				session_module.duree duree
			from evenements
				inner join session_evenements on session_evenements.id=evenements.id
				inner join session_module on session_module.id=session_evenements.sessionmodule_id
				inner join session_module_bloc on session_module_bloc.sessionmodule_id=session_module.id
				inner join sessions on sessions.id=session_module_bloc.session_id
			where sessions.id=".$session->getId()." 
			order by evenements.datedebut";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}
/*
	// utilisation dans le service DorancoCalendrier pour connaitre les périodes en centre
	public function getBySessiondossier($sessiondossier)
	{
		
		$resultat=array();

		$sql = "
			select 'module'	as typeevenement,
				DATE_FORMAT(evenements.datedebut,'%d/%m/%Y') datedebut,
				DATE_FORMAT(evenements.datefin,'%d/%m/%Y') datefin,
				session_module.duree duree,
				true as compteheure,
				evenements.datedebut olddatedebut
			from evenements
				inner join session_evenements on session_evenements.id=evenements.id
				inner join session_module on session_module.id=session_evenements.sessionmodule_id
				inner join session_module_parcours smp on smp.sessionevenement_id=session_evenements.id
				inner join sessions_dossiers sd on sd.id=smp.sessiondossier_id
			where sd.id=".$sessiondossier->getId()."
			union
			select 'accompagnement',
				DATE_FORMAT(evenements.datedebut,'%d/%m/%Y'),
				DATE_FORMAT(evenements.datefin,'%d/%m/%Y'),
				session_accompagnement.duree,
				smp.compteheure,
				evenements.datedebut olddatedebut
			from evenements
				inner join session_accompagnement on session_accompagnement.sessionevenement_id=evenements.id
				inner join session_module_parcours smp on smp.sessionevenement_id=evenements.id
				inner join sessions_dossiers sd on sd.id=smp.sessiondossier_id
			where sd.id=".$sessiondossier->getId()."
			order by olddatedebut
			";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}
*/

	// utilisation dans le service DorancoCalendrier pour connaitre les périodes en centre avec les accompagnements
	public function getBySessionWithAcc($session)
	{
		
		$resultat=array();

		$sql = "
			select 'module'	as typeevenement,
				DATE_FORMAT(evenements.datedebut,'%d/%m/%Y') datedebut,
				DATE_FORMAT(evenements.datefin,'%d/%m/%Y') datefin,
				session_module.duree duree,
				true as compteheure,
				evenements.datedebut olddatedebut
			from evenements
				inner join session_evenements on session_evenements.id=evenements.id
				inner join session_module on session_module.id=session_evenements.sessionmodule_id
				inner join session_module_bloc on session_module_bloc.sessionmodule_id=session_module.id
				inner join sessions on sessions.id=session_module_bloc.session_id
			where sessions.id=".$session->getId()."
			union
			select 'accompagnement',
				DATE_FORMAT(evenements.datedebut,'%d/%m/%Y'),
				DATE_FORMAT(evenements.datefin,'%d/%m/%Y'),
				session_accompagnement.duree,
				compteheure,
				evenements.datedebut olddatedebut
			from evenements
				inner join session_accompagnement on session_accompagnement.sessionevenement_id=evenements.id
				inner join session_accompagnement_session on session_accompagnement_session.sessionaccompagnement_id=session_accompagnement.id
			where session_accompagnement_session.session_id=".$session->getId()."
			order by olddatedebut
			";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

	// utilisation dans le service DorancoCalendrier pour connaitre les périodes en accompagnement
	public function getBySessionAccompagnement($session)
	{
		
		$resultat=array();

		$sql = "
			select 'accompagnement' typeevenement,
				DATE_FORMAT(evenements.datedebut,'%d/%m/%Y') datedebut,
				DATE_FORMAT(evenements.datefin,'%d/%m/%Y') datefin,
				session_accompagnement.duree duree,
				compteheure compteheure,
				evenements.datedebut olddatedebut
			from evenements
				inner join session_accompagnement on session_accompagnement.sessionevenement_id=evenements.id
				inner join session_accompagnement_session on session_accompagnement_session.sessionaccompagnement_id=session_accompagnement.id
			where session_accompagnement_session.session_id=".$session->getId()."
			order by olddatedebut
			";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}


	// utilisation dans le service DorancoCalendrier pour connaitre les périodes en centre avec les accompagnements
	public function getForExportSessionExcel($session)
	{
		
		$resultat=array();

		$sql = "
			select 'module'	as typeevenement,
				DATE_FORMAT(evenements.datedebut,'%d/%m/%Y') datedebut,
				DATE_FORMAT(evenements.datefin,'%d/%m/%Y') datefin,
				session_module.duree duree,
				session_module.id sessionmodule_id,
				true as compteheure,
				evenements.datedebut olddatedebut,
				sessions.intitule session_intitule,
				mo.code module_code,
				mo.intitule module_intitule,
				(select couleur from theme 
					inner join sous_theme_theme stt on stt.theme_id=theme.id 
					inner join module md2 on md2.sousthemetheme=stt.id where md2.id=mo.id) couleur
			from evenements
				inner join session_evenements on session_evenements.id=evenements.id
				inner join session_module on session_module.id=session_evenements.sessionmodule_id
				inner join session_module_bloc on session_module_bloc.sessionmodule_id=session_module.id
				inner join sessions on sessions.id=session_module_bloc.session_id
				inner join module mo on mo.id=session_module.module_id
			where sessions.id=".$session->getId()."
			union
			select 'accompagnement',
				DATE_FORMAT(evenements.datedebut,'%d/%m/%Y'),
				DATE_FORMAT(evenements.datefin,'%d/%m/%Y'),
				session_accompagnement.duree,
				session_accompagnement.id,
				compteheure,
				evenements.datedebut olddatedebut,
				sessions.intitule,
				masterlistelgs.code,
				masterlistelgs.designation,
				null
			from evenements
				inner join session_accompagnement on session_accompagnement.sessionevenement_id=evenements.id
				inner join session_accompagnement_session on session_accompagnement_session.sessionaccompagnement_id=session_accompagnement.id
				inner join sessions on sessions.id=session_accompagnement_session.session_id
				inner join masterlistelgs on masterlistelgs.id=session_accompagnement.typeaccompagnement_id
			where session_accompagnement_session.session_id=".$session->getId()."
			order by olddatedebut
			";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}
	
	public function getForCalendrierOpe($datedebut)
	{
		$resultat=array();
		$conn = $this->_em->getConnection();
		$date=clone $datedebut;
		$resultat[]=[];
		for($i=1;$i<=6;$i++)
		{
			$sql = "
				select evenements.datedebut,
					evenements.datefin,
					'SESSIONMODULE' typeevenement,
					module.code module_code,
					module.intitule module_intitule,
					salles.id salle_id,
					salles.intitule salle_intitule,
					sites.id site_id,
					sites.intitule site_intitule
				from evenements
					inner join session_evenements sev on sev.id=evenements.pere_id
					inner join session_module on session_module.id=sev.sessionmodule_id
					inner join module on module.id=session_module.module_id
					left outer join sessions_salles on sessions_salles.sessionevenement_id=sev.id
					left outer join salles on salles.id=sessions_salles.salle_id
					left outer join sites on sites.id=salles.site_id
				where date(evenements.datedebut)=STR_TO_DATE('".$date->format('Y-m-d')."','%Y-%m-%d')
			";

			$statement = $conn->executeQuery($sql);
			$resultat2 = $statement->fetchAll();
			$resultat[$i]=$resultat2;

			$date->modify('+1 day');
		}

		return $resultat;
	}
	
	public function getApprenants($evenement)
	{
		$resultat=[];

		if(!is_null($evenement)){
			$sql="select dossiers.id dossier_id,
					personnes.id personne_id
				from sessions_dossiers
					inner join session_module_parcours on session_module_parcours.sessiondossier_id=sessions_dossiers.id
					inner join dossiers on dossiers.id=sessions_dossiers.id
					inner join personnes on personnes.id=dossiers.personne_id
				where session_module_parcours.sessionevenement_id=".$evenement->getId()
			;
			$conn = $this->_em->getConnection();
			$statement = $conn->executeQuery($sql);
			$resultat = $statement->fetchAll();
		}

		return $resultat;
	}

	public function getNbApprenants($evenement)
	{
		$resultat=[];
		$resultat['nb_confirmes']=0;
		$resultat['nb_nonconfirmes']=0;
		$resultatsql=[];

		$sql="select apprenantconfirme,
			count(*) combien
			from session_module_parcours
			where sessionevenement_id=".$evenement->getId()."
			group by apprenantconfirme
			";
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultatsql = $statement->fetchAll();
		foreach($resultatsql as $ligne){
			if($ligne['apprenantconfirme']==0){
				$resultat['nb_nonconfirmes']=$ligne['combien'];
			}
			if($ligne['apprenantconfirme']==1){
				$resultat['nb_confirmes']=$ligne['combien'];
			}
		}

		return $resultat;
	}

	public function getAgendaByJour($date)
	{

		$resultat=[];
		$sql="
			select module.id					module_id,
				session_accompagnement.id		session_accompagnement_id,
				(case
					when module.id is not null then module.intitule 
					when session_accompagnement.id is not null then ms2.designation 
					else 'Jury' 
				end) evenement_intitule,
				salles.id						salle_id,
				salles.intitule					salle_intitule,
				sites.id						site_id,
				sites.intitule					site_intitule,
				formateurs.id					formateur_id,
				personal_informations.prenom	formateur_prenom,
				personal_informations.nom		formateur_nom,
				evenements.heuredebut1			heuredebut1,
				evenements.heurefin1			heurefin1,
				evenements.heuredebut2			heuredebut2,
				evenements.heurefin2			heurefin2
			from evenements evenements
				inner join masterlistelgs on evenements.typeevenement_id=masterlistelgs.id
				inner join session_evenements sevent on sevent.id=evenements.pere_id
				left outer join session_module on session_module.id=sevent.sessionmodule_id
				left outer join module on module.id=session_module.module_id
				left outer JOIN sessions_salles on sessions_salles.sessionevenement_id=sevent.id
				left outer join salles on salles.id=sessions_salles.salle_id
				left outer join sites on sites.id=salles.site_id
				left outer join session_accompagnement on session_accompagnement.sessionevenement_id=sevent.id
				left outer join masterlistelgs ms2 on ms2.id=session_accompagnement.typeaccompagnement_id
				left outer join sessions_jurys on sessions_jurys.sessionevenement_id=sevent.id
				left outer join session_formateur on session_formateur.sessionevenement_id=sevent.id
				left outer join formateurs on formateurs.id=session_formateur.formateur_id
				left outer join personal_informations on personal_informations.id=formateurs.id
			where date(evenements.datedebut)=STR_TO_DATE('".$date->format('Y-m-d')."','%Y-%m-%d')
				and (masterlistelgs.code='SESSIONMODULE' or masterlistelgs.code='ACCOMPAGNEMENT' or masterlistelgs.code='SESSIONJURY')
			order by sites.id,salles.id,evenements.datedebut
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

			// une date est-elle un jour férié ou dans une date exceptionnelle ?
	public function getFuture()
	{

		$datenow=(new \DateTime())->format('Y-m-d');

		$sql="
			select *
			from evenements
			where  typeevenement_id in(
				select masterlistelgs.id from masterlistelgs inner join masterlistes on masterlistes.id=masterlistelgs.masterliste_id
				where masterlistes.module='CALENDRIER'
					and masterlistes.code='TYPEEVENEMENT'
					and masterlistelgs.code in('SESSIONMODULE','TYPEEVENEMENT')) and evenements.datedebut > '".$datenow."' ";
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;

	}

	public function getSessionsUnitaires($annee=0)
	{
		$resultat=array();

		$restrict='';
		if($annee != 0){
			$restrict=' and year(datedebut)='.$annee.' ';
		}
		$sql = "
			select 'module'							typesessionunitaire,
				session_module.id					sessionmodule_id,
				session_evenements.id				sessionevenements_id,
				DATE_FORMAT(datedebut, '%d/%m/%Y')	datedebut,
				DATE_FORMAT(datefin, '%d/%m/%Y')	datefin,
				DATE_FORMAT(datedebut, '%Y/%m/%d')	datedebutjs,
				DATE_FORMAT(datefin, '%Y/%m/%d')	datefinjs,
				intitule
			from session_module
				inner join session_evenements on session_evenements.sessionmodule_id=session_module.id
			where sessionunitaire=true ". $restrict."
			union
			select 'certification',
				sessions_certifications.id,
				session_evenements.id,
				DATE_FORMAT(datedebut, '%d/%m/%Y'),
				DATE_FORMAT(datefin, '%d/%m/%Y'),
				DATE_FORMAT(datedebut, '%Y/%m/%d'),
				DATE_FORMAT(datefin, '%Y/%m/%d'),
				intitule
			from sessions_certifications
				inner join session_evenements on session_evenements.id=sessions_certifications.sessionevenement_id
			where sessionunitaire=true ". $restrict."
			union
			select 'jury',
				sessions_jurys.id,
				session_evenements.id,
				DATE_FORMAT(datedebut, '%d/%m/%Y'),
				DATE_FORMAT(datefin, '%d/%m/%Y'),
				DATE_FORMAT(datedebut, '%Y/%m/%d'),
				DATE_FORMAT(datefin, '%Y/%m/%d'),
				concat('JURY',sessions_jurys.id) intitule
			from sessions_jurys
				inner join session_evenements on session_evenements.id=sessions_jurys.sessionevenement_id
			where sessionunitaire=true ". $restrict;
			;

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();
		return $resultat;
	}

	public function getNbApprenantsForCapacite($surcombienjours=90)
	{
		$resultat=array();

		$sql = "
			select ev.id ev_id,
				DATE_FORMAT(ev.datedebut,'%d/%m/%Y') datedebut,
				DATE_FORMAT(ev.datefin,'%d/%m/%Y') datefin,
				sm.id sessionmodule_id,
				module.code module_code,
				module.intitule module_intitule,
				salles.capacite,
				count(*) nb_apprenants
			from session_evenements sev
				inner join evenements ev on ev.id=sev.id
				inner join masterlistelgs as typeev on typeev.id=ev.typeevenement_id
				inner join masterlistes mas on mas.id=typeev.masterliste_id
				inner join session_module_parcours as smp on smp.sessionevenement_id=sev.id
				inner join session_module as sm on sm.id=sev.sessionmodule_id
				inner join module on module.id=sm.module_id
				left outer join (
					select sessionevenement_id,
						sum(capacite) as capacite
					from sessions_salles
						inner join salles on salles.id=sessions_salles.salle_id
					group by sessionevenement_id
					) salles on salles.sessionevenement_id=sev.id
			where datediff(ev.datedebut,now())<=".$surcombienjours."
				and mas.module='CALENDRIER'
				and mas.code='TYPEEVENEMENT'
				and typeev.code='SESSIONMODULE'
				and ev.pere_id is null
				and ev.datedebut>now()
			group by ev.id
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

	public function getNbFormateurs($surcombienjours=30)
	{
		$resultat=array();

		$sql = "
			select ev.id ev_id,
				ev.datedebut,
				ev.datefin,
				sm.id sessionmodule_id,
				module.code module_code,
				module.intitule module_intitule,
				(select count(*) from session_formateur where sessionevenement_id=sev.id) as combien
			from session_evenements sev
				inner join evenements ev on ev.id=sev.id
				inner join masterlistelgs as typeev on typeev.id=ev.typeevenement_id
				inner join masterlistes mas on mas.id=typeev.masterliste_id
				inner join session_module as sm on sm.id=sev.sessionmodule_id
				inner join module on module.id=sm.module_id
			where datediff(ev.datedebut,now())<=".$surcombienjours."
				and mas.module='CALENDRIER'
				and mas.code='TYPEEVENEMENT'
				and typeev.code='SESSIONMODULE'
				and ev.pere_id is null
				and ev.datedebut>now()
			group by ev.id;
		";

		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

	// la liste pour le calendrier
	public function getForCalendar($debut,$fin){

		$resultat=array();

		$sql = "
			select
				evt.id				evenement_id,
				tev.code			typeevenement_code,
				tev.designation		typeevenement_designation,
				sm.intitule			sessionmodule_intitule,
				module.id			module_id,
				module.intitule		module_intitule,
				module.code			module_code,				
				(select max(couleur) from theme inner join sous_theme_theme stt on stt.theme_id=theme.id where module.sousthemetheme=stt.id) couleur,
				evt.datedebut		debut,
				evt.datefin			fin
			from session_evenements sevt
				inner join evenements evt on sevt.id=evt.id
				inner join evenements evtpere on evtpere.id=evt.pere_id
				inner join masterlistelgs tev on tev.id=evt.typeevenement_id
				inner join session_evenements sevpere on sevpere.id=evtpere.id
				inner join session_module sm on sm.id=sevpere.sessionmodule_id
				inner join module on module.id=sm.module_id
			where evt.datedebut between STR_TO_DATE('".$debut."','%Y-%m-%d') and STR_TO_DATE('".$fin."','%Y-%m-%d')
			";
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

	// la liste pour le calendrier
	public function getBySalleAndSemaine($salle,$debut){

		$resultat=array();
		$fin=clone $debut;
		$fin->add(new \DateInterval('P5D'));
		
		$sql = "
			select
				evenements.id		evenement_id
			from session_evenements sevt
				inner join sessions_salles on sessions_salles.sessionevenement_id=sevt.id
				inner join evenements on evenements.id=sevt.id
			where evenements.datedebut between STR_TO_DATE('".$debut->format('Y-m-d')."','%Y-%m-%d') and STR_TO_DATE('".$fin->format('Y-m-d')."','%Y-%m-%d')
				and evenements.pere_id is null
				and sessions_salles.salle_id=".$salle->getId();
		$conn = $this->_em->getConnection();
		$statement = $conn->executeQuery($sql);
		$resultat = $statement->fetchAll();

		return $resultat;
	}

}
