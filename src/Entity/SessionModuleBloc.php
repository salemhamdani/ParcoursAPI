<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * SessionModuleBloc
 *
 * @ORM\Table(name="session_module_bloc")
 * @ORM\Entity(repositoryClass="App\Repository\SessionModuleBlocRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class SessionModuleBloc
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
	* @ORM\ManyToOne(targetEntity="App\Entity\BlocModule", inversedBy="sessionmoduleblocs", cascade={"persist"})
	*/
	private $blocmodule;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\SessionModule", inversedBy="sessionmoduleblocs", cascade={"persist"})
	*/
	private $sessionmodule;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Session", inversedBy="sessionmoduleblocs", cascade={"persist"})
	*/
	private $session;

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
     * @return SessionModuleBloc
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
     * @return SessionModuleBloc
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
     * Set blocmodule
     *
     * @param \App\Entity\BlocModule $blocmodule
     *
     * @return SessionModuleBloc
     */
    public function setBlocmodule(\App\Entity\BlocModule $blocmodule = null)
    {
        $this->blocmodule = $blocmodule;

        return $this;
    }

    /**
     * Get blocmodule
     *
     * @return \App\Entity\BlocModule
     */
    public function getBlocmodule()
    {
        return $this->blocmodule;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return SessionModuleBloc
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
     * @return SessionModuleBloc
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
     * Set sessionmodule
     *
     * @param \App\Entity\SessionModule $sessionmodule
     *
     * @return SessionModuleBloc
     */
    public function setSessionmodule(\App\Entity\SessionModule $sessionmodule = null)
    {
        $this->sessionmodule = $sessionmodule;

        return $this;
    }

    /**
     * Get sessionmodule
     *
     * @return \App\Entity\SessionModule
     */
    public function getSessionmodule()
    {
        return $this->sessionmodule;
    }

    /**
     * Set session
     *
     * @param \App\Entity\Session $session
     *
     * @return SessionModuleBloc
     */
    public function setSession(\App\Entity\Session $session = null)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return \App\Entity\Session
     */
    public function getSession()
    {
        return $this->session;
    }
	
	public function getDuree()
	{
		if(!is_null($this->getSessionmodule())){
			if(!is_null($this->getSessionmodule()->getDuree())){
				return $this->getSessionmodule()->getDuree();
			}
		}
		return 0;
	}

	public function getDureeEvenement()
	{
		if(!is_null($this->getSessionmodule())){
			if(!is_null($this->getSessionmodule()->getDuree()) && count($this->getSessionmodule()->getSessionevenements())>0){
				return $this->getSessionmodule()->getDuree();
			}
		}
		return 0;
	}

}
