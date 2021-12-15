<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Stage
 *
 * @ORM\Table(name="actions")
 * @ORM\Entity(repositoryClass="App\Repository\ActionRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class Action
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sousactions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @ORM\Column(type="string", length=50)
     */
    private $numero;

   /**
     * @ORM\Column(type="string", length=50,nullable=true)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $intitule;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $fse;

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
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $statut;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Financeur", inversedBy="actions")
	*/
	private $financeur;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\PersonalInformations")
    */
    private $contact;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Sousaction", orphanRemoval=true, mappedBy="action",cascade={"persist"})
    */
    private $sousactions;

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
     * Set code
     *
     * @param string $code
     *
     * @return Action
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
     * @return Action
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
     * @return Action
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
     * @return Action
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
     * @return Action
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
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Action
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
     * @return Action
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
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return Action
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
     * @return Action
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

    /**
     * Set statut
     *
     * @param \App\Entity\Masterlistelg $statut
     *
     * @return Action
     */
    public function setStatut(\App\Entity\Masterlistelg $statut = null)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Add sousaction
     *
     * @param \App\Entity\Sousaction $sousaction
     *
     * @return Action
     */
    public function addSousaction(\App\Entity\Sousaction $sousaction)
    {
        $this->sousactions[] = $sousaction;
		$sousaction->setAction($this);
        return $this;
    }

    /**
     * Remove sousaction
     *
     * @param \App\Entity\Sousaction $sousaction
     */
    public function removeSousaction(\App\Entity\Sousaction $sousaction)
    {
        $this->sousactions->removeElement($sousaction);
    }

    /**
     * Get sousactions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSousactions()
    {
        return $this->sousactions;
    }

    /**
     * Set numero
     *
     * @param string $numero
     *
     * @return Action
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
     * Set fse
     *
     * @param boolean $fse
     *
     * @return Action
     */
    public function setFse($fse)
    {
        $this->fse = $fse;

        return $this;
    }

    /**
     * Get fse
     *
     * @return boolean
     */
    public function getFse()
    {
        return $this->fse;
    }

    /**
     * Set contact
     *
     * @param \App\Entity\PersonalInformations $contact
     *
     * @return Action
     */
    public function setContact(\App\Entity\PersonalInformations $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return \App\Entity\PersonalInformations
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return Action
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
}
