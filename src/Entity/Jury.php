<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Jury
 *
 * @ORM\Table(name="jurys")
 * @ORM\Entity(repositoryClass="App\Repository\JuryRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class Jury
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sessionlistejurys = new \Doctrine\Common\Collections\ArrayCollection();
		$this->archive = false;
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
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $intitule;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $archive;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\SessionListeJury", mappedBy="jury")
	*/
	private $sessionlistejurys;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\SessionJury", mappedBy="jury")
	*/
	private $sessionjurys;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Parcours")
	*/
	private $parcours;

	/**
     * @ORM\OneToOne(targetEntity="App\Entity\Article", inversedBy="jury")
     */
    private $article;

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
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Jury
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
     * @return Jury
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
     * @return Jury
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
     * Add SessionListeJury
     *
     * @param \App\Entity\SessionListeJury $sessionlistejury
     *
     * @return Jury
     */
    public function addSessionlistejury(\App\Entity\SessionListeJury $sessionlistejury)
    {
        $this->sessionlistejurys[] = $sessionlistejury;
		$sessionlistejury->setJury($this);
        return $this;
    }

    /**
     * Remove sessionlistejury
     *
     * @param \App\Entity\SessionListeJury $sessionlistejury
     */
    public function removeSessionlistejury(\App\Entity\SessionListeJury $sessionlistejury)
    {
        $this->sessionlistejurys->removeElement($sessionlistejury);
    }

    /**
     * Get sessionlistejurys
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionlistejurys()
    {
        return $this->sessionlistejurys;
    }

    /**
     * Set parcours
     *
     * @param \App\Entity\Parcours $parcours
     *
     * @return Jury
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
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Jury
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
     * @return Jury
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
     * Set article
     *
     * @param \App\Entity\Article $article
     *
     * @return Jury
     */
    public function setArticle(\App\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \App\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set intitule.
     *
     * @param string|null $intitule
     *
     * @return Jury
     */
    public function setIntitule($intitule = null)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule.
     *
     * @return string|null
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Add sessionjury.
     *
     * @param \App\Entity\SessionJury $sessionjury
     *
     * @return Jury
     */
    public function addSessionjury(\App\Entity\SessionJury $sessionjury)
    {
        $this->sessionjurys[] = $sessionjury;

        return $this;
    }

    /**
     * Remove sessionjury.
     *
     * @param \App\Entity\SessionJury $sessionjury
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeSessionjury(\App\Entity\SessionJury $sessionjury)
    {
        return $this->sessionjurys->removeElement($sessionjury);
    }

    /**
     * Get sessionjurys.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionjurys()
    {
        return $this->sessionjurys;
    }
}
