<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Validator\Constraints as Assert; // Pour la gestion des validations.

/**
 * DroitPortail
 *
 * @ORM\Table(name="droitportails")
 * @ORM\Entity(repositoryClass="App\Repository\DroitPortailRepository")
 */
class DroitPortail
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->updateportails = new \Doctrine\Common\Collections\ArrayCollection();
        $this->readportails = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Masterlistelg")
     */
    private $menu;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Masterlistelg")
	 * @ORM\JoinTable(name="droitportailupdate")
     */
    private $updateportails;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Masterlistelg")
	 * @ORM\JoinTable(name="droitportailread")
     */
    private $readportails;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

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
     * Set menu.
     *
     * @param \App\Entity\Masterlistelg|null $menu
     *
     * @return DroitPortail
     */
    public function setMenu(\App\Entity\Masterlistelg $menu = null)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu.
     *
     * @return \App\Entity\Masterlistelg|null
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Add updateportail.
     *
     * @param \App\Entity\Masterlistelg $updateportail
     *
     * @return DroitPortail
     */
    public function addUpdateportail(\App\Entity\Masterlistelg $updateportail)
    {
        $this->updateportails[] = $updateportail;

        return $this;
    }

    /**
     * Remove updateportail.
     *
     * @param \App\Entity\Masterlistelg $updateportail
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeUpdateportail(\App\Entity\Masterlistelg $updateportail)
    {
        return $this->updateportails->removeElement($updateportail);
    }

    /**
     * Get updateportails.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUpdateportails()
    {
        return $this->updateportails;
    }

    /**
     * Add readportail.
     *
     * @param \App\Entity\Masterlistelg $readportail
     *
     * @return DroitPortail
     */
    public function addReadportail(\App\Entity\Masterlistelg $readportail)
    {
        $this->readportails[] = $readportail;

        return $this;
    }

    /**
     * Remove readportail.
     *
     * @param \App\Entity\Masterlistelg $readportail
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeReadportail(\App\Entity\Masterlistelg $readportail)
    {
        return $this->readportails->removeElement($readportail);
    }

    /**
     * Get readportails.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReadportails()
    {
        return $this->readportails;
    }

    /**
     * Set dateinsert.
     *
     * @param \DateTime|null $dateinsert
     *
     * @return DroitPortail
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
     * @return DroitPortail
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
     * @return DroitPortail
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
     * @return DroitPortail
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
}
