<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * OffreFormation
 *
 * @ORM\Table(name="offre_formation")
 * @ORM\Entity(repositoryClass="App\Repository\OffreFormationRepository")
 * @ORM\HasLifecycleCallbacks
 */
class OffreFormation
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->financement = new \Doctrine\Common\Collections\ArrayCollection();
		$this->archive = false;
		$this->soumistva = true;
    }

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Profil", cascade={"persist"})
     * @ORM\JoinColumn(name="profil", nullable=false, onDelete="CASCADE")
     */
    private $profil;

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
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $formation;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
     */
    private $dispositif;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $financement;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $soumistva;

    /**
     * @var bool
     *
     * @ORM\Column(name="archive", type="boolean")
     */
    private $archive;

    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="integer", nullable=true)
     */
    private $ordre;


    /**
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return OffreFormation
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
     * @return OffreFormation
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
     * Set archive
     *
     * @param boolean $archive
     *
     * @return OffreFormation
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
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return OffreFormation
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
     * Set profil
     *
     * @param \App\Entity\Profil $profil
     *
     * @return OffreFormation
     */
    public function setProfil(\App\Entity\Profil $profil)
    {
        $this->profil = $profil;

        return $this;
    }

    /**
     * Get profil
     *
     * @return \App\Entity\Profil
     */
    public function getProfil()
    {
        return $this->profil;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return OffreFormation
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
     * @return OffreFormation
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
     * Set formation
     *
     * @param \App\Entity\Masterlistelg $formation
     *
     * @return OffreFormation
     */
    public function setFormation(\App\Entity\Masterlistelg $formation)
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * Get formation
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getFormation()
    {
        return $this->formation;
    }

    /**
     * Set dispositif
     *
     * @param \App\Entity\Masterlistelg $dispositif
     *
     * @return OffreFormation
     */
    public function setDispositif(\App\Entity\Masterlistelg $dispositif)
    {
        $this->dispositif = $dispositif;

        return $this;
    }

    /**
     * Get dispositif
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getDispositif()
    {
        return $this->dispositif;
    }

    /**
     * Add financement
     *
     * @param \App\Entity\Masterlistelg $financement
     *
     * @return OffreFormation
     */
    public function addFinancement(\App\Entity\Masterlistelg $financement)
    {
        $this->financement[] = $financement;

        return $this;
    }

    /**
     * Remove financement
     *
     * @param \App\Entity\Masterlistelg $financement
     */
    public function removeFinancement(\App\Entity\Masterlistelg $financement)
    {
        $this->financement->removeElement($financement);
    }

    /**
     * Get financement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFinancement()
    {
        return $this->financement;
    }

    /**
     * Set soumistva
     *
     * @param boolean $soumistva
     *
     * @return OffreFormation
     */
    public function setSoumistva($soumistva)
    {
        $this->soumistva = $soumistva;

        return $this;
    }

    /**
     * Get soumistva
     *
     * @return boolean
     */
    public function getSoumistva()
    {
        return $this->soumistva;
    }
}
