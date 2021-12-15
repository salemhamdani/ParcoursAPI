<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * BlocCompetence
 *
 * @ORM\Table(name="bloc_competences")
 * @ORM\Entity(repositoryClass="App\Repository\BlocCompetenceRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class BlocCompetence
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
	* @ORM\ManyToOne(targetEntity="App\Entity\Bloc", inversedBy="bloccompetences",cascade={"persist"})
	*/
	private $bloc;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\BlocCompetence")
    */
    private $bloccompetenceref;

	/**
    * @ORM\ManyToOne(targetEntity="App\Entity\Competence", inversedBy="bloccompetence")
	*/
	private $competence;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\SessionParcoursBlocCompetence", mappedBy="bloccompetence")
	*/
	private $sessionparcoursbloccompetences;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $aevaluer;

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
     * @var int
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre = 0;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set aevaluer
     *
     * @param boolean $aevaluer
     *
     * @return BlocCompetence
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
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return BlocCompetence
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
     * @return BlocCompetence
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
     * Set bloc
     *
     * @param \App\Entity\Bloc $bloc
     *
     * @return BlocCompetence
     */
    public function setBloc(\App\Entity\Bloc $bloc = null)
    {
        $this->bloc = $bloc;

        return $this;
    }

    /**
     * Get bloc
     *
     * @return \App\Entity\Bloc
     */
    public function getBloc()
    {
        return $this->bloc;
    }

    /**
     * Set competence
     *
     * @param \App\Entity\Competence $competence
     *
     * @return BlocCompetence
     */
    public function setCompetence(\App\Entity\Competence $competence = null)
    {
        $this->competence = $competence;

        return $this;
    }

    /**
     * Get competence
     *
     * @return \App\Entity\Competence
     */
    public function getCompetence()
    {
        return $this->competence;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return BlocCompetence
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
     * @return BlocCompetence
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
     * Constructor
     */
    public function __construct()
    {
        $this->sessionparcoursbloccompetences = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add sessionparcoursbloccompetence
     *
     * @param \App\Entity\SessionParcoursBlocCompetence $sessionparcoursbloccompetence
     *
     * @return BlocCompetence
     */
    public function addSessionparcoursbloccompetence(\App\Entity\SessionParcoursBlocCompetence $sessionparcoursbloccompetence)
    {
        $this->sessionparcoursbloccompetences[] = $sessionparcoursbloccompetence;
		$sessionparcoursbloccompetence->setBloccompetence($this);
        return $this;
    }

    /**
     * Remove sessionparcoursbloccompetence
     *
     * @param \App\Entity\SessionParcoursBlocCompetence $sessionparcoursbloccompetence
     */
    public function removeSessionparcoursbloccompetence(\App\Entity\SessionParcoursBlocCompetence $sessionparcoursbloccompetence)
    {
        $this->sessionparcoursbloccompetences->removeElement($sessionparcoursbloccompetence);
    }

    /**
     * Get sessionparcoursbloccompetences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionparcoursbloccompetences()
    {
        return $this->sessionparcoursbloccompetences;
    }

    
    /**
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return BlocCompetence
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
     * Set bloccompetenceref
     *
     * @param \App\Entity\Bloccompetence $bloccompetenceref
     *
     * @return Bloccompetence
     */
    public function setBloccompetenceref(\App\Entity\Bloccompetence $bloccompetenceref = null)
    {
        $this->bloccompetenceref = $bloccompetenceref;

        return $this;
    }

    /**
     * Get bloccompetenceref
     *
     * @return \App\Entity\Bloccompetence
     */
    public function getBloccompetenceref()
    {
        return $this->bloccompetenceref;
    }

}
