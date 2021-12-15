<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dossierannexes
 *
 * @ORM\Table(name="dossierannexes")
 * @ORM\Entity(repositoryClass="App\Repository\DossierannexesRepository")
 */
class Dossierannexes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $NiveauxEtudes;


    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $Diplome;


    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $Situation;



    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $Categorie;



    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $Provenance;

   
    /**
     * @var string
     *
     * @ORM\Column(name="cp_descripteur", type="string", length=65, nullable=true)
     */
    private $cpDescripteur;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Niveau")
    */
    private $niveau;

    /**
     * @var string
     *
     * @ORM\Column(name="dernier_metier_occupe_de", type="string", length=255, nullable=true)
     */
    private $dernierMetierOccupeDe;

    /**
     * @var string
     *
     * @ORM\Column(name="metier_vise_de", type="string", length=255, nullable=true)
     */
    private $metierViseDe;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $reunionPoleEmploi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_inscription_pole_emploi", type="date", nullable=true)
     */
    private $dateInscriptionPoleEmploi;

    /**
     * @var string
     *
     * @ORM\Column(name="annee_sortie_systeme_scolaire_de", type="string", length=255, nullable=true)
     */
    private $anneeSortieSystemeScolaireDe;

    /**
     * @var string
     *
     * @ORM\Column(name="duree_experience_professionnelle_de", type="string", length=255, nullable=true)
     */
    private $dureeExperienceProfessionnelleDe; 


    /**
     * @var string
     *
     * @ORM\Column(name="intitule_dernier_diplome", type="string", length=255, nullable=true)
     */
    private $intituleDernierDiplome;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_diplome", type="string", length=255, nullable=true)
     */
    private $EtatDiplome;

    /**
     * @var string
     *
     * @ORM\Column(name="num_pole_emploi", type="string", length=255, nullable=true)
     */
    private $numPoleEmploi;

    /**
     * @var int
     *
     * @ORM\Column(name="contrat_csp", type="integer", nullable=true)
     */
    private $contratCsp;
    
    /**
     * @var int
     *
     * @ORM\Column(name="mobiliser_contrat_csp", type="integer", nullable=true)
     */
    private $mobiliserContratCsp;
    
    /**
     * @var int
     *
     * @ORM\Column(name="offre_personnel", type="boolean", nullable=true)
     */
    private $offrePersonnel;
   /**
     * @var string
     *
     * @ORM\Column(name="metier_occupe", type="string", length=255, nullable=true)
     */
    private $metierOccupe;
    /**
     * @var string
     *
     * @ORM\Column(name="heuresCPF", type="string", length=255, nullable=true)
     */
    private $heuresCPF;

    /**
     * @var string
     *
     * @ORM\Column(name="nationalDE", type="string", length=255, nullable=true)
     */
    private $nationalDE;

    /**
     * @var string
     *
     * @ORM\Column(name="ProjetAction", type="string", length=255, nullable=true)
     */
    private $ProjetAction;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $statepoleemploi ;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $inscriptionpoleemploi;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $modeinscription;

    /**
     * @var bool
     *
     * @ORM\Column(name="crif", type="boolean", nullable=true)
     */
    private $crif = false;

    /**
     * @var string
     *
     * @ORM\Column(name="fonction", type="string", length=255, nullable=true)
     */
    private $fonction;

    /**
     * @var string
     *
     * @ORM\Column(name="ligneDirect", type="string", length=255, nullable=true)
     */
    private $ligneDirect;


 /**
     * Constructor
     */
    public function __construct() {
       
    }


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set cpDescripteur
     *
     * @param string $cpDescripteur
     *
     * @return Dossierannexes
     */
    public function setCpDescripteur($cpDescripteur) {
        $this->cpDescripteur = $cpDescripteur;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return \App\Entity\Niveau
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set dernierMetierOccupeDe
     *
     * @param string $dernierMetierOccupeDe
     *
     * @return Dossierannexes
     */
    public function setDernierMetierOccupeDe($dernierMetierOccupeDe) {
        $this->dernierMetierOccupeDe = $dernierMetierOccupeDe;

        return $this;
    }

    /**
     * Get dernierMetierOccupeDe
     *
     * @return string
     */
    public function getDernierMetierOccupeDe() {
        return $this->dernierMetierOccupeDe;
    }




    /**
     * Set metierOccupe
     *
     * @param string $metierOccupe
     *
     * @return Dossierannexes
     */
    public function setMetierOccupe($metierOccupe) {
        $this->metierOccupe = $metierOccupe;

        return $this;
    }

    /**
     * Get metierOccupe
     *
     * @return string
     */
    public function getMetierOccupe() {
        return $this->metierOccupe;
    }

    /**
     * Set metierViseDe
     *
     * @param string $metierViseDe
     *
     * @return Dossierannexes
     */
    public function setMetierViseDe($metierViseDe) {
        $this->metierViseDe = $metierViseDe;

        return $this;
    }

    /**
     * Get metierViseDe
     *
     * @return string
     */
    public function getMetierViseDe() {
        return $this->metierViseDe;
    }

    /**
     * Set dateInscriptionPoleEmploi
     *
     * @param \DateTime $dateInscriptionPoleEmploi
     *
     * @return Dossierannexes
     */
    public function setDateInscriptionPoleEmploi($dateInscriptionPoleEmploi) {

        $this->dateInscriptionPoleEmploi = $dateInscriptionPoleEmploi;

        return $this;
    }

    /**
     * Get dateInscriptionPoleEmploi
     *
     * @return \DateTime
     */
    public function getDateInscriptionPoleEmploi() {

            return $this->dateInscriptionPoleEmploi;
        
    }

    /**
     * Set reunionPoleEmploi
     *
     * @param \App\Entity\Masterlistelg $reunionPoleEmploi
     *
     * @return Dossierannexes
     */
    public function setReunionPoleEmploi(\App\Entity\Masterlistelg $reunionPoleEmploi = null)
    {
        $this->reunionPoleEmploi = $reunionPoleEmploi;

        return $this;
    }

    /**
     * Get reunionPoleEmploi
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getReunionPoleEmploi()
    {
        return $this->reunionPoleEmploi;
    }

    /**
     * Set anneeSortieSystemeScolaireDe
     *
     * @param string $anneeSortieSystemeScolaireDe
     *
     * @return Dossierannexes
     */
    public function setAnneeSortieSystemeScolaireDe($anneeSortieSystemeScolaireDe) {
        $this->anneeSortieSystemeScolaireDe = $anneeSortieSystemeScolaireDe;

        return $this;
    }

    /**
     * Get anneeSortieSystemeScolaireDe
     *
     * @return string
     */
    public function getAnneeSortieSystemeScolaireDe() {
        return $this->anneeSortieSystemeScolaireDe;
    }

    /**
     * Set dureeExperienceProfessionnelleDe
     *
     * @param string $dureeExperienceProfessionnelleDe
     *
     * @return Dossierannexes
     */
    public function setDureeExperienceProfessionnelleDe($dureeExperienceProfessionnelleDe) {
        $this->dureeExperienceProfessionnelleDe = $dureeExperienceProfessionnelleDe;

        return $this;
    }

    /**
     * Get dureeExperienceProfessionnelleDe
     *
     * @return string
     */
    public function getDureeExperienceProfessionnelleDe() {
        return $this->dureeExperienceProfessionnelleDe;
    }

    /**
     * Set intituleDernierDiplome
     *
     * @param string $intituleDernierDiplome
     *
     * @return Dossierannexes
     */
    public function setIntituleDernierDiplome($intituleDernierDiplome) {
        $this->intituleDernierDiplome = $intituleDernierDiplome;

        return $this;
    }

    /**
     * Get intituleDernierDiplome
     *
     * @return string
     */
    public function getIntituleDernierDiplome() {
        return $this->intituleDernierDiplome;
    }

    /**
     * Set etatDiplome
     *
     * @param string $etatDiplome
     *
     * @return Dossierannexes
     */
    public function setEtatDiplome($etatDiplome) {
        $this->EtatDiplome = $etatDiplome;

        return $this;
    }

    /**
     * Get etatDiplome
     *
     * @return string
     */
    public function getEtatDiplome() {
        return $this->EtatDiplome;
    }

    /**
     * Set numPoleEmploi
     *
     * @param string $numPoleEmploi
     *
     * @return Dossierannexes
     */
    public function setNumPoleEmploi($numPoleEmploi) {
        $this->numPoleEmploi = $numPoleEmploi;

        return $this;
    }

    /**
     * Get numPoleEmploi
     *
     * @return string
     */
    public function getNumPoleEmploi() {
        return $this->numPoleEmploi;
    }

    /**
     * Set contratCsp
     *
     * @param integer $contratCsp
     *
     * @return Dossierannexes
     */
    public function setContratCsp($contratCsp) {
        $this->contratCsp = $contratCsp;

        return $this;
    }

    /**
     * Get contratCsp
     *
     * @return integer
     */
    public function getContratCsp() {
        return $this->contratCsp;
    }

    /**
     * Set offrePersonnel
     *
     * @param integer $offrePersonnel
     *
     * @return Dossierannexes
     */
    public function setOffrePersonnel($offrePersonnel) {
        $this->offrePersonnel = $offrePersonnel;

        return $this;
    }

    /**
     * Get offrePersonnel
     *
     * @return integer
     */
    public function getOffrePersonnel() {
        return $this->offrePersonnel;
    }

    /**
     * Set NiveauxEtudes
     *
     * @param \App\Entity\Masterlistelg $NiveauxEtudes
     *
     * @return Dossierannexes
     */
    public function setNiveauxEtudes(\App\Entity\Masterlistelg $NiveauxEtudes = null)
    {
        $this->NiveauxEtudes = $NiveauxEtudes;

        return $this;
    }

    /**
     * Get NiveauxEtudes
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getNiveauxEtudes()
    {
        return $this->NiveauxEtudes;
    }

    /**
     * Set Diplome
     *
     * @param \App\Entity\Masterlistelg $Diplome
     *
     * @return Dossierannexes
     */
    public function SetDiplome(\App\Entity\Masterlistelg $Diplome = null)
    {
        $this->Diplome = $Diplome;

        return $this;
    }

    /**
     * Get Diplome
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getDiplome()
    {
        return $this->Diplome;
    }
    


    /**
     * Set Situation
     *
     * @param \App\Entity\Masterlistelg $Situation
     *
     * @return Dossierannexes
     */
    public function setSituation(\App\Entity\Masterlistelg $Situation = null)
    {
        $this->Situation = $Situation;

        return $this;
    }

    /**
     * Get Situation
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getSituation()
    {
        return $this->Situation;
    }
    


    /**
     * Set Categorie
     *
     * @param \App\Entity\Masterlistelg $Categorie
     *
     * @return Dossierannexes
     */
    public function setCategorie(\App\Entity\Masterlistelg $Categorie = null)
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    /**
     * Get Categorie
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getCategorie()
    {
        return $this->Categorie;
    }

    /**
     * Set Provenance
     *
     * @param \App\Entity\Masterlistelg $Provenance
     *
     * @return Dossierannexes
     */
    public function setProvenance(\App\Entity\Masterlistelg $Provenance = null)
    {
        $this->Provenance = $Provenance;

        return $this;
    }

    /**
     * Get Provenance
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getProvenance()
    {
        return $this->Provenance;
    }


    /**
     * Set nationalDE
     *
     * @param string $nationalDE
     *
     * @return Dossierannexes
     */
    public function setNationalDE($nationalDE)
    {
        $this->nationalDE = $nationalDE;

        return $this;
    }

    /**
     * Get nationalDE
     *
     * @return string
     */
    public function getNationalDE()
    {
        return $this->nationalDE;
    }


    /**
     * Set ProjetAction
     *
     * @param string $ProjetAction
     *
     * @return Dossierannexes
     */
    public function setProjetAction($ProjetAction)
    {
        $this->ProjetAction = $ProjetAction;

        return $this;
    }

    /**
     * Get ProjetAction
     *
     * @return string
     */
    public function getProjetAction()
    {
        return $this->ProjetAction;
    }


    /**
     * Set statepoleemploi
     *
     * @param \App\Entity\Masterlistelg $statepoleemploi
     *
     * @return Dossierannexes
     */
    public function setStatePoleemploi(\App\Entity\Masterlistelg $statepoleemploi = null)
    {
        $this->statepoleemploi = $statepoleemploi;

        return $this;
    }

    /**
     * Get statepoleemploi
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getStatePoleemploi()
    {
        return $this->statepoleemploi;
    }

    /**
     * Set inscriptionpoleemploi
     *
     * @param \App\Entity\Masterlistelg $inscriptionpoleemploi
     *
     * @return Dossierannexes
     */
    public function setInscriptionpoleemploi(\App\Entity\Masterlistelg $inscriptionpoleemploi = null)
    {
        $this->inscriptionpoleemploi = $inscriptionpoleemploi;

        return $this;
    }

    /**
     * Get inscriptionpoleemploi
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getInscriptionpoleemploi()
    {
        return $this->inscriptionpoleemploi;
    }

    /**
     * Set modeinscription
     *
     * @param \App\Entity\Masterlistelg $modeinscription
     *
     * @return Dossierannexes
     */
    public function setModeinscription(\App\Entity\Masterlistelg $modeinscription = null)
    {
        $this->modeinscription = $modeinscription;

        return $this;
    }

    /**
     * Get modeinscription
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getModeinscription()
    {
        return $this->modeinscription;
    }

    /**
     * Set crif
     *
     * @param boolean $crif
     *
     * @return Dossierannexes
     */
    public function setCrif($crif)
    {
        $this->crif = $crif;

        return $this;
    }

    /**
     * Get crif
     *
     * @return boolean
     */
    public function getCrif()
    {
        return $this->crif;
    }

    /**
     * Set fonction
     *
     * @param string $fonction
     *
     * @return Dossierannexes
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return string
     */
    public function getFonction()
    {
        return $this->fonction;
    }



    /**
     * Set ligneDirect
     *
     * @param string $ligneDirect
     *
     * @return Dossierannexes
     */
    public function setLigneDirect($ligneDirect)
    {
        $this->ligneDirect = $ligneDirect;

        return $this;
    }

    /**
     * Get ligneDirect
     *
     * @return string
     */
    public function getLigneDirect()
    {
        return $this->ligneDirect;
    }


    /**
     * Set mobiliserContratCsp
     *
     * @param string $mobiliserContratCsp
     *
     * @return Dossierannexes
     */
    public function setMobiliserContratCsp($mobiliserContratCsp)
    {
        $this->mobiliserContratCsp = $mobiliserContratCsp;

        return $this;
    }

    /**
     * Get mobiliserContratCsp
     *
     * @return string
     */
    public function getMobiliserContratCsp()
    {
        return $this->mobiliserContratCsp;
    }


    

  

}
