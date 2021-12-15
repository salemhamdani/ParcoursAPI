<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Article
 *
 * @ORM\Table(name="articles")
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class Article
{

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $archive;

    /**
     * @ORM\Column(type="string", length=50,nullable=true)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $intitule;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
     */
    private $typearticle;

	/**
     * @ORM\OneToOne(targetEntity="App\Entity\Module", mappedBy="article")
     */
    private $module;

	/**
     * @ORM\OneToOne(targetEntity="App\Entity\Parcours", mappedBy="article")
     */
    private $parcours;

	/**
     * @ORM\OneToOne(targetEntity="App\Entity\Jury", mappedBy="article")
     */
    private $jury;

	/**
     * @ORM\OneToOne(targetEntity="App\Entity\Certification", mappedBy="article")
     */
    private $certification;

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
     * @return Article
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
     * Set code
     *
     * @param string $code
     *
     * @return Article
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Article
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
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return Article
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
     * @return Article
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
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Article
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
     * @return Article
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
     * Set module
     *
     * @param \App\Entity\Module $module
     *
     * @return Article
     */
    public function setModule(\App\Entity\Module $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \App\Entity\Module
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set parcours
     *
     * @param \App\Entity\Parcours $parcours
     *
     * @return Article
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
     * Set jury
     *
     * @param \App\Entity\Jury $jury
     *
     * @return Article
     */
    public function setJury(\App\Entity\Jury $jury = null)
    {
        $this->jury = $jury;

        return $this;
    }

    /**
     * Get jury
     *
     * @return \App\Entity\Jury
     */
    public function getJury()
    {
        return $this->jury;
    }

    /**
     * Set certification
     *
     * @param \App\Entity\Certification $certification
     *
     * @return Article
     */
    public function setCertification(\App\Entity\Certification $certification = null)
    {
        $this->certification = $certification;

        return $this;
    }

    /**
     * Get certification
     *
     * @return \App\Entity\Certification
     */
    public function getCertification()
    {
        return $this->certification;
    }

    /**
     * Set typearticle
     *
     * @param \App\Entity\Masterlistelg $typearticle
     *
     * @return Article
     */
    public function setTypearticle(\App\Entity\Masterlistelg $typearticle = null)
    {
        $this->typearticle = $typearticle;

        return $this;
    }

    /**
     * Get typearticle
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getTypearticle()
    {
        return $this->typearticle;
    }
}
