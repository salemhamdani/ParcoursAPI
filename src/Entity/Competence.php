<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Competence
 *
 * @ORM\Table(name="competence")
 * @ORM\Entity(repositoryClass="App\Repository\CompetenceRepository")
 */
class Competence
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
     * @var string
     *
     * @ORM\Column(name="intitule", type="text")
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="critere", type="text", nullable=true)
     */
    private $critere;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $archive;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\User")
    */
    private $quiinsert;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\User")
    */
    private $quiupdate;

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
     * @var string
     *
     * @ORM\Column(name="type", type="text")
     */
    private $type;

    /**
     @ORM\ManyToMany(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $evaluations;
    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $aevaluer;
    
    /**
    * @ORM\OneToMany(targetEntity="App\Entity\BlocCompetence", mappedBy="competence")
    */
    private $bloccompetence;
    
    /**
    * @ORM\OneToMany(targetEntity="App\Entity\ModuleCompetence", mappedBy="competence")
    */
    private $modulecompetences;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Formateur",cascade={"persist"})
     */
    private $formateur;

       /**
     * Constructor
     */
    public function __construct()
    {
        $this->archive = false;

        $this->evaluations = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Competence
     */
    public function setArchive($archive)
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get archive
     *
     * @return boolean
     */
    public function getArchive()
    {
        return $this->archive;
    }

    /**
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return Competence
     */
    public function setDateinsert($dateinsert)
    {
        $this->dateinsert = $dateinsert;

        return $this;
    }

    /**
     * Get dateinsert
     *
     * @return \DateTime
     */
    public function getDateinsert()
    {
        return $this->dateinsert;
    }

    /**
     * Set dateupdate
     *
     * @param \DateTime $dateupdate
     *
     * @return Competence
     */
    public function setDateupdate($dateupdate)
    {
        $this->dateupdate = $dateupdate;

        return $this;
    }

    /**
     * Get dateupdate
     *
     * @return \DateTime
     */
    public function getDateupdate()
    {
        return $this->dateupdate;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Competence
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string
     */
    public function getIntitule()
    {
        return $this->intitule;
    }
    /**
     * Set critere
     *
     * @param string $critere
     *
     * @return Competence
     */
    public function setCritere($critere)
    {
        $this->critere = $critere;

        return $this;
    }

    /**
     * Get critere
     *
     * @return string
     */
    public function getCritere()
    {
        return $this->critere;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Competence
     */
    public function setQuiinsert(\App\Entity\User $quiinsert = null)
    {
        $this->quiinsert = $quiinsert;

        return $this;
    }

    /**
     * Get quiinsert
     *
     * @return \App\Entity\User
     */
    public function getQuiinsert()
    {
        return $this->quiinsert;
    }

    /**
     * Set quiupdate
     *
     * @param \App\Entity\User $quiupdate
     *
     * @return Competence
     */
    public function setQuiupdate(\App\Entity\User $quiupdate = null)
    {
        $this->quiupdate = $quiupdate;

        return $this;
    }

    /**
     * Get quiupdate
     *
     * @return \App\Entity\User
     */
    public function getQuiupdate()
    {
        return $this->quiupdate;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Competence
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * Add evaluation
     *
     * @param \App\Entity\Masterlistelg $evaluation
     *
     * @return Entreprise
     */
    public function addEvaluation(\App\Entity\Masterlistelg $evaluation)
    {
        $this->evaluations[] = $evaluation;

        return $this;
    }

    /**
     * Remove evaluation
     *
     * @param \App\Entity\Masterlistelg $evaluation
     */
    public function removeEvaluation(\App\Entity\Masterlistelg $evaluation)
    {
        $this->evaluations->removeElement($evaluation);
    }

    /**
     * Get evaluations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvaluations()
    {
        return $this->evaluations;
    }
  /**
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return Competence
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer
     */
    public function getOrdre()
    {
        return $this->ordre;
    }


    /**
     * Set aevaluer
     *
     * @param boolean $aevaluer
     *
     * @return Competence
     */
    public function setAevaluer($aevaluer)
    {
        $this->aevaluer = $aevaluer;

        return $this;
    }

    /**
     * Get aevaluer
     *
     * @return boolean
     */
    public function getAevaluer()
    {
        return $this->aevaluer; 
    }


    /**
     * Add bloccompetence
     *
     * @param \App\Entity\BlocCompetence $bloccompetence
     *
     * @return Competence
     */
    public function addBloccompetence(\App\Entity\BlocCompetence $bloccompetence)
    {
        $this->bloccompetence[] = $bloccompetence;

        return $this;
    }

    /**
     * Remove bloccompetence
     *
     * @param \App\Entity\BlocCompetence $bloccompetence
     */
    public function removeBloccompetence(\App\Entity\BlocCompetence $bloccompetence)
    {
        $this->bloccompetence->removeElement($bloccompetence);
    }

    /**
     * Get bloccompetence
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBloccompetence()
    {
        return $this->bloccompetence;
    }

    /**
     * Add modulecompetence
     *
     * @param \App\Entity\ModuleCompetence $modulecompetence
     *
     * @return Competence
     */
    public function addModulecompetence(\App\Entity\ModuleCompetence $modulecompetence)
    {
        $this->modulecompetences[] = $modulecompetence;

        return $this;
    }

    /**
     * Remove modulecompetence
     *
     * @param \App\Entity\ModuleCompetence $modulecompetence
     */
    public function removeModulecompetence(\App\Entity\ModuleCompetence $modulecompetence)
    {
        $this->modulecompetences->removeElement($modulecompetence);
    }

    /**
     * Get modulecompetences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModulecompetences()
    {
        return $this->modulecompetences;
    }

    /**
     * Set formateur
     *
     * @param \App\Entity\Formateur $formateur
     *
     * @return Competence
     */
    public function setFormateur(\App\Entity\Formateur $formateur = null)
    {
        $this->formateur = $formateur;

        return $this;
    }

    /**
     * Get formateur
     *
     * @return \App\Entity\Formateur
     */
    public function getFormateur()
    {
        return $this->formateur;
    }
}
