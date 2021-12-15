<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Verification
 *
 * @ORM\Table(name="verifications")
 * @ORM\Entity(repositoryClass="App\Repository\VerificationRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class Verification
{

    /**
     * Constructor
     */
    public function __construct()
    {
		$this->itsok = true;
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
    private $itsok;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $remarques;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idsource;

	/**
     * @ORM\Column(type="string", length=255, nullable=true)
	*/
	private $entitesource;

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
     * Set itsok.
     *
     * @param bool|null $itsok
     *
     * @return Verification
     */
    public function setItsok($itsok = null)
    {
        $this->itsok = $itsok;

        return $this;
    }

    /**
     * Get itsok.
     *
     * @return bool|null
     */
    public function getItsok()
    {
        return $this->itsok;
    }

    /**
     * Set remarques.
     *
     * @param string|null $remarques
     *
     * @return Verification
     */
    public function setRemarques($remarques = null)
    {
        $this->remarques = $remarques;

        return $this;
    }

    /**
     * Get remarques.
     *
     * @return string|null
     */
    public function getRemarques()
    {
        return $this->remarques;
    }

    /**
     * Set dateinsert.
     *
     * @param \DateTime|null $dateinsert
     *
     * @return Verification
     */
    public function setDateinsert($dateinsert = null)
    {
        $this->dateinsert = $dateinsert;

        return $this;
    }

    /**
     * Get dateinsert.
     *
     * @return \DateTime|null
     */
    public function getDateinsert()
    {
        return $this->dateinsert;
    }

    /**
     * Set dateupdate.
     *
     * @param \DateTime|null $dateupdate
     *
     * @return Verification
     */
    public function setDateupdate($dateupdate = null)
    {
        $this->dateupdate = $dateupdate;

        return $this;
    }

    /**
     * Get dateupdate.
     *
     * @return \DateTime|null
     */
    public function getDateupdate()
    {
        return $this->dateupdate;
    }

    /**
     * Set quiinsert.
     *
     * @param \App\Entity\User|null $quiinsert
     *
     * @return Verification
     */
    public function setQuiinsert(\App\Entity\User $quiinsert = null)
    {
        $this->quiinsert = $quiinsert;

        return $this;
    }

    /**
     * Get quiinsert.
     *
     * @return \App\Entity\User|null
     */
    public function getQuiinsert()
    {
        return $this->quiinsert;
    }

    /**
     * Set quiupdate.
     *
     * @param \App\Entity\User|null $quiupdate
     *
     * @return Verification
     */
    public function setQuiupdate(\App\Entity\User $quiupdate = null)
    {
        $this->quiupdate = $quiupdate;

        return $this;
    }

    /**
     * Get quiupdate.
     *
     * @return \App\Entity\User|null
     */
    public function getQuiupdate()
    {
        return $this->quiupdate;
    }

    /**
     * Set idsource.
     *
     * @param int|null $idsource
     *
     * @return Verification
     */
    public function setIdsource($idsource = null)
    {
        $this->idsource = $idsource;

        return $this;
    }

    /**
     * Get idsource.
     *
     * @return int|null
     */
    public function getIdsource()
    {
        return $this->idsource;
    }

    /**
     * Set entitesource.
     *
     * @param string|null $entitesource
     *
     * @return Verification
     */
    public function setEntitesource($entitesource = null)
    {
        $this->entitesource = $entitesource;

        return $this;
    }

    /**
     * Get entitesource.
     *
     * @return string|null
     */
    public function getEntitesource()
    {
        return $this->entitesource;
    }
}
