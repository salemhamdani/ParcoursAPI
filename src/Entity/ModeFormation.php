<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ModeFormation
 *
 * @ORM\Table(name="mode_formation")
 * @ORM\Entity(repositoryClass="App\Repository\ModeFormationRepository")
 * @ORM\HasLifecycleCallbacks
 */
class ModeFormation
{

    /**
     * Constructor
     */
    public function __construct()
    {
		$this->archive = false;
		$this->parcours = false;
		$this->module = false;
		$this->certification = false;
    }

     /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $intitule;

	/**
     * @var bool
     *
     * @ORM\Column(name="archive", type="boolean")
     */
    private $archive;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $parcours;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $module;


    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Module", mappedBy="modeFormation")
     */
    private $modules;

    /**
     * @var \stdClass
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Certification", mappedBy="modeFormation")
     */
    private $certifications;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
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
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return ModeFormation
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
     * Set parcours
     *
     * @param boolean $parcours
     *
     * @return ModeFormation
     */
    public function setParcours($parcours)
    {
        $this->parcours = $parcours;

        return $this;
    }

    /**
     * Get parcours
     *
     * @return boolean
     */
    public function getParcours()
    {
        return $this->parcours;
    }

    /**
     * Set module
     *
     * @param boolean $module
     *
     * @return ModeFormation
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return boolean
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set certification
     *
     * @param boolean $certification
     *
     * @return ModeFormation
     */
    public function setCertification($certification)
    {
        $this->certification = $certification;

        return $this;
    }

    /**
     * Get certification
     *
     * @return boolean
     */
    public function getCertification()
    {
        return $this->certification;
    }

    /**
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return ModeFormation
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
     * @return ModeFormation
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
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return ModeFormation
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
     * @return ModeFormation
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
     * Set intitule
     *
     * @param string $intitule
     *
     * @return ModeFormation
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
     * Add module
     *
     * @param \App\Entity\Module $module
     *
     * @return ModeFormation
     */
    public function addModule(\App\Entity\Module $module)
    {
        $this->modules[] = $module;

        return $this;
    }

    /**
     * Remove module
     *
     * @param \App\Entity\Module $module
     */
    public function removeModule(\App\Entity\Module $module)
    {
        $this->modules->removeElement($module);
    }

    /**
     * Get modules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * Add certification
     *
     * @param \App\Entity\Certification $certification
     *
     * @return ModeFormation
     */
    public function addCertification(\App\Entity\Certification $certification)
    {
        $this->certifications[] = $certification;

        return $this;
    }

    /**
     * Remove certification
     *
     * @param \App\Entity\Certification $certification
     */
    public function removeCertification(\App\Entity\Certification $certification)
    {
        $this->certifications->removeElement($certification);
    }

    /**
     * Get certifications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCertifications()
    {
        return $this->certifications;
    }
}
