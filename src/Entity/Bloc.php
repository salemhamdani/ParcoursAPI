<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Bloc
 *
 * @ORM\Table(name="bloc")
 * @ORM\Entity(repositoryClass="App\Repository\BlocRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields={"intitule", "parcours"}, message="Ce bloc de compétence existe déjà dans ce parcours.")
 */
class Bloc
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bloccompetences = new \Doctrine\Common\Collections\ArrayCollection();
        $this->blocmodules = new \Doctrine\Common\Collections\ArrayCollection();
        $this->archive = false;
        $this->ordre = 0;
    }

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\BlocCompetence", mappedBy="bloc")
    */
    private $bloccompetences;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\BlocModule", mappedBy="bloc")
    */
    private $blocmodules;

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
     * @ORM\Column(name="commentaires", type="text", nullable=true)
     */
    private $commentaires;

    /**
     * @var int
     *
     * @ORM\Column(name="ects", type="integer", nullable=true)
     */
    private $ects;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type=0; // 0 = bloc de compétence / 1 =  UE / 2 = enchainement


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
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Bloc")
    */
    private $blocref;


    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Parcours", cascade={"persist"}, inversedBy="blocs")
     * @ORM\JoinColumn(name="parcours", nullable=true)
     */
    private $parcours;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=255)
     * @Assert\Length(min=2, minMessage="L'intitulé doit faire au moins {{ limit }} caractères.")
     * @Assert\NotBlank(message="L'intitulé est obligatoire.")
     */
    private $intitule;

    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre;


    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Bloc
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
     * @return Bloc
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
     * @return Bloc
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set blocref
     *
     * @param \App\Entity\Bloc $blocref
     *
     * @return Bloc
     */
    public function setBlocref(\App\Entity\Bloc $blocref = null)
    {
        $this->blocref = $blocref;

        return $this;
    }

    /**
     * Get blocref
     *
     * @return \App\Entity\Bloc
     */
    public function getBlocref()
    {
        return $this->blocref;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Bloc
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
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return Bloc
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
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Bloc
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
     * @return Bloc
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
     * Set parcours
     *
     * @param \App\Entity\Parcours $parcours
     *
     * @return Bloc
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
     * Add bloccompetence
     *
     * @param \App\Entity\Bloccompetence $bloccompetence
     *
     * @return Bloc
     */
    public function addBloccompetence(\App\Entity\BlocCompetence $bloccompetence)
    {
        $this->bloccompetences[] = $bloccompetence;
        $bloccompetence->setBloc($this);
        return $this;
    }

    /**
     * Remove bloccompetence
     *
     * @param \App\Entity\Bloccompetence $bloccompetence
     */
    public function removeBloccompetence(\App\Entity\BlocCompetence $bloccompetence)
    {
        $this->bloccompetences->removeElement($bloccompetence);
    }

    /**
     * Get bloccompetences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBloccompetences()
    {
        return $this->bloccompetences;
    }

    /**
     * Add blocmodule
     *
     * @param \App\Entity\Blocmodule $blocmodule
     *
     * @return Bloc
     */
    public function addBlocmodule(\App\Entity\BlocModule $blocmodule)
    {
        $this->blocmodules[] = $blocmodule;
        $blocmodule->setBloc($this);
        return $this;
    }

    /**
     * Remove blocmodule
     *
     * @param \App\Entity\Blocmodule $blocmodule
     */
    public function removeBlocmodule(\App\Entity\BlocModule $blocmodule)
    {
        $this->blocmodules->removeElement($blocmodule);
    }


    public function clearBlocmodules()
    {
    $this->blocmodules->clear();
    }


    /**
     * Get blocmodules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBlocmodules()
    {
        return $this->blocmodules;
    }

    /**
     * Set ects
     *
     * @param integer $ects
     *
     * @return Bloc
     */
    public function setEcts($ects)
    {
        $this->ects = $ects;

        return $this;
    }

    /**
     * Get ects
     *
     * @return int
     */
    public function getEcts()
    {
        return $this->ects;
    }   


    /**
     * Set commentaires
     *
     * @param string $commentaires
     *
     * @return Competence
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    /**
     * Get commentaires
     *
     * @return string
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }


    /**
     * Set type
     *
     * @param integer $type
     *
     * @return Bloc
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }


}
