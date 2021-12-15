<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ModaliteEvaluation
 *
 * @ORM\Table(name="modaliteevaluation")
 * @ORM\Entity(repositoryClass="App\Repository\ModaliteEvaluationRepository")
 */
class ModaliteEvaluation
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
     * @ORM\Column(name="duree", type="string", length=250)
     */
    private $duree;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

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
    * @ORM\OneToMany(targetEntity="App\Entity\ModaliteEvaluationCompetence", mappedBy="modaliteevaluation")
    */
    private $modaliteevaluationcompetences;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Parcours", cascade={"persist"})
     * @ORM\JoinColumn(name="parcours", nullable=true)
     */
    private $parcours;

    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre = 0;


       /**
     * Constructor
     */
    public function __construct()
    {
        $this->archive = false;
        $this->modaliteevaluationcompetences = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ModaliteEvaluation
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
     * @return ModaliteEvaluation
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
     * @return ModaliteEvaluation
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
     * @return ModaliteEvaluation
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
     * Set duree
     *
     * @param string $duree
     *
     * @return ModaliteEvaluation
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return ModaliteEvaluation
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
     * @return ModaliteEvaluation
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
     * Set description
     *
     * @param string $description
     *
     * @return ModaliteEvaluation
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }


 /**
     * Set parcours
     *
     * @param \App\Entity\Parcours $parcours
     *
     * @return ModaliteEvaluation
     */
    public function setParcours(\App\Entity\Parcours $parcours = null)
    {
        $this->parcours = $parcours;

        return $this;
    }

    /**
     * Get parcours
     *
     * @return \App\Entity\Parcours
     */
    public function getParcours()
    {
        return $this->parcours;
    }

    /**
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return ModaliteEvaluation
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
     * Add modaliteevaluationcompetences
     *
     * @param \App\Entity\ModaliteEvaluationCompetence $modaliteevaluationcompetences
     *
     * @return Bloc
     */
    public function addModaliteEvaluationCompetence(\App\Entity\ModaliteEvaluationCompetence $modaliteevaluationcompetence)
    {
        $this->modaliteevaluationcompetences[] = $modaliteevaluationcompetences;
        $blocmodule->setBloc($this);
        return $this;
    }

    /**
     * Remove modaliteevaluationcompetence
     *
     * @param \App\Entity\ModaliteEvaluationCompetence $modaliteevaluationcompetence
     */
    public function removeModaliteEvaluationCompetence(\App\Entity\ModaliteEvaluationCompetence $modaliteevaluationcompetence)
    {
        $this->modaliteevaluationcompetences->removeElement($modaliteevaluationcompetence);
    }


    public function clearModaliteEvaluationCompetence()
    {
    $this->modaliteevaluationcompetences->clear();
    }


    /**
     * Get modaliteevaluationcompetences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModaliteEvaluationCompetences()
    {
        return $this->modaliteevaluationcompetences;
    }

}
