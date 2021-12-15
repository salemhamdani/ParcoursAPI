<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * TarifVenteThemeLg
 *
 * @ORM\Table(name="tarifVenteThemeLg")
 * @ORM\Entity(repositoryClass="App\Repository\TarifVenteThemeLgRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class TarifVenteThemeLg
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
    * @ORM\ManyToOne(targetEntity="App\Entity\TarifVenteTheme", inversedBy="lignes", cascade={"persist"})
    */
    private $tarifventetheme;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $tarifjour;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $valeurmin;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $valeurmax;

    /**
	* @Assert\Regex("/\d+(\.\d+)?/")
     * @ORM\Column(type="decimal", precision=10, scale=2)
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
     * Set valeurmin
     *
     * @param integer $valeurmin
     *
     * @return TarifVenteThemeLg
     */
    public function setValeurmin($valeurmin)
    {
        $this->valeurmin = $valeurmin;

        return $this;
    }

    /**
     * Get valeurmin
     *
     * @return integer
     */
    public function getValeurmin()
    {
        return $this->valeurmin;
    }

    /**
     * Set valeurmax
     *
     * @param integer $valeurmax
     *
     * @return TarifVenteThemeLg
     */
    public function setValeurmax($valeurmax)
    {
        $this->valeurmax = $valeurmax;

        return $this;
    }

    /**
     * Get valeurmax
     *
     * @return integer
     */
    public function getValeurmax()
    {
        return $this->valeurmax;
    }

    /**
     * Set tarif
     *
     * @param string $tarif
     *
     * @return TarifVenteThemeLg
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
     * @return TarifVenteThemeLg
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
     * @return TarifVenteThemeLg
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
     * @return TarifVenteThemeLg
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
     * Set tarifventetheme
     *
     * @param \App\Entity\TarifVenteTheme $tarifventetheme
     *
     * @return TarifVenteThemeLg
     */
    public function setTarifventetheme(\App\Entity\TarifVenteTheme $tarifventetheme = null)
    {
        $this->tarifventetheme = $tarifventetheme;

        return $this;
    }

    /**
     * Get tarifventetheme
     *
     * @return \App\Entity\TarifVenteTheme
     */
    public function getTarifventetheme()
    {
        return $this->tarifventetheme;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return TarifVenteThemeLg
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
     * @return TarifVenteThemeLg
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
     * Set tarifjour
     *
     * @param boolean $tarifjour
     *
     * @return TarifVenteThemeLg
     */
    public function setTarifjour($tarifjour)
    {
        $this->tarifjour = $tarifjour;

        return $this;
    }

    /**
     * Get tarifjour
     *
     * @return boolean
     */
    public function getTarifjour()
    {
        return $this->tarifjour;
    }
}
