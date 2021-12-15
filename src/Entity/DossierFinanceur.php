<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * DossierFinanceur
 *
 * @ORM\Table(name="dossier_financeurs")
 * @ORM\Entity(repositoryClass="App\Repository\DossierFinanceurRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class DossierFinanceur
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dossiergroupe = false;
        $this->dateinsert = new \DateTime();
        $this->cursusfinanceurs = new \Doctrine\Common\Collections\ArrayCollection();
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
	* @ORM\ManyToOne(targetEntity="App\Entity\Dossier", inversedBy="dossierfinanceurs")
	*/
	private $dossier;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Financeur")
	*/
	private $financeur;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $dossiergroupe;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\BondecommandeParcours")
	*/
	private $bdcparcours;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Session")
	*/
	private $bdcsession;

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
    * @ORM\OneToMany(targetEntity="App\Entity\CursusFinanceur", mappedBy="dossierfinanceur",cascade={"persist"})
    */
    private $cursusfinanceurs;

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
     * @return DossierFinanceur
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
     * @return DossierFinanceur
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
     * Set dossier
     *
     * @param \App\Entity\Dossier $dossier
     *
     * @return DossierFinanceur
     */
    public function setDossier(\App\Entity\Dossier $dossier = null)
    {
        $this->dossier = $dossier;

        return $this;
    }

    /**
     * Get dossier
     *
     * @return \App\Entity\Dossier
     */
    public function getDossier()
    {
        return $this->dossier;
    }

    /**
     * Set financeur
     *
     * @param \App\Entity\Financeur $financeur
     *
     * @return DossierFinanceur
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
     * @return DossierFinanceur
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
     * @return DossierFinanceur
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
     * Set dossiergroupe
     *
     * @param boolean $dossiergroupe
     *
     * @return DossierFinanceur
     */
    public function setDossiergroupe($dossiergroupe)
    {
        $this->dossiergroupe = $dossiergroupe;

        return $this;
    }

    /**
     * Get dossiergroupe
     *
     * @return boolean
     */
    public function getDossiergroupe()
    {
        return $this->dossiergroupe;
    }

    /**
     * Set bdcparcours
     *
     * @param \App\Entity\BondecommandeParcours $bdcparcours
     *
     * @return DossierFinanceur
     */
    public function setBdcparcours(\App\Entity\BondecommandeParcours $bdcparcours = null)
    {
        $this->bdcparcours = $bdcparcours;

        return $this;
    }

    /**
     * Get bdcparcours
     *
     * @return \App\Entity\BondecommandeParcours
     */
    public function getBdcparcours()
    {
        return $this->bdcparcours;
    }

    /**
     * Set bdcsession
     *
     * @param \App\Entity\Session $bdcsession
     *
     * @return DossierFinanceur
     */
    public function setBdcsession(\App\Entity\Session $bdcsession = null)
    {
        $this->bdcsession = $bdcsession;

        return $this;
    }

    /**
     * Get bdcsession
     *
     * @return \App\Entity\Session
     */
    public function getBdcsession()
    {
        return $this->bdcsession;
    }



    public function getCursusCourant()
    {
        if(is_null($this->cursuss)){
            return null;
        }
        
        $courant=null;
        foreach($this->cursuss as $ligne){
            $courant=$ligne;
        }
        return $courant;
    }


    /**
     * Add cursusfinanceur.
     *
     * @param \App\Entity\CursusFinanceur $cursusfinanceur
     *
     * @return Dossier
     */
    public function addCursusfinanceur(\App\Entity\CursusFinanceur $cursusfinanceur)
    {
        $this->cursusfinanceurs[] = $cursusfinanceur;
        $cursusfinanceur->setDossier($this);
        return $this;
    }

    /**
     * Remove cursusfinanceurs.
     *
     * @param \App\Entity\CursusFinanceur $cursusfinanceur
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCursusfinanceur(\App\Entity\CursusFinanceur $cursusfinanceur)
    {
        return $this->cursusfinanceurs->removeElement($cursusfinanceur);
    }

    /**
     * Get cursusfinanceurs.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCursusfinanceurs()
    {
        return $this->cursusfinanceurs;
    }

    public function getCursusfinanceurCourant()
    {
        if(is_null($this->cursusfinanceurs)){
            return null;
        }
        
        $courant=null;
        foreach($this->cursusfinanceurs as $ligne){
            $courant=$ligne;
        }
        return $courant;
    }
}
