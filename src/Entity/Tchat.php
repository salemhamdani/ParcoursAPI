<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * Tchat
 *
 * @ORM\Table(name="tchat")
 * @ORM\Entity(repositoryClass="App\Repository\TchatRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class Tchat
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tchatlignes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @var string
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     * 
     */
    private $entiteorigine;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=true)
     * 
     */
    private $idorigine;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\TchatLigne", mappedBy="tchat", orphanRemoval=true, cascade={"all"})
	* @ORM\OrderBy({"dateinsert" = "DESC"})
	*/
	private $tchatlignes;

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
     * @return Tchat
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
     * @return Tchat
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
     * Add tchatligne
     *
     * @param \App\Entity\TchatLigne $tchatligne
     *
     * @return Tchat
     */
    public function addTchatligne(\App\Entity\TchatLigne $tchatligne)
    {
        $this->tchatlignes[] = $tchatligne;
		$tchatligne->setTchat($this);
        return $this;
    }

    /**
     * Remove tchatligne
     *
     * @param \App\Entity\TchatLigne $tchatligne
     */
    public function removeTchatligne(\App\Entity\TchatLigne $tchatligne)
    {
        $this->tchatlignes->removeElement($tchatligne);
    }

    /**
     * Get tchatlignes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTchatlignes()
    {
        return $this->tchatlignes;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return Tchat
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
     * @return Tchat
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
     * Set entiteorigine
     *
     * @param string $entiteorigine
     *
     * @return Tchat
     */
    public function setEntiteorigine($entiteorigine)
    {
        $this->entiteorigine = $entiteorigine;

        return $this;
    }

    /**
     * Get entiteorigine
     *
     * @return string
     */
    public function getEntiteorigine()
    {
        return $this->entiteorigine;
    }

    /**
     * Set idorigine
     *
     * @param integer $idorigine
     *
     * @return Tchat
     */
    public function setIdorigine($idorigine)
    {
        $this->idorigine = $idorigine;

        return $this;
    }

    /**
     * Get idorigine
     *
     * @return integer
     */
    public function getIdorigine()
    {
        return $this->idorigine;
    }
}
