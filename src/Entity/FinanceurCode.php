<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * FinanceurCode
 *
 * @ORM\Table(name="financeurcodes")
 * @ORM\Entity(repositoryClass="App\Repository\FinanceurCodeRepository")
 * @ORM\HasLifecycleCallbacks() 
 */
class FinanceurCode
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
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $collectif;

     /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg", cascade={"persist"})
     */
    private $financeurpoleemploi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Financeur", inversedBy="financeurcodes", cascade={"persist"})
	*/
	private $financeursource;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Financeur")
	*/
	private $financeurcible;

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
     * Set collectif
     *
     * @param boolean $collectif
     *
     * @return FinanceurCode
     */
    public function setCollectif($collectif)
    {
        $this->collectif = $collectif;

        return $this;
    }

    /**
     * Get collectif
     *
     * @return boolean
     */
    public function getCollectif()
    {
        return $this->collectif;
    }


     /**
     * Set financeurpoleemploi
     *
     * @param \App\Entity\Masterlistelg $financeurpoleemploi
     *
     * @return FinanceurCode
     */
    public function setFinanceurpoleemploi(\App\Entity\Masterlistelg $financeurpoleemploi = null)
    {
        $this->financeurpoleemploi = $financeurpoleemploi;

        return $this;
    }

    /**
     * Get financeurpoleemploi
     *
     * @return \App\Entity\Masterlistelg
     */
    public function getFinanceurpoleemploi()
    {
        return $this->financeurpoleemploi;
    }


    /**
     * Set code
     *
     * @param string $code
     *
     * @return FinanceurCode
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
     * Set dateinsert
     *
     * @param \DateTime $dateinsert
     *
     * @return FinanceurCode
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
     * @return FinanceurCode
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
     * Set financeursource
     *
     * @param \App\Entity\Financeur $financeursource
     *
     * @return FinanceurCode
     */
    public function setFinanceursource(\App\Entity\Financeur $financeursource = null)
    {
        $this->financeursource = $financeursource;

        return $this;
    }

    /**
     * Get financeursource
     *
     * @return \App\Entity\Financeur
     */
    public function getFinanceursource()
    {
        return $this->financeursource;
    }

    /**
     * Set financeurcible
     *
     * @param \App\Entity\Financeur $financeurcible
     *
     * @return FinanceurCode
     */
    public function setFinanceurcible(\App\Entity\Financeur $financeurcible = null)
    {
        $this->financeurcible = $financeurcible;

        return $this;
    }

    /**
     * Get financeurcible
     *
     * @return \App\Entity\Financeur
     */
    public function getFinanceurcible()
    {
        return $this->financeurcible;
    }

    /**
     * Set quiinsert
     *
     * @param \App\Entity\User $quiinsert
     *
     * @return FinanceurCode
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
     * @return FinanceurCode
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
