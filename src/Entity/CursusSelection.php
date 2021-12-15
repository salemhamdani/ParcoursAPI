<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CursusSelection
 *
 * @ORM\Table(name="cursusselection")
 * @ORM\Entity(repositoryClass="App\Repository\CursusSelectionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CursusSelection {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \stdClass
     * @ORM\ManyToOne(targetEntity="App\Entity\Employe")
     */
    private $examinateur;

    /**
     * @var \stdClass
     * @ORM\ManyToOne(targetEntity="App\Entity\Employe")
     */
    private $reoriente;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $recontacte;
  
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cursus", inversedBy="selection",cascade={"persist"})
     */
    private $cursus;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\CursusReponse", mappedBy="cursusselection", orphanRemoval=true, cascade={"all"})
    */
    private $reponse;

    /**
     * @var \Date
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateEntretien;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Salle")
     */
    private $salle;
    
    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $heuredebut;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $evaluationprofil;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $appreciation;
    
    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $observations;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $resultat;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $raisonresultat;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $motifrefus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateinsert;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateupdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $quand;

    /**
     * @var boolean 
     *
     * @ORM\Column(name="vehicule", type="boolean", nullable=true)
     */
    private $vehicule;

    /**
     * @var boolean 
     *
     * @ORM\Column(name="cvtheque", type="boolean", nullable=true)
     */
    private $cvtheque;


    /**
     * @var boolean 
     *
     * @ORM\Column(name="permis", type="boolean", nullable=true)
     */
    private $permis;

    /**
     * @var boolean 
     *
     * @ORM\Column(name="virtuel", type="boolean", nullable=true)
     */
    private $virtuel;

    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\PrePersist
     */
    public function ajout()
    {
        $this->dateinsert = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function modification()
    {
        $this->dateupdate = new \DateTime();
    }

    /**
     * Set dateEntretien.
     *
     * @param \DateTime|null $dateEntretien
     *
     * @return CursusSelection
     */
    public function setDateEntretien($dateEntretien = null)
    {
        $this->dateEntretien = $dateEntretien;

        return $this;
    }

    /**
     * Get dateEntretien.
     *
     * @return \DateTime|null
     */
    public function getDateEntretien()
    {
        return $this->dateEntretien;
    }

    /**
     * Set commentaire.
     *
     * @param string|null $commentaire
     *
     * @return CursusSelection
     */
    public function setCommentaire($commentaire = null)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire.
     *
     * @return string|null
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set observations.
     *
     * @param string|null $observations
     *
     * @return CursusSelection
     */
    public function setObservations($observations = null)
    {
        $this->observations = $observations;

        return $this;
    }

    /**
     * Get observations.
     *
     * @return string|null
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * Set heuredebut.
     *
     * @param \DateTime|null $heuredebut
     *
     * @return CursusSelection
     */
    public function setHeuredebut($heuredebut = null)
    {
        $this->heuredebut = $heuredebut;

        return $this;
    }

    /**
     * Get heuredebut.
     *
     * @return \DateTime|null
     */
    public function getHeuredebut()
    {
        return $this->heuredebut;
    }

    /**
     * Set dateinsert.
     *
     * @param \DateTime|null $dateinsert
     *
     * @return CursusSelection
     */
    public function setDateinsert($dateinsert = null)
    {
        $this->dateinsert = $dateinsert;

        return $this;
    }

    /**
     * Get dateinsert.
     *
     * @return \DateTime|null
     */
    public function getDateinsert()
    {
        return $this->dateinsert;
    }

    /**
     * Set dateupdate.
     *
     * @param \DateTime|null $dateupdate
     *
     * @return CursusSelection
     */
    public function setDateupdate($dateupdate = null)
    {
        $this->dateupdate = $dateupdate;

        return $this;
    }

    /**
     * Get dateupdate.
     *
     * @return \DateTime|null
     */
    public function getDateupdate()
    {
        return $this->dateupdate;
    }

    /**
     * Set quand.
     *
     * @param \DateTime|null $quand
     *
     * @return CursusSelection
     */
    public function setQuand($quand = null)
    {
        $this->quand = $quand;

        return $this;
    }

    /**
     * Get quand.
     *
     * @return \DateTime|null
     */
    public function getQuand()
    {
        return $this->quand;
    }

    /**
     * Set cursus.
     *
     * @param \App\Entity\Cursus|null $cursus
     *
     * @return CursusSelection
     */
    public function setCursus(\App\Entity\Cursus $cursus = null)
    {
        $this->cursus = $cursus;

        return $this;
    }

    /**
     * Get cursus.
     *
     * @return \App\Entity\Cursus|null
     */
    public function getCursus()
    {
        return $this->cursus;
    }

    /**
     * Set salle.
     *
     * @param \App\Entity\Salle|null $salle
     *
     * @return CursusSelection
     */
    public function setSalle(\App\Entity\Salle $salle = null)
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * Get salle.
     *
     * @return \App\Entity\Salle|null
     */
    public function getSalle()
    {
        return $this->salle;
    }

    /**
     * Set evaluationprofil.
     *
     * @param \App\Entity\Masterlistelg|null $evaluationprofil
     *
     * @return CursusSelection
     */
    public function setEvaluationprofil(\App\Entity\Masterlistelg $evaluationprofil = null)
    {
        $this->evaluationprofil = $evaluationprofil;

        return $this;
    }

    /**
     * Get evaluationprofil.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getEvaluationprofil()
    {
        return $this->evaluationprofil;
    }

    /**
     * Set appreciation.
     *
     * @param \App\Entity\Masterlistelg|null $appreciation
     *
     * @return CursusSelection
     */
    public function setAppreciation(\App\Entity\Masterlistelg $appreciation = null)
    {
        $this->appreciation = $appreciation;

        return $this;
    }

    /**
     * Get appreciation.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getAppreciation()
    {
        return $this->appreciation;
    }

    /**
     * Set resultat.
     *
     * @param \App\Entity\Masterlistelg|null $resultat
     *
     * @return CursusSelection
     */
    public function setResultat(\App\Entity\Masterlistelg $resultat = null)
    {
        $this->resultat = $resultat;

        return $this;
    }

    /**
     * Get resultat.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getResultat()
    {
        return $this->resultat;
    }

    /**
     * Set raisonresultat.
     *
     * @param \App\Entity\Masterlistelg|null $raisonresultat
     *
     * @return CursusSelection
     */
    public function setRaisonresultat(\App\Entity\Masterlistelg $raisonresultat = null)
    {
        $this->raisonresultat = $raisonresultat;

        return $this;
    }

    /**
     * Get raisonresultat.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getRaisonresultat()
    {
        return $this->raisonresultat;
    }

    /**
     * Set motifrefus.
     *
     * @param \App\Entity\Masterlistelg|null $motifrefus
     *
     * @return CursusSelection
     */
    public function setMotifrefus(\App\Entity\Masterlistelg $motifrefus = null)
    {
        $this->motifrefus = $motifrefus;

        return $this;
    }

    /**
     * Get motifrefus.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getMotifrefus()
    {
        return $this->motifrefus;
    }

    /**
     * Set examinateur
     *
     * @param \App\Entity\Employe $examinateur
     *
     * @return CursusSelection
     */
    public function setExaminateur(\App\Entity\Employe $examinateur = null)
    {
        $this->examinateur = $examinateur;

        return $this;
    }

    /**
     * Get examinateur
     *
     * @return \App\Entity\Employe
     */
    public function getExaminateur()
    {
        return $this->examinateur;
    }

    /**
     * Get nameexaminateur
     *
     */
    public function getExaminateurFullName()
    {   
        if(!is_null($this->examinateur) and ! is_null($this->examinateur->getPersonalInformations()))
        return $this->examinateur->getPersonalInformations()->getFullName();
        else return 'null';
    }


    /**
     * Set reoriente
     *
     * @param \App\Entity\Employe $reoriente
     *
     * @return CursusSelection
     */
    public function setReoriente(\App\Entity\Employe $reoriente = null)
    {
        $this->reoriente = $reoriente;

        return $this;
    }

    /**
     * Get reoriente
     *
     * @return \App\Entity\Employe
     */
    public function getReoriente()
    {
        return $this->reoriente;
    }


    /**
     * Set recontacte.
     *
     * @param \App\Entity\Masterlistelg|null $recontacte
     *
     * @return CursusSelection
     */
    public function setRecontacte(\App\Entity\Masterlistelg $recontacte = null)
    {
        $this->recontacte = $recontacte;

        return $this;
    }

    /**
     * Get recontacte.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getRecontacte()
    {
        return $this->recontacte;
    }


    /**
     * Add reponse.
     *
     * @param \App\Entity\CursusReponse $reponse
     *
     * @return CursusSelection
     */
    public function addReponse(\App\Entity\CursusReponse $reponse)
    {
        $this->reponse[] = $reponse;
        $reponse->setCursusSelection($this);
        return $this;
    }

    /**
     * Remove reponse.
     *
     * @param \App\Entity\CursusReponse $selection
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeReponse(\App\Entity\CursusReponse $reponse)
    {
        return $this->reponse->removeElement($reponse);
    }

    /**
     * Get reponse.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set permis
     *
     * @param boolean $permis
     *
     * @return CursusSelection
     */
    public function setPermis($permis) {
        $this->permis = $permis;

        return $this;
    }

    /**
     * Get posteStapermistut
     *
     * @return boolean
     */
    public function getPermis() {
        return $this->permis;
    }

    /**
     * Set virtuel
     *
     * @param boolean $virtuel
     *
     * @return CursusSelection
     */
    public function setVirtuel($virtuel) {
        $this->virtuel = $virtuel;

        return $this;
    }

    /**
     * Get virtuel
     *
     * @return boolean
     */
    public function getVirtuel() {
        return $this->virtuel;
    }
    
    /**
     * Set cvtheque
     *
     * @param boolean $vehicule
     *
     * @return CursusSelection
     */
    public function setVehicule($vehicule) {
        $this->vehicule = $vehicule;

        return $this;
    }

    /**
     * Get posteStapermistut
     *
     * @return boolean
     */
    public function getVehicule() {
        return $this->vehicule;
    }
    
    /**
     * Set cvtheque
     *
     * @param boolean $cvtheque
     *
     * @return CursusSelection
     */
    public function setCvtheque($cvtheque) {
        $this->cvtheque = $cvtheque;

        return $this;
    }

    /**
     * Get posteStapermistut
     *
     * @return boolean
     */
    public function getCvtheque() {
        return $this->cvtheque;
    }
    

 
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reponse = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
