<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * TarifVenteIntraJour
 *
 * @ORM\Table(name="tarifVenteIntraJour")
 * @ORM\Entity(repositoryClass="App\Repository\TarifVenteIntraJourRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class TarifVenteIntraJour
{

    public function __construct() {
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
    * @ORM\ManyToOne(targetEntity="TarifVenteThemeIntra", inversedBy="intrajours", cascade={"persist"})
    */
    private $tarifventethemeintra;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $tarifinterne;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $jour;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tarif;

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
     * Set tarifinterne
     *
     * @param boolean $tarifinterne
     *
     * @return TarifVenteIntraJour
     */
    public function setTarifinterne($tarifinterne)
    {
        $this->tarifinterne = $tarifinterne;

        return $this;
    }

    /**
     * Get tarifinterne
     *
     * @return boolean
     */
    public function getTarifinterne()
    {
        return $this->tarifinterne;
    }

    /**
     * Set jour
     *
     * @param integer $jour
     *
     * @return TarifVenteIntraJour
     */
    public function setJour($jour)
    {
        $this->jour = $jour;

        return $this;
    }

    /**
     * Get jour
     *
     * @return integer
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * Set tarif
     *
     * @param string $tarif
     *
     * @return TarifVenteIntraJour
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return string
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return TarifVenteIntraJour
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
     * @return TarifVenteIntraJour
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
     * @return TarifVenteIntraJour
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
     * Set tarifventethemeintra
     *
     * @param \App\Entity\TarifVenteThemeIntra $tarifventethemeintra
     *
     * @return TarifVenteIntraJour
     */
    public function setTarifventethemeintra(\App\Entity\TarifVenteThemeIntra $tarifventethemeintra = null)
    {
        $this->tarifventethemeintra = $tarifventethemeintra;

        return $this;
    }

    /**
     * Get tarifventethemeintra
     *
     * @return \App\Entity\TarifVenteThemeIntra
     */
    public function getTarifventethemeintra()
    {
        return $this->tarifventethemeintra;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return TarifVenteIntraJour
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
     * @return TarifVenteIntraJour
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
}
