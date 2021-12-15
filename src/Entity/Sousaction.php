<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Sousaction
 *
 * @ORM\Table(name="sousactions")
 * @ORM\Entity(repositoryClass="App\Repository\SousactionRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class Sousaction
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bondecommandes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @ORM\Column(type="string", length=50)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $intitule;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datefin;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Action", inversedBy="sousactions", cascade={"persist"})
	*/
	private $action;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Bondecommande", orphanRemoval=true, mappedBy="sousaction",cascade={"persist"})
    */
    private $bondecommandes;

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
     * @return Sousaction
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
     * @return Sousaction
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
     * Set action
     *
     * @param \App\Entity\Action $action
     *
     * @return Sousaction
     */
    public function setAction(\App\Entity\Action $action = null)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return \App\Entity\Action
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Sousaction
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
     * @return Sousaction
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
     * Set numero
     *
     * @param string $numero
     *
     * @return Sousaction
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Sousaction
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
     * Add bondecommande
     *
     * @param \App\Entity\Bondecommande $bondecommande
     *
     * @return Sousaction
     */
    public function addBondecommande(\App\Entity\Bondecommande $bondecommande)
    {
        $this->bondecommandes[] = $bondecommande;
		$bondecommande->setSousaction($this);
        return $this;
    }

    /**
     * Remove bondecommande
     *
     * @param \App\Entity\Bondecommande $bondecommande
     */
    public function removeBondecommande(\App\Entity\Bondecommande $bondecommande)
    {
        $this->bondecommandes->removeElement($bondecommande);
    }

    /**
     * Get bondecommandes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBondecommandes()
    {
        return $this->bondecommandes;
    }

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return Sousaction
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \DateTime
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set datefin
     *
     * @param \DateTime $datefin
     *
     * @return Sousaction
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }
}
