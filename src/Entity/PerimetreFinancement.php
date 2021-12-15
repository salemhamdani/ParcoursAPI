<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * PerimetreFinancement
 *
 * @ORM\Table(name="perimetre_financements")
 * @ORM\Entity(repositoryClass="App\Repository\PerimetreFinancementRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class PerimetreFinancement
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
	* @ORM\ManyToOne(targetEntity="App\Entity\Financeur", inversedBy="perimetres")
	*/
	private $financeur;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Parcours")
	*/
	private $parcours;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Profil")
	*/
	private $profil;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
    */
    private $dispositif;

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
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return PerimetreFinancement
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
     * @return PerimetreFinancement
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
     * Set financeur
     *
     * @param \App\Entity\Financeur $financeur
     *
     * @return PerimetreFinancement
     */
    public function setFinanceur(\App\Entity\Financeur $financeur = null)
    {
        $this->financeur = $financeur;

        return $this;
    }

    /**
     * Get financeur
     *
     * @return \App\Entity\Financeur
     */
    public function getFinanceur()
    {
        return $this->financeur;
    }

    /**
     * Set parcours
     *
     * @param \App\Entity\Parcours $parcours
     *
     * @return PerimetreFinancement
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
     * Set profil
     *
     * @param \App\Entity\Profil $profil
     *
     * @return PerimetreFinancement
     */
    public function setProfil(\App\Entity\Profil $profil = null)
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
     * Set dispositif
     *
     * @param \App\Entity\Masterlistelg $dispositif
     *
     * @return PerimetreFinancement
     */
    public function setDispositif(\App\Entity\Masterlistelg $dispositif = null)
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
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return PerimetreFinancement
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
     * @return PerimetreFinancement
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
